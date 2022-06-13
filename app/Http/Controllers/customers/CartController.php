<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function response;

class CartController extends Controller
{
    //
    public function index()

    {
//    Cart::add('293ad', 'Product 1', 1, 9.99, 550);
//        Cart::destroy();
        return view('Shop.home.cart');
    }

    public function store(Request $request)
    {

        try {
            $data = $request->all();
            if ($data['cart_product_qty'] < 10) {
                $productId = $data['cart_product_id'];
                $qty = $data['cart_product_qty'];

                $product = Product::where('id', $productId)->first();
                $data['id'] = $product->id;
                $data['qty'] = $qty;
                $data['name'] = $product->name;
                $data['price'] = $product->price;
                $data['weight'] = 0;
                $slug = $product->slug;
                $data['options']['slug'] = $slug;
                $data['options']['image_path'] = $product->main_image_path;
                $data['options']['image_name'] = $product->main_image_name;
                Cart::add($data);
                return response()->json([
                    'code' => 200,
                    'message' => 'success',
                    'product_type' => 'món ăn',
                    'cart_items_count' => Cart::count()
                ]);
            }

        } catch (Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'failed',
                'product_type' => 'món ăn'
            ], 500);
        }
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            if (is_int(intval($data['qty'])) && $data['qty'] > 0 && $data['qty'] < 30) {
                Cart::update($data['rowId'], intval($data['qty']));
                return response()->json([
                    'code' => 200,
                    'message' => 'success',
                    'cart_items_count' => Cart::count(),
                    'sub_total' => Cart::subtotal(0,',','.'),
                    'tax' => Cart::tax(0,',','.'),
                    'total' => Cart::total(0,',','.'),
                ]);
            }
            return response()->json([
                'code' => 500,
                'message' => 'failed',
                'product_type' => 'món ăn',
            ], 500);
        } catch (Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'failed',
                'product_type' => 'món ăn'
            ], 500);
        }
    }

    public function destroy($rowId): JsonResponse
    {
        try {
            Cart::remove($rowId);
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'product_type' => 'món ăn',
                'cart_items_count' => Cart::count(),
                'sub_total' => Cart::subtotal(0,',','.'),
                'tax' => Cart::tax(0,',','.'),
                'total' => Cart::total(0,',','.'),
            ]);

        } catch (Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'failed',
            ], 500);
        }

    }
}
