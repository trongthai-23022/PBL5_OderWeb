<?php

namespace App\Http\Controllers;

use App\Components\Recursive;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Traits\StorageImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\This;

class AdminProductController extends Controller
{
    use StorageImageTraits;

    private $category;
    private $product;
    private $tag;
    private $productTag;

    public function __construct(Category $category, Product $product, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }

    //
    public function index()
    {
        $productsList =  $this->product->latest()->paginate(5);
        return view('admin.product.index',['products'=>$productsList]);
    }

    public function create()
    {
        $htmlCategoryOptions = $this->getAllCategories($parentId = '');
        return view('admin.product.create', [
            'htmlOption' => $htmlCategoryOptions
        ]);
    }

    public function store(Request $req)
    {
        try {
            DB::beginTransaction();
            //base product data
            $dataProductCreate = [
                'name' => $req->name,
                'price' => $req->price,
                'user_id' => auth()->id(),
                'description' => $req->description,
                'category_id' => $req->category_id,
                'amount' => 69
            ];
            //product main image data
            if ($req->hasFile('product_image')) {
                $image_file = $req->product_image;
                $product_image_info = $this->getUploadedImageInfo($image_file, 'product');
                if (!empty($product_image_info)) {
                    $dataProductCreate['main_image_path'] = $product_image_info['file_path'];
                    $dataProductCreate['main_image_name'] = $product_image_info['file_name'];
                }
            }
            // add new product
            $newProduct = $this->product->create($dataProductCreate);

            //insert detail image to product_images
            if ($req->hasFile('product_images')) {
                foreach ($req->product_images as $product_image) {
                    $detail_image_info = $this->getUploadedImageInfo($product_image, 'product');
                    $newProduct->detailImages()->create([
                        'image_path' => $detail_image_info['file_path'],
                        'image_name' => $detail_image_info['file_name'],

                    ]);
                }
            }

            //insert tags
            $tagIds = [];
            if (!empty($req->tags)) {
                foreach ($req->tags as $tag) {
                    $tagInstance = $this->tag->firstOrCreate([
                        'name' => $tag
                    ]);
                    $tagIds[] = $tagInstance->id;
                }
                $newProduct->tags()->attach($tagIds);
            }
            DB::commit();
            return redirect()->route('admin.products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlCategoryOptions = $this->getAllCategories($category->parent_id);
        return view('admin.category.update', [
            'category' => $category,
            'htmlOption' => $htmlCategoryOptions
        ]);

    }

    public function update($id, Request $request)
    {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->slug)
        ]);
        return redirect()->route('categories.index');

    }

    public function delete($id)
    {
        $this->category->find($id)->delete();
        return redirect()->route('categories.index');
    }


    //
    private function getAllCategories($parentId): string
    {
        $data = $this->category->all();
        $recursion = new Recursive($data);
        return $recursion->categoryRecursion($parentId);
    }
}
