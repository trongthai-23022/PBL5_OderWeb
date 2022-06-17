<?php

namespace App\Http\Controllers;

use App\Components\MenuRecursive;
use App\Components\Recursive;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CodeController extends Controller
{
    private $menu;
    public function __construct(Menu $menu)
    {
        $this->menu =$menu;
    }

    //
    public function  index(){
        return view('admin.menu.index', [
            'menus' => $this->menu->paginate(config('constants.pagination_records'))
        ]);
    }

    public function create(){
        $htmlMenus = $this->getAllMenus($parentId = '');
        return view('admin.menu.add', [
            'htmlOption' => $htmlMenus
        ]);
    }
    public function  store(Request $req): \Illuminate\Http\RedirectResponse
    {
        $this->menu->create([
            'name' => $req->name,
            'parent_id' => $req->parent_id,
            'slug' => Str::slug($req->name)
        ]);
        return redirect()->route('menus.create');
    }

    public function edit($id){
        $menu = $this->menu->find($id);
        $htmlMenu = $this->getAllMenus($menu->parent_id);
        return view('admin.menu.update', [
            'menu' => $menu,
            'htmlOption' => $htmlMenu
        ]);
    }
    public function update($id, Request $request){
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->slug)
        ]);
        return redirect()->route('menus.index');

    }
    public function delete($id){
        $this->menu->find($id)->delete();
        return redirect()->route('menus.index');

    }
    //
    private function getAllMenus($parentId): string
    {
        $data = $this->menu->all();
        $recursion = new Recursive($data);
        return  $recursion->selectRecursion($parentId);
    }
}
