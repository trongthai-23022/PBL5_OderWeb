<?php

namespace App\Http\Services\Product;

use App\Models\Category;
use App\Models\Product;

class CategoryService
{
    public function getId($id)
    {
        return Category::where('id', $id)->firstOrFail();
    }
    public function getProduct($category, $request)
    {

        $query = $category->products()
            ->select('id', 'name', 'price', 'amount', 'main_image_path','description');


        if ($request->input('price')) {
            $query->orderBy('price', $request->input('price'));
        }


        return $query
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }
}
