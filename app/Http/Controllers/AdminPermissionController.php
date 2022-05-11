<?php

namespace App\Http\Controllers;

use App\Components\Recursive;
use App\Models\Category;
use App\Models\Permission;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;

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

    public function store_manual(Request $req):RedirectResponse
    {
        DB::table('permissions')->insert(
            [
                'name' => $req->name,
                'parent_id' => $req->parent_id,
                'display_name' => $req->display_name,
                'key_code' => $req->key_code
            ]
        );
        return redirect()->route('permissions.create-manual');
    }
    public function store(Request $req): RedirectResponse
    {
        $module = $req->module; //category.danh_muc
        $exploded = explode(".", $module);
        $moduleKey = $exploded[0]; //category
        $moduleValue = $exploded[1]; //danh_muc
        $module_display_name = str_replace('_', ' ', $moduleValue); //danh muc
        $parentPermission = Permission::firstOrCreate([
                'name' => $moduleKey,
                'parent_id' => 0,
                'display_name' => $module_display_name,
                'key_code' =>$moduleKey
        ]);
        foreach ($req->actions as $action) {
            $exploded = explode(".", $action);
            $action_name =  $exploded[0];
            $action_display_name = $exploded[1];
            if(str_contains($action_display_name, '_')){
                $action_display_name = str_replace('_', ' ', $exploded[1]); //danh muc
            }
            Permission::firstOrCreate([
                    'name' => $action_name. ' ' .$moduleKey,
                    'parent_id' => $parentPermission->id,
                    'display_name' => $action_display_name.' ' .$module_display_name,
                    'key_code' => $moduleKey . '_' .$action_name
            ]);
        }
        return redirect()->route('permissions.create');
    }

    public function create(){
        $modules = config('permissions.modules');
        return view('admin.permission.create', [
            'modules' => $modules
        ]);
    }
    public function create_manual(){
        $htmlCategoryOptions = $this->getAllCategories($parentId = '');
        return view('admin.permission.create-manual', [
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
