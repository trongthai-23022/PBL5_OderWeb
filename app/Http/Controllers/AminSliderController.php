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
use Exception;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
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
        $sliderList =  $this->slider->where('type',1)->latest()->paginate(config('constants.pagination_records'));
        return view('admin.slider.index',['sliders'=>$sliderList]);
    }

    public function index_banner()
    {
        $sliderList =  $this->slider->where('type',2)->latest()->paginate(config('constants.pagination_records'));
        return view('admin.banner.index',['sliders'=>$sliderList]);
    }

    public function create()
    {
        return view('admin.slider.create');
    }
    public function create_banner()
    {
        return view('admin.banner.create',);
    }

    public function store(Request $req): RedirectResponse
    {
//
//        $a = $req->content_position;
//        dd($a);
        try {
            DB::beginTransaction();
            $dataSliderCreate = [
                'title' => $req->title,
                'subtitle' => $req->subtitle,
                'description' => $req->description,
                'content_position' => $req->content_position,
                'type' => $req->type,
                'product_id' => $req->product_id
            ];

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
        } catch (Exception $exception) {
            DB::rollBack();
            $resMessage = 'Thêm thất bại!';
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return redirect()->route('sliders.create')->with('failure', $resMessage);
        }
    }

    public function edit($id)
    {
        $slide = $this->slider->find($id);

        return view('admin.slider.edit', [
                'slide' => $slide
        ]);
    }

    public function update($id, Request $req):RedirectResponse
    {
        try {
            DB::beginTransaction();
            $dataSliderCreate = [
                'title' => $req->title,
                'subtitle' => $req->subtitle,
                'description' => $req->description,
                'content_position' => $req->content_position,

            ];
            if ($req->hasFile('slider_image')) {
                $image_file = $req->slider_image;
                $slider_image_info = $this->getUploadedImageInfo($image_file, 'slider');
                if (!empty($slider_image_info)) {
                    $dataSliderCreate['image_path'] = $slider_image_info['file_path'];
                    $dataSliderCreate['image_name'] = $slider_image_info['file_name'];
                }
            }
            if(isset($req->product_id)){
                $dataSliderCreate['product_id'] = $req->product_id;
            }

            $updateSlider = $this->slider->find($id);
            $res = $updateSlider->update($dataSliderCreate); // return boolean
            DB::commit();
            $resMessage = 'Sửa thành công!';
            return redirect()->route('sliders.index')->with('success', $resMessage);
        } catch (Exception $exception) {
            $resMessage = 'Sửa thất bại!';
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return redirect()->route('sliders.edit')->with('failure', $resMessage);
        }

    }

    public function delete($id): JsonResponse
    {
        return $this->deleteModelTrait($id, $this->slider);
    }

}
