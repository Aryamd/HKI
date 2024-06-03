<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $data = User::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role_name', function($row) {
                    $roleName = "";
                    foreach ($row->getRoleNames() as $role) {
                        $roleName .= '<span class="badge bg-success rounded-pill">'.$role.'</span><br>';
                    }
                    return $roleName;
                })
                ->addColumn('action', function($row) {
                    $action = '<a class="btn btn-info btn-xs waves-effect waves-light" href="'.route('user.show', $row->id).'">Show</a>
                            <a class="btn btn-warning btn-xs waves-effect waves-light" href="'.route('user.edit', $row->id).'">Edit</a>
                            <form class="d-inline" action="'.route('user.destroy', $row->id).'" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm(\'Anda yakin ingin menghapus?\')">Delete</button>
                            </form>';
                    return $action;
                })
                ->rawColumns(['role_name','action'])
                ->make();
        }

        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('user.create')
            ->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->validated());
        $user->assignRole($request->input('roles'));

        return redirect()->route('user.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('user.show')
            ->with('user', $user)
            ->with('roles', $roles)
            ->with('userRole', $userRole);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('user.edit')
            ->with('user', $user)
            ->with('roles', $roles)
            ->with('userRole', $userRole);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->validated());
        $user->roles()->detach();
        $user->assignRole($request->input('roles'));

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully');
    }
}
