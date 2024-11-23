<?php

namespace App\Http\Controllers\Admin;

use App\Models\Licencetype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class LicencetypeController extends Controller
{
    //all licence type
    public function index(){
        $licencetypes = Licencetype::orderBy('id','desc')->get();

        $permission_licence_type = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','licencetype')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_licence_type)){
            return view('panel.licencetype.index',compact('licencetypes'));
        } else {
            return back();
        }

    }//end method


    //create
    public function create(){
        $permission_licence_type_create = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','createlicencetype')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_licence_type_create)){
            return view('panel.licencetype.create');
        } else {
            return back();
        }
    }//end method


    //store
    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:licencetypes',
        ]);

        $licencetype = new Licencetype();
        $licencetype->name = $request->name;
        $licencetype->save();

        return redirect()->route('licencetype.index')->with('message','Licence Type Created Successfully');
    }//end method


    //edit
    public function edit($id){
        $licencetype = Licencetype::find($id);

        $permission_edit_licence_type = DB::table('permission_roles')
                    ->where('role_id',Auth::user()->role_id)
                    ->join('permissions','permission_roles.permission_id','=','permissions.id')
                    ->where('permissions.slug','editlicencetype')
                    ->select('permissions.name')
                    ->first();

         if(!empty($permission_edit_licence_type)){
            return view('panel.licencetype.edit',compact('licencetype'));
         } else {
            return back();
         }
    }//end method


    //update
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required|unique:licencetypes,name,'.$id,
        ]);

        $licencetype = Licencetype::find($id);
        $licencetype->name = $request->name;
        $licencetype->save();

        return redirect()->route('licencetype.index')->with('message','Licence Type Updated Successfully');
    }//end method


    //delete
    public function delete($id){
        Licencetype::find($id)->delete();
        return redirect()->route('licencetype.index')->with('message','Licence Type Deleted Successfully');
    }//end method
}//en main
