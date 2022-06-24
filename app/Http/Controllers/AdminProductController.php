<?php

namespace App\Http\Controllers;

use App\Components\Recursive;
use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTraits;
use http\Env\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use Yajra\Datatables\Datatables;

class AdminProductController extends Controller
{
    use StorageImageTraits, DeleteModelTrait;

    private $category;
    private $product;
    private $tag;
    private $productTag;
    private $productImage;

    public function __construct(Category $category, Product $product, Tag $tag, ProductTag $productTag, ProductImage $productImage)
    {
        $this->category = $category;
        $this->product = $product;
        $this->tag = $tag;
        $this->productTag = $productTag;
        $this->productImage = $productImage;
    }


    //
    public function index(Request $request)
    {

        (!is_null($request->category_id))?$cateID = $request->category_id:$cateID = null;
        (!is_null($request->sort_by))?$sortBy = $request->sort_by: $sortBy = 'created_at-desc';
        (!is_null($request->q))?$search = $request->q: $search ='';

        $sortColumn = explode('-', $sortBy)[0];
        $sortDirection = explode('-', $sortBy)[1];
        if (is_null($cateID)) {
            $productsList = Product::query()
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('created_at', 'like', '%' . $search . '%')
                ->orWhere('price', '>=', $search )
                ->orderBy($sortColumn, $sortDirection)
                ->paginate(config('constants.pagination_records'));
            $htmlCategoryOptions = $this->getAllCategories($parent_id = '');
        } else {
            $productsList = Product::query()
                ->where('category_id', '=', $cateID)
                ->where(function ($query) use ($cateID,$search){
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('created_at', 'like', '%' . $search . '%')
                        ->orWhere('price', '>=', $search );
                })
                ->orderBy($sortColumn, $sortDirection)
                ->paginate(config('constants.pagination_records'));
            $htmlCategoryOptions = $this->getAllCategories($cateID);
        }

        $productsList->appends([
            'q' => $search,
            'category_id' => $cateID,
            'sort_by' => $sortBy,
        ]);

        return view('admin.product.index', [
            'products' => $productsList,
            'search' => $search,
            'cate_options' => $htmlCategoryOptions,
            'sort_by' => $sortBy,
        ]);
    }


    public function create()
    {
        $htmlCategoryOptions = $this->getAllCategories($parentId = '');
        return view('admin.product.create', [
            'htmlOption' => $htmlCategoryOptions
        ]);
    }

    public function store(ProductAddRequest $req): RedirectResponse
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
                'amount' => 69,
                'slug' => Str::slug($req->name, '-')
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
            $resMessage = 'Thêm thành công!';
            return redirect()->route('products.create')->with('success', $resMessage);
        } catch (\Exception $exception) {
            DB::rollBack();
            $resMessage = 'Thêm thất bại!';
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return redirect()->route('products.create')->with('failure', $resMessage);

        }
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getAllCategories($product->category_id);
        return view('admin.product.edit', [
            'htmlOption' => $htmlOption,
            'product' => $product
        ]);
    }

    public function update($id, ProductUpdateRequest $req): RedirectResponse
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
            // update product
            $updateProduct = $this->product->find($id);
            $res = $updateProduct->update($dataProductCreate); // return boolean

            //update detail image to product_images
            if ($req->hasFile('product_images')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($req->product_images as $product_image) {
                    $detail_image_info = $this->getUploadedImageInfo($product_image, 'product');
                    $updateProduct->detailImages()->create([
                        'image_path' => $detail_image_info['file_path'],
                        'image_name' => $detail_image_info['file_name'],
                    ]);
                }
            }
            //insert tags
            $tagIds = [];
            if (!empty($req->tags)) {
                foreach ($req->tags as $tag) {
                    // Retrieve flight by name or create it if it doesn't exist...
                    $tagInstance = $this->tag->firstOrCreate([
                        'name' => $tag
                    ]);
                    $tagIds[] = $tagInstance->id;
                }
                //  update product_tag
                $updateProduct->tags()->sync($tagIds);
            }
            DB::commit();
            $resMessage = 'Sửa thành công!';
            return redirect()->route('products.index')->with('success', $resMessage);
        } catch (\Exception $exception) {
            $resMessage = 'Sửa thất bại!';
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return redirect()->route('products.edit')->with('failure', $resMessage);

        }

    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->product);
    }


    //
    private function getAllCategories($parentId): string
    {
        $data = $this->category->all();
        $recursion = new Recursive($data);
        return $recursion->selectRecursion($parentId);
    }

}
