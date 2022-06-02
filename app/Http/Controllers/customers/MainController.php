<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;

class MainController extends Controller
{

    protected $product;
    //
    public function __construct(ProductService $product)
    {
        $this->product = $product;
    }
    public function index(){

        return view('SuperKay.home.index', [
            'title'=>'Super Kay',
            'products' => $this->product->get()
        ]);
    }
}
