<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $nItemPerPage = 10;
        $roles = Role::orderBy('id', 'DESC')->paginate($nItemPerPage);
        $this->validate($request, [
            'page' => 'numeric'
        ]);

        return view('role.index')
            ->with('roles', $roles)
            ->with('i', ($request->input('page', 1) - 1) * $nItemPerPage);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = Permission::get();
        return view('role.create')
            ->with('permission', $permission);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->validated());
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('role.index')
            ->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('role.show')
            ->with('role', $role)
            ->with('rolePermissions', $rolePermissions);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('role.edit')
            ->with('role', $role)
            ->with('permission', $permission)
            ->with('rolePermissions', $rolePermissions);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $role = Role::find($id);
        $role->update($request->validated());
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('role.index')
            ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::find($id)->delete();
        return redirect()->route('role.index')
            ->with('success','Role deleted successfully');
    }
}
