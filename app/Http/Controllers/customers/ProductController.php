<?php

namespace App\Http\Controllers\customers;

use App\Components\Recursive;
use App\Http\Controllers\Controller;
use App\Http\Services\Product\CategoryService;
use App\Http\Services\Product\ProductService;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;



class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    private $product;
    private $category;


    public function __construct(ProductService $productService,
                                CategoryService $categoryService,
                                Product $product,
                                Category $category
    )
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->product = $product;;
        $this->category = $category;
    }

    public function index(Request $request, $id)
    {
//        dd($request->search);
        $search = $request->search;
//        dd($id);
        if($id == 0){
            $cateProducts = DB::table('products')
                ->where('name','like','%'.$search.'%')
                ->paginate(12);
            $cateNameDisplay = "Tất cả các món";
        }
        else{
            $cateName = Category::where('id', $id)->pluck('name');
            $cateNameDisplay = 'Các món ' . $cateName[0];
            $cateProducts = DB::table('products')
                ->join('categories', function ($join) use ($id) {
                    $join->on('products.category_id', '=', 'categories.id')
                        ->where('categories.id', '=', $id);
                })
                ->select('products.*', 'categories.id')
                ->where('products.name','like','%'.$search.'%')
                ->paginate(12);

        }
        $parentCates = $this->category->where('parent_id', 0)->get();

        return view('Shop.shop.index', [
            'parentCates' => $parentCates,
            'search' => $search,
            'cateProducts' => $cateProducts,
            'cateName' => Str::upper($cateNameDisplay),
        ]);
    }
//    public function index(Request $request)
//    {
//
//        (!is_null($request->category_id))?$cateID = $request->category_id:$cateID = null;
//        (!is_null($request->sort_by))?$sortBy = $request->sort_by: $sortBy = 'created_at-desc';
//        (!is_null($request->q))?$search = $request->q: $search ='';
//
//        $sortColumn = explode('-', $sortBy)[0];
//        $sortDirection = explode('-', $sortBy)[1];
//        if (is_null($cateID)) {
//            $productsList = Product::query()
//                ->where('name', 'like', '%' . $search . '%')
//                ->orWhere('created_at', 'like', '%' . $search . '%')
//                ->orWhere('price', '>=', $search )
//                ->orderBy($sortColumn, $sortDirection)
//                ->paginate(config('constants.pagination_records'));
//            $htmlCategoryOptions = $this->getAllCategories($parent_id = '');
//        } else {
//            $productsList = Product::query()
//                ->where('category_id', '=', $cateID)
//                ->where(function ($query) use ($cateID,$search){
//                    $query->where('name', 'like', '%' . $search . '%')
//                        ->orWhere('created_at', 'like', '%' . $search . '%')
//                        ->orWhere('price', '>=', $search );
//                })
//                ->orderBy($sortColumn, $sortDirection)
//                ->paginate(config('constants.pagination_records'));
//            $htmlCategoryOptions = $this->getAllCategories($cateID);
//        }
//
//        $productsList->appends([
//            'q' => $search,
//            'category_id' => $cateID,
//            'sort_by' => $sortBy,
//        ]);
//
//        return view('admin.product.index', [
//            'parentCates' => $parentCates,
//            'products' => $productsList,
//            'search' => $search,
//            'cate_options' => $htmlCategoryOptions,
//            'sort_by' => $sortBy,
//        ]);
//    }

    public function detail($id)
    {
        $product = $this->productService->show($id);
        $rates = $this->product->where('id', $id)->first()->rates;
        $ratesCount = $rates->count('rate_value');
        $ratesAvg = $rates->avg('rate_value');
        return view('Shop.shop.detail', [
            'product' => $product,
            'ratesAvg' => number_format($ratesAvg,1),
            'ratesCount' => $ratesCount,
        ]);
    }

    public function product_comment(Request $request): \Illuminate\Http\RedirectResponse
    {
        $product_id = $request->product_id;
        $rateValue = $request->rating;
        $productName = $this->product->where('id', $product_id)->pluck('name');
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
            return redirect()->route('detail',[
                'id' => $product_id,
                'slug' => Str::slug($productName)
            ]);


        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return redirect()->route('detail',[
                'id' => $product_id,
                'slug' => Str::slug($productName)
            ]);

        }
    }


    public function category_products(Request $request, $id)
    {
        $category = $this->categoryService->getId($id);
        $products = $this->categoryService->getProduct($category, $request);
        return view('Shop.shop.listProduct', [
            'products' => $products,
            'category' => $category
        ]);
    }

    private function getAllCategories($parentId): string
    {
        $data = $this->category->all();
        $recursion = new Recursive($data);
        return  $recursion->selectRecursion($parentId);
    }

}
