<?php

namespace App\Http\Controllers;

use App\Components\Recursive;
use App\Http\Requests\PermissionAddRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Models\Category;
use App\Models\Permission;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;

class AdminPermissionController extends Controller
{
    use DeleteModelTrait;

    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }


    public function index()
    {
        $permissions = $this->permission->orderBy('key_code', 'desc');
        return view('admin.permission.index', [
            'permissions' => $permissions->paginate(config('constants.pagination_records'))
        ]);
    }


    public function store(Request $req): RedirectResponse
    {
        try {
            $module = $req->module; //category.danh_muc
            $exploded = explode(".", $module);
            $moduleKey = $exploded[0]; //category
            $moduleValue = $exploded[1]; //danh_muc
            $module_display_name = str_replace('_', ' ', $moduleValue); //danh muc
            $parentPermission = Permission::firstOrCreate([
                'name' => $moduleKey,
                'parent_id' => 0,
                'display_name' => $module_display_name,
                'key_code' => $moduleKey
            ]);
            foreach ($req->actions as $action) {
                $exploded = explode(".", $action);
                $action_name = $exploded[0];
                $action_display_name = $exploded[1];
                if (str_contains($action_display_name, '_')) {
                    $action_display_name = str_replace('_', ' ', $exploded[1]); //danh muc
                }
                Permission::firstOrCreate([
                    'name' => $action_name . ' ' . $moduleKey,
                    'parent_id' => $parentPermission->id,
                    'display_name' => $action_display_name . ' ' . $module_display_name,
                    'key_code' => $moduleKey . '_' . $action_name
                ]);
            }
            $resMessage = 'Thêm thành công!';
            return redirect()->route('permissions.create')->with('success', $resMessage);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            $resMessage = 'Thêm thất bại!';
            return redirect()->route('permissions.create')->with('failure', $resMessage);
        }
    }

    public function create()
    {
        $modules = config('permissions.modules');
        return view('admin.permission.create', [
            'modules' => $modules
        ]);
    }



    public function edit($id)
    {
        $permission = $this->permission->find($id);
        $htmlCategoryOptions = $this->getAllCategories($permission->parent_id);
        return view('admin.permission.edit', [
            'permission' => $permission,
            'htmlOption' => $htmlCategoryOptions
        ]);

    }

    public function update($id, PermissionUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->permission->find($id)->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'display_name' => $request->description,
                'key_code' => $request->key_code
            ]);
            DB::commit();
            $resMessage = 'Thêm thành công!';
            return redirect()->route('permissions.index')->with('success', $resMessage);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            $resMessage = 'Thêm thất bại!';
            return redirect()->route('permissions.index')->with('failure', $resMessage);
        }

    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->permission);
    }


    //
    private function getAllCategories($parentId): string
    {
        $data = $this->permission->all();
        $recursion = new Recursive($data);
        return $recursion->selectRecursion($parentId);
    }
}
