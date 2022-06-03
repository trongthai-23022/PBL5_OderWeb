<?php

namespace App\Http\Controllers;

use App\Components\Recursive;
use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Slider;
use App\Models\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTraits;
use http\Env\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\This;

class AminSliderController extends Controller
{
    use StorageImageTraits, DeleteModelTrait;

    private $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    //
    public function index()
    {
        $sliderList =  $this->slider->latest()->paginate(config('constants.pagination_records'));
        return view('admin.slider.index',['sliders'=>$sliderList]);
    }

    public function create()
    {
        $sliderList = $this->slider->latest()->paginate(config('constants.pagination_records'));
        return view('admin.slider.create',['sliders' => $sliderList]);
    }

    public function store(Request $req): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $dataSliderCreate = [
                'title' => $req->title,
                'subtitle' => $req->subtitle,
                'description' => $req->description,
                'content_position' => $req->content_position,

            ];
            if(isset($req->product_id)){
                $dataSliderCreate['product_id'] = $req->product_id;
            }
            //image data
            if ($req->hasFile('slider_image')) {
                $image_file = $req->slider_image;
                $slider_image_info = $this->getUploadedImageInfo($image_file, 'slider');
                if (!empty($slider_image_info)) {
                    $dataSliderCreate['image_path'] = $slider_image_info['file_path'];
                    $dataSliderCreate['image_name'] = $slider_image_info['file_name'];
                }
            }
            // add new slider
            $this->slider->create($dataSliderCreate);
            DB::commit();
            $resMessage = 'Thêm thành công!';
            return redirect()->route('sliders.create')->with('success', $resMessage);
        } catch (\Exception $exception) {
            DB::rollBack();
            $resMessage = 'Thêm thất bại!';
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return redirect()->route('sliders.create')->with('failure', $resMessage);
        }
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getAllCategories($product->category_id);
        return view('admin.product.edit', [
            'htmlOption'=> $htmlOption,
            'product'=>$product
        ]);
    }

    public function update($id, SliderUpdateRequest $req):RedirectResponse
    {
        try {
            DB::beginTransaction();
            //base product data
            $dataSliderCreate = [
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
                    $dataSliderCreate['main_image_path'] = $product_image_info['file_path'];
                    $dataSliderCreate['main_image_name'] = $product_image_info['file_name'];
                }
            }
            // update product
            $updateSlider = $this->product->find($id);
            $res = $updateSlider->update($dataSliderCreate); // return boolean

            //update detail image to product_images
            if ($req->hasFile('product_images')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($req->product_images as $product_image) {
                    $detail_image_info = $this->getUploadedImageInfo($product_image, 'product');
                    $updateSlider->detailImages()->create([
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
                $updateSlider->tags()->sync($tagIds);
            }
            DB::commit();
            $resMessage = 'Sửa thành công!';
            return redirect()->route('products.index')->with('success', $resMessage);
        } catch (\Exception $exception) {
            $resMessage = 'Sửa thất bại!';
            DB::rollBack();
            return redirect()->route('products.edit')->with('failure', $resMessage);
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
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
