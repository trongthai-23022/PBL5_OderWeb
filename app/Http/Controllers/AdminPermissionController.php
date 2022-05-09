<?php

namespace App\Http\Controllers;

use App\Components\Recursive;
use App\Models\Category;
use App\Models\Permission;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminPermissionController extends Controller
{
    use DeleteModelTrait;
    private  $permission;

    public  function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }


    public function index(){
        $permissions = $this->permission->orderBy('key_code', 'desc');
        return view('admin.permission.index', [
            'permissions' => $permissions->paginate(config('constants.pagination_records'))
        ]);
    }

    public function store(Request $req): \Illuminate\Http\RedirectResponse
    {
        DB::table('permissions')->insert(
            [
                'name' => $req->name,
                'parent_id' => $req->parent_id,
                'display_name' => $req->display_name,
                'key_code' => $req->key_code
            ]
        );
        return redirect()->route('permissions.create');
    }

    public function create(){
        $htmlCategoryOptions = $this->getAllCategories($parentId = '');
        return view('admin.permission.create', [
            'htmlOption' => $htmlCategoryOptions
        ]);
    }
    public function edit($id){
        $permission = $this->permission->find($id);
        $htmlCategoryOptions = $this->getAllCategories($permission->parent_id);
        return view('admin.permission.edit', [
            'permission' => $permission,
            'htmlOption' => $htmlCategoryOptions
        ]);

    }
    public function update($id, Request $request){
        $this->permission->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'display_name' => $request->display_name,
            'key_code' => $request->key_code
        ]);
        return redirect()->route('permissions.index');

    }

    public function delete($id){
        return $this->deleteModelTrait($id, $this->permission);
    }


    //
    private function getAllCategories($parentId): string
    {
        $data = $this->permission->all();
        $recursion = new Recursive($data);
        return  $recursion->selectRecursion($parentId);
    }
}
