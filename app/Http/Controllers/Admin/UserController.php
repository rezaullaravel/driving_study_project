<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Language;
use App\Models\Licencetype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function usesrs(){
        $users = User::all();
        $permission_user = DB::table('permission_roles')
                  ->where('role_id',Auth::user()->role_id)
                  ->join('permissions','permission_roles.permission_id','=','permissions.id')
                  ->where('permissions.slug','user')
                  ->select('permissions.name')
                  ->first();
        //check if the user has permission to access this page or not
        if(!empty($permission_user)){
            return view('panel.user.list',compact('users'));
        } else {
            return back();
        }
    }//end method


    //create
    public function create(){
        $languages = Language::all();
        $roles = Role::all();
        $licencetypes = Licencetype::all();
        $permission_create_user = DB::table('permission_roles')
                  ->where('role_id',Auth::user()->role_id)
                  ->join('permissions','permission_roles.permission_id','=','permissions.id')
                  ->where('permissions.slug','createuser')
                  ->select('permissions.name')
                  ->first();
        if(!empty($permission_create_user)){
            return view('panel.user.create',compact('languages','roles','licencetypes'));
        } else {
         return back();
        }
    }//end method

    //store
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required',
            'role_id'=>'required',
            'language_id'=>'required',
            'licence_type_id'=>'required'
        ],[
            'role_id.required'=>'The role field is required.',
            'language_id.required'=>'The language field is required.',
            'licence_type_id.required'=>'The licence type field is required.',
        ]);

        //user image upload
        if($request->file('image')){
            $image = $request->file('image');
            $imageName = rand().'.'.$image->getClientOriginalName();
            //Image::make($image)->resize(620,620)->save('upload/user_images/'.$imageName);
             $image->move(public_path('upload/user_images'), $imageName);
            $image_path = 'upload/user_images/'.$imageName;
        }

        //insert data
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->language_id = $request->language_id;
        $user->licence_type_id = $request->licence_type_id;
        if(!empty($request->country)){
            $user->country = $request->country;
        }

        if(!empty($request->zipcode)){
            $user->zipcode = $request->zipcode;
        }

        if(!empty($request->mobile_number)){
            $user->mobile_number = $request->mobile_number;
        }

        if(!empty($request->address)){
            $user->address = $request->address;
        }

        $user->image = $image_path;
        $user->save();

        return redirect()->route('users')->with('message','User Created Successfully');
    }//end method


    //edit user
    public function edit($id){
        $user = User::find($id);
        $languages = Language::all();
        $roles = Role::all();
        $licencetypes = Licencetype::all();
        $permission_edit_user = DB::table('permission_roles')
                  ->where('role_id',Auth::user()->role_id)
                  ->join('permissions','permission_roles.permission_id','=','permissions.id')
                  ->where('permissions.slug','edituser')
                  ->select('permissions.name')
                  ->first();
        //check if the user has permission to access this page or not
        if(!empty($permission_edit_user)){
            return view('panel.user.edit',compact('user','languages','roles','licencetypes'));
        } else {
            return back();
        }
    }//end method


    //update
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'role_id'=>'required',
            'language_id'=>'nullable',
            'licence_type_id'=>'nullable'
        ],[
            'role_id.required'=>'The role field is required.',
            'language_id.required'=>'The language field is required.',
            'licence_type_id.required'=>'The licence type field is required.',
        ]);

        //fetch the user that we want to update
        $user = User::find($id);

        //user image upload
        if($request->file('image')){
            if(File::exists($user->image)){
                unlink($user->image);
            }
            $image = $request->file('image');
            $imageName = rand().'.'.$image->getClientOriginalName();
            //Image::make($image)->resize(620,620)->save('upload/user_images/'.$imageName);
             $image->move(public_path('upload/user_images'), $imageName);
            $image_path = 'upload/user_images/'.$imageName;

            $user->image =  $image_path;
        }

        //update data
        $user->name = $request->name;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->role_id = $request->role_id;
        if(!empty($request->language_id)){
            $user->language_id = $request->language_id;
        }

        if(!empty($request->licence_type_id)){
            $user->licence_type_id = $request->licence_type_id;
        }

        if(!empty($request->country)){
            $user->country = $request->country;
        }

        if(!empty($request->zipcode)){
            $user->zipcode = $request->zipcode;
        }

        if(!empty($request->mobile_number)){
            $user->mobile_number = $request->mobile_number;
        }

        if(!empty($request->address)){
            $user->address = $request->address;
        }

        $user->save();

        return redirect()->route('users')->with('message','User Updated Successfully');

    }//end method


    //delete
    public function delete($id){
         $user = User::find($id);
         if(File::exists($user->image)){
            unlink($user->image);
        }

        $user->delete();
        return redirect()->route('users')->with('message','User Deleted Successfully');
    }//end method
}//end class
