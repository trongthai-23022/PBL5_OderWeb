<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;

class HomeController extends Controller
{

    protected $product;
    protected $slider;
    protected $category;
    //
    public function __construct(Product $product, Slider $slider, Category $category)
    {
        $this->product = $product;
        $this->slider = $slider;
        $this->category = $category;
    }
    public function index(){
        //slider
        $sliders = $this->slider->where('type', 1)->get();
        // latest
        $latestPosts = $this->product->latest()->limit(10)->get();
        //cate products
        $categories = $this->category->inRandomOrder()->limit(5)->get();
        $onSaleTag = null;
        try {
            //on sale
            $onSaleTag = Tag::where('name', 'sale')->orWhere('name', 'SALE')->first();
        }catch (\Exception $exception){
        }
        $onSaleProducts = null;
         if(!is_null($onSaleTag)){
             $onSaleProducts = $onSaleTag->products;
         }

         //banner
        $bannerCate = $this->slider->where('type', 2)->where('content_position', 'cate-pro')->first();
        $bannerLatest= $this->slider->where('type', 2)->where('content_position', 'latest')->first();

        return view('Shop.home.index', [
            'sliders' => $sliders,
            'onSaleProducts' =>$onSaleProducts,
            'latestProducts' =>$latestPosts,
            'categories' =>$categories,
            'bannerCate' => $bannerCate,
            'bannerLatest' => $bannerLatest,
        ]);
    }
}
