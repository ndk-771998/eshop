<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    use DeleteModelTrait;
    protected $user, $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $users = $this->user->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->role->all();

        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $userCreated = $this->user->create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]); 
            $roles = $request['role_id'];
            foreach($roles as $role){
                DB::table('role_user')->insert([
                    'role_id' => $role,
                    'user_id' => $userCreated->id,
                ]);
            }
            DB::commit();

            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . ' ----- Line ' . $exception->getLine());
        }
    }

    public function edit ($id)
    {
        $user = $this->user->findOrFail($id);
        $roles = $this->role->all();
        $rolesOfUser = $user->roles;

        return view('admin.user.edit', compact('user', 'roles', 'rolesOfUser'));
    }

    public function update (Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $userCreated = $this->user->find($id)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]); 
            $user = $this->user->find($id);
            $user->roles()->sync($request->role_id);
            DB::commit();

            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . ' ----- Line ' . $exception->getLine());
        }
    }

    public function delete ($id)
    {
        return $this->deleteModelTrait($id, $this->user);
    }
}
