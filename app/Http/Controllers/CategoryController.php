<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryAddRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use App\Components\Recursive;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    use DeleteModelTrait;
    private  $category;
    public  function __construct(Category $category)
    {
        $this->category = $category;
    }


     public function index(){
         return view('admin.category.index', [
             'categories' => $this->category->latest()->paginate(config('constants.pagination_records'))
         ]);
     }

     public function store(CategoryAddRequest $req): RedirectResponse
     {
         try {
             DB::beginTransaction();
             DB::table('categories')->insert(
                 [
                     'name' => $req->name,
                     'parent_id' => $req->parent_id,
                     'slug' => Str::slug($req->name)
                 ]
             );
             DB::commit();
             $responseMessage = 'Thêm thành công!';
             return redirect()->route('categories.create')->with('success',$responseMessage);
         } catch (\Exception $exception) {
             DB::rollBack();
             $responseMessage = 'Thêm thất bại!';
             Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
             return redirect()->route('categories.create')->with('failure',$responseMessage);
         }
     }

    public function create(){
        $htmlCategoryOptions = $this->getParentCategories($parentId='');
        return view('admin.category.create', [
            'htmlOption' => $htmlCategoryOptions
        ]);
    }
    public function edit($id){
        $category = $this->category->find($id);
        $htmlCategoryOptions = $this->getAllCategories($category->parent_id);
        return view('admin.category.edit', [
            'category' => $category,
            'htmlOption' => $htmlCategoryOptions
        ]);

    }
    public function update($id, CategoryUpdateRequest $request){
        try {
            DB::beginTransaction();
            $this->category->find($id)->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->slug)
            ]);
            DB::commit();
            $responseMessage = 'Sửa thành công!';
            return redirect()->route('categories.index')->with('success',$responseMessage);
        }
        catch (\Exception $exception){
            DB::rollBack();
            $responseMessage = 'Sửa thất bại!';
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return redirect()->route('categories.index')->with('failure',$responseMessage);
        }
    }

    public function delete($id){
        return $this->deleteModelTrait($id, $this->category);
    }


    //
    private function getAllCategories($parentId): string
    {
        $data = $this->category->all();
        $recursion = new Recursive($data);
        return  $recursion->selectRecursion($parentId);
    }
    private function getParentCategories($parentId): string
    {
        $data = $this->category->all();
        $recursion = new Recursive($data);
        return  $recursion->selectRecursion($parentId,0,'',true);
    }
}
