<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Dotenv\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    use DeleteModelTrait;

    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $users = $this->user->latest()->paginate(config('constants.pagination_records'));
        return view('admin.user.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('admin.user.create', ['roles' => $roles]);
    }

    public function store(UserAddRequest $request): RedirectResponse
    {

        try {
            DB::beginTransaction();
            $user = $this->user->forceCreate([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => now(),
            ]);
            $roleIds = $request->role_ids;
            $user->roles()->attach($roleIds);
            DB::commit();
            $resMessage = 'Thêm thành công!';
            return redirect()->route('users.create')->with('success', $resMessage);
        } catch (\Exception $exc) {
            DB::rollBack();
            Log::error('Message: ' . $exc->getMessage() . '----Line: ' . $exc->getLine());
            $resMessage = 'Thêm thất bại!';
            return redirect()->route('users.create')->with('failure', $resMessage);
        }
    }

    public function edit($id)
    {
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $user_role = $user->roles;
        return view('admin.user.edit', ['roles' => $roles, 'user' => $user, 'user_role' => $user_role]);
    }

    public function update($id, UserUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $userUpdate = $this->user->find($id);
            $res = $userUpdate->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $roleIds = $request->role_ids;
            $userUpdate->roles()->sync($roleIds);
            DB::commit();
            $resMessage = 'Sửa thành công!';
            return redirect()->route('users.index')->with('success', $resMessage);
        } catch (\Exception $exc) {
            DB::rollBack();
            $resMessage = 'Sửa thất bại!';
            Log::error('Message: ' . $exc->getMessage() . '----Line: ' . $exc->getLine());
            return redirect()->route('users.edit')->with('failure', $resMessage);
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->user);
    }
}
