<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductService;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    public function index($id='1',$slug='1'){

         $product = $this->productService->show($id);
         return view('SuperKay.products.content',[
             'title' => $product->name,
             'product' => $product
         ]);
    }
}
