<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserAddRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
    public function index(){
        $users = $this->user->latest()->paginate(config('constants.pagination_records'));
        return view('admin.user.index',['users'=>$users]);
    }
    public function create(){
        $roles = $this->role->all();
        return  view('admin.user.create', ['roles'=>$roles]);
    }

    public function store(Request $request)
    {

        try{
            //        $validated = $request->validated();
        DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email'=> $request->email,
                'password'=> Hash::make($request->password)
            ]);
            $roleIds = $request->role_ids;
            $user->roles()->attach($roleIds);
        DB::commit();
            return redirect()->route('users.create');
        }
        catch (\Exception $exc){
            DB::rollBack();
            Log::error('Message: ' . $exc->getMessage() . '----Line: ' . $exc->getLine());
        }
    }

    public function edit($id)
    {
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $user_role = $user->roles;
        return view('admin.user.edit',['roles'=>$roles, 'user'=>$user, 'user_role'=>$user_role]);
    }

    public function update($id, Request $request)
    {
        try{
            //        $validated = $request->validated();
            DB::beginTransaction();
            $userUpdate = $this->user->find($id);
            $res = $userUpdate->update([
                'name' => $request->name,
                'email'=> $request->email,
                'password'=> Hash::make($request->password)
            ]);
            $roleIds = $request->role_ids;
            $userUpdate->roles()->sync($roleIds);
            DB::commit();
            return redirect()->route('users.index');
        }
        catch (\Exception $exc){
            DB::rollBack();
            Log::error('Message: ' . $exc->getMessage() . '----Line: ' . $exc->getLine());
        }
    }
    public function delete($id)
    {
       return $this->deleteModelTrait($id, $this->user);
    }
}
