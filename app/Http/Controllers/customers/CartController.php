<?php

namespace App\Http\Controllers\customers;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\UserProfile;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function response;

class CartController extends Controller
{
    private $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

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


    public function getCheckout()
    {
        $res = UserProfile::where('user_id', auth()->user()->id)->first();
        if(is_null($res)){
           return  redirect()->route('account.show',auth()->user()->id);
        }

        $userInfo = $res;
        $userInfo['name'] = auth()->user()->name;
        $userInfo['email'] = auth()->user()->email;


        return view('Shop.checkout.index',[
            'userInfo' => $userInfo
        ]);
    }

    public function postOrder(Request $request)
    {
        try {
            DB::beginTransaction();
            $orderInfo = $request->all();
            $cart = Cart::content();
//            dd(Cart::subtotal(0,',',''));
            $dataOrderCreate = [
                'user_id' => auth()->user()->id,
                'user_name' => $orderInfo['name'],
                'user_email' => $orderInfo['email'],
                'user_phone' => $orderInfo['phone'],
                'user_address' => $orderInfo['address'],
                'user_note' => $orderInfo['note'],
                'status' => 0,
                'item_count' => intval(Cart::count(0,',','')),
                'sub_total' => intval(Cart::subtotal(0,',','')),
                'tax' => intval(Cart::tax(0,',','')),
                'total' => intval(Cart::total(0,',','')),
            ];
//            if(!empty($orderInfo['coupon-code'])){
//
//                $orderCreate['discount'] = $orderInfo['coupon-code'];
//            }
            $newOrder = $this->order->create($dataOrderCreate);

            foreach ($cart as $product){
                $newOrder->orderDetail()->create([
                    'product_id' => $product->id,
                    'product_price' => intval($product->price),
                    'product_qty' => intval($product->qty),
                    'total' => intval($product->qty) * intval($product->price),
                ]);
            }
            DB::commit();
            Cart::destroy();
            return view('Shop.checkout.thankyou');

        }
        catch (Exception $exception){
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return redirect()->back();
        }
    }
}
