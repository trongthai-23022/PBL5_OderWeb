<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Http\Services\Product\CategoryService;
use App\Http\Services\Product\ProductService;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\isEmpty;


class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    private $product;
    private $rate;


    public function __construct(ProductService $productService, CategoryService $categoryService, Product $product, Rate $rate)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->product = $product;
        $this->rate = $rate;
    }

    public function detail($id)
    {
        $product = $this->productService->show($id);
        return view('SuperKay.products.detail', [
            'product' => $product,
        ]);
    }

    public function product_comment(Request $request): \Illuminate\Http\RedirectResponse
    {
        $product_id = $request->product_id;
        $rateValue = $request->rating;
        try {
            DB::beginTransaction();
            $comment= Comment::where('user_id', Auth::id())->where('product_id',$product_id)->first();
            if(is_null($comment)){
                $newCommentData = [
                    'user_id' => Auth::user()->id,
                    'product_id' => $product_id,
                    'content' => $request->comment,
                ];
                if (!empty($request->parent_id)) {
                    $newCommentData['parent_id'] = $request->parent_id;
                }
                $newComment =  Comment::create($newCommentData);
                if(!is_null($rateValue)){
                    Rate::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $product_id,
                        'comment_id' => $newComment->id,
                        'rate_value' => $rateValue
                    ]);
                }
            }
            else{
                $comment->update(['content' => $request->comment]);
                if(!is_null($rateValue)){
                    $rate= Rate::where('comment_id',$comment->id)->first();
                    $rate->update(['rate_value' => $rateValue]);
                }
            }


            DB::commit();
            $resMessage = 'Cảm ơn đã bình luận!';
            return redirect()->route('detail', $product_id)->with('success', $resMessage);
        } catch (\Exception $exception) {
            $resMessage = 'Bình luận thất bại!';
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return redirect()->route('detail', $product_id)->with('failure', $resMessage);

        }
    }

    public function shop()
    {

        return view('SuperKay.products.shop', [
        ]);
    }

    public function category_products(Request $request, $id)
    {
        $category = $this->categoryService->getId($id);
        $products = $this->categoryService->getProduct($category, $request);
        return view('SuperKay.products.listProduct', [
            'products' => $products,
            'category' => $category
        ]);
    }

}
