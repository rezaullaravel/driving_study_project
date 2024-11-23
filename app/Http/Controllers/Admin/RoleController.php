<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class RoleController extends Controller
{
    //role list
    public function roles(){
        $roles = Role::all();

        $permission_role = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','role')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_role)){
            return view('panel.role.list',compact('roles'));
        } else {
            return back();
        }

    }//


    //role create
    public function roleCreate(){
        $permissions = Permission::select('groupby', \DB::raw('GROUP_CONCAT(id) as ids'), \DB::raw('GROUP_CONCAT(name) as names'), \DB::raw('GROUP_CONCAT(slug) as slugs'))
        ->groupBy('groupby')
        ->get();

        $permission_role_create = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','createrole')
            ->select('permissions.name')
            ->first();

            if(!empty($permission_role_create)){
                return view('panel.role.create',compact('permissions'));
            } else {
                return back();
            }
    }//end method


    //store role with permission
    public function roleStore(Request $request){
        $request->validate([
            'name'=>'required',
        ]);
         // insert the new role name
            $role = new Role();
            $role->name = $request->name;
            $role->save();

            // Insert new permissions
            if (!empty($request->permissions)) {
                foreach ($request->permissions as $permission_id) {
                    PermissionRole::create([
                        'role_id' =>  $role->id,
                        'permission_id' => $permission_id,
                    ]);
                }
            }

    return redirect('/roles')->with('message', 'Role Created Successfully.');
    }//end method


    //role edit
    public function roleEdit($id){
        $role = Role::find($id);

        // Get the existing permissions for the role
        $existingPermissions = PermissionRole::where('role_id', $id)->pluck('permission_id')->toArray();

        $permissions = Permission::select('groupby', \DB::raw('GROUP_CONCAT(id) as ids'), \DB::raw('GROUP_CONCAT(name) as names'), \DB::raw('GROUP_CONCAT(slug) as slugs'))
        ->groupBy('groupby')
        ->get();

        $permission_role_edit = DB::table('permission_roles')
                    ->where('role_id',Auth::user()->role_id)
                    ->join('permissions','permission_roles.permission_id','=','permissions.id')
                    ->where('permissions.slug','editrole')
                    ->select('permissions.name')
                    ->first();
        if(!empty($permission_role_edit)){
            return view('panel.role.edit',compact('role','permissions','existingPermissions'));
        } else {
            return back();
        }

    }// end method



  //role permission update
  public function rolePermissionStore(Request $request, $id) {

    // Update the role name
    $role = Role::find($id);
    $role->name = $request->name;
    $role->save();

    // Remove existing permissions for the role
    PermissionRole::where('role_id', $id)->delete();

    // Insert new permissions
    if (!empty($request->permissions)) {
        foreach ($request->permissions as $permission_id) {
            PermissionRole::create([
                'role_id' => $id,
                'permission_id' => $permission_id,
            ]);
        }
    }

    return redirect('/roles')->with('message', 'Permissions updated successfully.');
}//end method


//role delete
public function roleDelete($id){
    $role = Role::find($id);
    $user = User::where('role_id',$role->id)->first();
    if(!empty($user)){
        return redirect()->back()->with('error','This role can not be  deleted becaus it is related to other data..');
    } else {
      $role->delete();
    }
    return redirect('/roles')->with('message', 'Role deleted successfully.');
}//end method

}//end class
