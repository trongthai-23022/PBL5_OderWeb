<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\services\FlashOrderService;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
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
                return $order->created_at->format('Y-m-d | H:i');
            })
            ->editColumn('updated_at', function ($order) {
                return $order->updated_at->format('Y-m-d | H:i');
            })
            ->editColumn('total', function ($order) {
                return number_format($order->total, 0, ',', '.');
            })
            ->editColumn('status', function ($order) {
                return OrderStatusEnum::getArrayView()[$order->status] ." [".$order->status ."]";
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

    public function update_status(Request $request): JsonResponse
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
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'failed',
            ],500);
        }

    }

    public function user_purchase_show(){

        $userOrders = Order::where('user_id', auth()->user()->id)->latest()->get();

        $orders = [];
        foreach ($userOrders as $userOrder) {
            $listProductOfAnOrder = [];
            $anOrder = $userOrder;
            $details = $userOrder->orderDetail;
            $products = $userOrder->products;
//            dd($details);
            for($i =0 ; $i < count($details); $i++){
                $listProductOfAnOrder[] = [
                    'image_path' => $products[$i]->main_image_path,
                    'image_name' => $products[$i]->main_image_name,
                    'name' => $products[$i]->name,
                    'price' => $details[$i]->product_price,
                    'qty' => $details[$i]->product_qty,
                    'item_total' => $details[$i]->total,
                ];
            }
            $anOrder['products'] = $listProductOfAnOrder;
            $orders[] = $anOrder;
        }
        // classify
        $processing = [];
        $inTransit = [];
        $completed = [];
        $canceled = [];
        foreach ($orders as $item) {
            if ($item->status == OrderStatusEnum::PROCESSING){
                $processing[] = $item;
            }
            if ($item->status == OrderStatusEnum::IN_TRANSIT){
                $inTransit[] = $item;
            }
            if ($item->status == OrderStatusEnum::COMPLETED){
                $completed[] = $item;
            }
            if ($item->status == OrderStatusEnum::CANCELED){
                $canceled[] = $item;
            }
        }
        return view('Shop.home.purchase',[
            'all_orders' => $this->paginate($orders),
            'processing' => $this->paginate($processing),
            'in_transit' => $this->paginate($inTransit),
            'completed' => $this->paginate($completed),
            'canceled' => $this->paginate($canceled),
            'status' =>  OrderStatusEnum::getArrayView()
        ]);
    }

    function paginate($items, $perPage=5): LengthAwarePaginator
    {
        $pageStart           = request('page', 1);
        $offSet              = ($pageStart * $perPage) - $perPage;
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, TRUE);
        return new LengthAwarePaginator(
            $itemsForCurrentPage, count($items), $perPage,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
    }

    public function detail_show($id)
    {
        $order = Order::where('id', $id)->first();
        $orderDetail = $order->orderDetail;
        $products = $order->products;
        $orderStatus = OrderStatusEnum::getArrayView();
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
        return view('Shop.home.order-detail',
            [
                'order' => $order,
                'orderItems' => $items,
                'orderStatus' => $orderStatus,
            ]);
    }

    public function buy_again($id)
    {
        $order = Order::where('id', $id)->first();
        $products = $order->products;
        $qty = 1;
        foreach ($products as $product){
            $cartItem['id'] = $product->id;
            $cartItem['qty'] = $qty;
            $cartItem['name'] = $product->name;
            $cartItem['price'] = $product->price;
            $cartItem['weight'] = 0;
            $slug = $product->slug;
            $cartItem['options']['slug'] = $slug;
            $cartItem['options']['image_path'] = $product->main_image_path;
            $cartItem['options']['image_name'] = $product->main_image_name;
            Cart::add($cartItem);
        }
        return redirect()->route('cart.index');
    }

    public function flash_order(Request $request, FlashOrderService $service){

            $sum = 100000;
            $perPage =12;
            $products = Product::select('id','price','amount')
                    ->limit(20)
                    ->get()->toArray();
            $recommendIds = $service->flash_order($sum,$products);
            $recommendProducts = Product::whereIn('id',$recommendIds)
                ->get()->toArray();;

        $parentCates = Category::where('parent_id', 0)->get();

        $popular = Product::orderBy('amount', 'desc')
            ->limit(5)->get();
        return view('Shop.flash-order.index',[
            'parentCates' => $parentCates,
            'recommendProducts' => $this->paginate($recommendProducts,$perPage),
             'popular'=>$popular
        ]);
    }
    public function flash_order_ajax(Request $request, FlashOrderService $service): JsonResponse
    {
        try {
            $sum = 100000;
            $orderBy = "amount-desc";
            $data = $request->all();
            if (isset($data['sum'])){
                $sum = $data['sum'];
            }
            if (isset($data['orderBy'])){
                $orderBy = $data['orderBy'];
            }
            if (isset($data['cateIds'])){
                $cateIds = $data['cateIds'];
                $products = Product::whereIn('category_id', $cateIds)
                    ->select('id','price','amount')
                    ->limit(80)
                    ->get()->toArray();
            }
            else{
                $products = Product::select('id','price','amount')
                    ->limit(80)
                    ->get()->toArray();
            }
            $recommendIds = $service->flash_order($sum,$products);

            $col = explode('-',$orderBy)[0];
            $by = explode('-',$orderBy)[1];
            $recommendProducts = Product::whereIn('id',$recommendIds)
                ->orderBy($col, $by)
                ->get()->toArray();;

            return response()->json([
                'code' => 200,
                'message' => 'success',
                'products' => $recommendProducts,
            ]);
        }catch (Exception $exception){
            Log::error("Message: " . $exception->getMessage(). '----Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'failed',
                'products' => null
            ],500);
        }
    }
}
