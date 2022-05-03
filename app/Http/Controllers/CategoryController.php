<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recursive;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    private  $category;

    public  function __construct(Category $category)
    {
        $this->category = $category;
    }


     public function index(){
         return view('admin.category.index', [
             'categories' => $this->category->latest()->paginate(5)
         ]);
     }

     public function store(Request $req): \Illuminate\Http\RedirectResponse
     {
         DB::table('categories')->insert(
             [
                 'name' => $req->name,
                 'parent_id' => $req->parent_id,
                 'slug' => Str::slug($req->name)
             ]
         );
        return redirect()->route('categories.create');
     }

    public function create(){
        $htmlCategoryOptions = $this->getAllCategories($parentId = '');
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
    public function update($id, Request $request){
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->slug)
        ]);
        return redirect()->route('categories.index');

    }

    public function delete($id){
        $this->category->find($id)->delete();
        return redirect()->route('categories.index');
    }


    //
    private function getAllCategories($parentId): string
    {
        $data = $this->category->all();
        $recursion = new Recursive($data);
        return  $recursion->categoryRecursion($parentId);
    }
}
