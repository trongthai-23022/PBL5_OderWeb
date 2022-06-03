<?php

namespace App\Http\Services\Product;


use App\Models\Product;


class ProductService
{
    const LIMIT = 16;


    public function get($page = null)
    {
        return Product::select('id', 'name', 'price', 'amount', 'main_image_path')
            ->orderByDesc('id')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function show($id)
    {
        return Product::where('id', $id)
            ->firstOrFail();
    }

    public function more($id)
    {
        return Product::select('id', 'name', 'price', 'amount', 'main_image_path')
            ->where('id', '!=', $id)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
    }

}
