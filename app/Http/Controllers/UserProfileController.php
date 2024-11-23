<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    //view profile
    public function index(){
        $user = Auth::user();
        $permission_profile = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','profile')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_profile)){
            return view('panel.profile.index',compact('user'));
        } else {
            return back();
        }
    }//end method



    //update profile
    public function updateProfile(Request $request){
        $user = Auth::user();

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

        //data update
        $user->name = $request->name;
        $user->country = $request->country;
        $user->zipcode = $request->zipcode;
        $user->mobile_number = $request->mobile_number;
        $user->address = $request->address;
        $user->save();

        return redirect()->back()->with('message','Profile Updated Successfully');

    }//end method


    //password edit form
    public function password(){
        $user = Auth::user();
        $permission_password = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','password')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_password)){
            return view('panel.profile.password',compact('user'));
        } else {
            return back();
        }

    }//end method



    //update password
    public function passwordUpdate(Request $request,$id){
        $request->validate([
            'current_password'=>'required|string',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string',
        ],[
            'password'=>'The new password field is required.'
        ]);

        $user = User::findOrFail($id);

          // Check if the provided current password matches the stored password
          if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password does not match.']);
        }

         // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('message', 'Password updated successfully.');

    }//end method
}//end class
