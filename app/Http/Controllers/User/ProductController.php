<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Http\Services\Product\CategoryService;
use App\Http\Services\Product\ProductService;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;


    public function __construct(ProductService $productService,CategoryService $categoryService){
        $this->productService = $productService;
        $this->categoryService= $categoryService;
    }
    public function index($id=''){

         $product = $this->productService->show($id);
         return view('SuperKay.products.detail',[
             'product' => $product
         ]);
    }
    public function shop(){

        return view('SuperKay.products.shop',[
        ]);
    }
    public function category_products(Request $request,$id, $slug=''){
        $category = $this->categoryService->getId($id);
        $products = $this->categoryService->getProduct($category, $request);
        return view('SuperKay.products.listProduct',[
            'products' => $products,
            'category'  => $category
        ]);
    }

}
