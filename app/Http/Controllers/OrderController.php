<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    //
    public function index()
    {
        return view('admin.order.index');
    }

    public function api()
    {
        return DataTables::of(Order::query())
            ->addIndexColumn()
            ->editColumn('created_at', function ($order) {
                return $order->created_at->format('Y/m/d - H:i');
            })
            ->editColumn('updated_at', function ($order) {
                return $order->updated_at->format('Y/m/d - H:i');
            })
            ->editColumn('total', function ($order) {
                return number_format($order->total, 0, ',', '.');
            })
            ->editColumn('status', function ($order) {
                return OrderStatusEnum::getArrayView()[$order->status];
            })
            ->addColumn('edit', function ($order) {
                return route('orders.edit', ['id' => $order->id]);
            })
            ->make(true);
    }

    public function edit($id)
    {
        $order = Order::where('id', $id)->first();
        $orderDetail = $order->orderDetail;
        $products = $order->products;
        $orderStatus = OrderStatusEnum::getArrayView();
//        dd($order);

        $count = sizeof($products);
        $items = [];
        if ($count == sizeof($orderDetail)) {
            for ($i = 0; $i < $count; $i++) {
                $item = [
                    'image_path' => $products[$i]->main_image_path,
                    'image_name' => $products[$i]->main_image_name,
                    'name' => $products[$i]->name,
                    'price' => $orderDetail[$i]->product_price,
                    'qty' => $orderDetail[$i]->product_qty,
                    'item_total' => $orderDetail[$i]->total,
                ];
                $items[$i] = $item;
            }
        }
//        dd($items[1]['image_path']);
        return view('admin.order.order-detail',
            [
                'order' => $order,
                'orderItems' => $items,
                'orderStatus' => $orderStatus,
            ]);
    }

    public function update_status(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $orderId = $data['order_id'];
            $status = $data['status'];

            Order::where('id',$orderId)->update([
                'status' => $status
            ]);
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'product_type' => 'món ăn',
                'status' => $status
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'failed',
            ],500);
        }

    }

    public function user_purchase_show(){
        return view('Shop.home.purchase');
    }
}
