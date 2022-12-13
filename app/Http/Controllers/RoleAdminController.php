<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Log;

class RoleAdminController extends Controller
{
    protected $role, $permission;
    use DeleteModelTrait;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $roles = $this->role->paginate(10);

        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissionParents = $this->permission->where('parent_id', 0)->get();

        return view('admin.role.create', compact('permissionParents'));
    }

    public function store(Request $request)
    {

        try {
            FacadesDB::beginTransaction();
            $roleCreated = $this->role->create([
                'name' => $request['name'],
                'display_name' => $request['display_name'],
            ]);

            $roleCreated->permissions()->attach($request->permission_id);
            FacadesDB::commit();

            return redirect()->route('role.index');
        } catch (\Exception $exception) {
            FacadesDB::rollBack();
            Log::error('Message :' . $exception->getMessage() . ' ----- Line ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $role = $this->role->find($id);
        $permissionParents = $this->permission->where('parent_id', 0)->get();
        $permissionChecked = $role->permissions;

        return view('admin.role.edit', compact('role', 'permissionParents', 'permissionChecked'));
    }

    public function update(Request $request, $id)
    {
        try {
            FacadesDB::beginTransaction();
            $this->role->find($id)->update([
                'name' => $request['name'],
                'display_name' => $request['display_name'],
            ]);
            $roleUpdated = $this->role->find($id);
            $roleUpdated->permissions()->sync($request->permission_id);
            FacadesDB::commit();

            return redirect()->route('role.index');
        } catch (\Exception $exception) {
            FacadesDB::rollBack();
            Log::error('Message :' . $exception->getMessage() . ' ----- Line ' . $exception->getLine());
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->role);
    }
}
