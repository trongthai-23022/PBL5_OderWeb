<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleAddRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class AdminRoleController extends Controller
{
    use DeleteModelTrait;
    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $roles = $this->role->paginate(config('constants.pagination_records'));
        return view('admin.role.index', ['roles' => $roles]);
    }

    public function create()
    {
        $parentPermissions = Permission::where('parent_id', 0)->get();
        return view('admin.role.create', ['parent_permissions' => $parentPermissions]);
    }

    public function store(RoleAddRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $newRole = $this->role->create([
                'name' => $request->name,
                'display_name' => $request->description
            ]);
            $newRole->permissions()->attach($request->permission_id);
            DB::commit();
            $resMessage = 'Thêm thành công!';
            return redirect()->route('roles.create')->with('success',$resMessage);
        } catch (\Exception $exc) {
            DB::rollBack();
            $resMessage = 'Thêm thất bại!';
            return redirect()->route('roles.create')->with('failure',$resMessage);
            Log::error('Message: ' . $exc->getMessage() . '----Line: ' . $exc->getLine());
        }
    }

    public function edit($id)
    {
        $role = $this->role->find($id);
        $parentPermissions = $this->permission->where('parent_id', 0)->get();
        $checkedPermission = $role->permissions;
        return view('admin.role.edit', [
            'role' => $role,
            'parent_permissions' => $parentPermissions,
            'checked_permission' => $checkedPermission
        ]);
    }

    public function update($id, RoleUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $updateRole = $this->role->find($id);

            $updateRole->update([
                'name' => $request->name,
                'display_name' => $request->description
            ]);
            $updateRole->permissions()->sync($request->permission_id);
            DB::commit();
            $resMessage = 'Sửa thành công!';
            return redirect()->route('roles.index')->with('success',$resMessage);;
        } catch (\Exception $exc) {
            DB::rollBack();
            $resMessage = 'Sửa thất bại!';
            return redirect()->route('roles.index')->with('failure',$resMessage);
            Log::error('Message: ' . $exc->getMessage() . '----Line: ' . $exc->getLine());
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->role);
    }
}
