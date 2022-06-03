<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;

class HomeController extends Controller
{

    protected $product;
    protected $slider;
    //
    public function __construct(Product $product, Slider $slider)
    {
        $this->product = $product;
        $this->slider = $slider;
    }
    public function index(){
        $sliders = $this->slider->all();
        return view('SuperKay.home.index', [
            'sliders' => $sliders
        ]);
    }
}
