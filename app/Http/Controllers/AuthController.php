<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Language;
use App\Models\Licencetype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login form
    public function loginForm(){
        if(Auth::check()){
            return redirect('/dashboard');
        }
        return view('auth.login');
    }//end method


    //post login
    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password'=>'required'
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('user.dashboard');
        } else {
            return redirect()->back()->with('error','Oops! Your credentials do not match our records....')->withInput();
        }
    }//end method


    //dashboard
    public function dashboard(){
        return view('panel.dashboard');
    }//end method


    //logout
    public function logout(){
        Auth::logout();
        return redirect('/');
    }//end method


    //register form
    public function registerForm(){
        $languages = Language::all();
        $licencetypes = Licencetype::all();
        return view('auth.register',compact('languages','licencetypes'));
    }//end method


    //post register
    public function postRegister(Request $request){
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'licence_type_id'=>'required',
            'language_id'=>'required',
        ],[
            'licence_type_id.required'=>'The licence type field is required',
            'language_id.required'=>'The language field is required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->licence_type_id = $request->licence_type_id;
        $user->language_id = $request->language_id;
        $user->save();

        //go to dashboard
        if(Auth::attempt(['email'=>$user->email,'password'=>$request->password])){
            return redirect()->route('user.dashboard');
        }
    }//end method
}//end class
