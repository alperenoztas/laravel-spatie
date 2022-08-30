<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Database\Seeders\RoleSeeder;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::whereNotIn('name',['admin'])->get();
        return view('admin.roles.index',compact('roles'));
    }

    public function create(){
        return view('admin.roles.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3'
        ]);

        Role::create($validated);


        return to_route('admin.roles.index')->with('message','Role Created Succesfully');
    }

    public function edit(Role $role){

        $permissions = Permission::all();
        return view('admin.roles.edit',compact('role','permissions'));
    }

    public function update(Request $request,Role $role){
        $validated = $request->validate([
            'name' => 'required|min:3'
        ]);

        $role->update($validated);
        return to_route('admin.roles.index')->with('message','Role Updated Succesfully');
    }

    public function destroy(Role $role){
        $role->delete();
        return to_route('admin.roles.index')->with('message','Role Deleted Succesfully');
    }

    public function givePermission(Request $request, Role $role){

        if($role->hasPermissionTo($request->permission)){
            return back()->with('message','Permission Already Assigned');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message','Permission Assigned');
    }

    public function revokePermission(Role $role,Permission $permission){
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message','Permission Revoked');
        }
        return back()->with('message','Permission Not Assigned');
    }
}
