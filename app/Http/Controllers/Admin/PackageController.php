<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PackageController extends Controller
{
    //package list
    public function index(){
        $packages = Package::orderBy('id','desc')->get();
        $permission_package_list = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','packages')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_package_list)){
            return view('panel.package.index',compact('packages'));
        } else {
            return back();
        }

    }//end method



    //create form
    public function create(){
        $permission_package_create = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','createpackage')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_package_create)){
            return view('panel.package.create');
        } else {
            return back();
        }

    }//end method


    //store
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'banner' => 'required',
            'description' => 'required',
            'price' => 'required',
            'selling_price' => 'required',
            'duration_value' => 'required|integer|min:1',
            'duration_unit' => 'required|in:day,month,year',
            'status' => 'required|boolean',
        ]);


         //banner upload
         if($request->file('banner')){
            $image = $request->file('banner');
            $imageName = rand().'.'.$image->getClientOriginalName();
            //Image::make($image)->resize(620,620)->save('upload/user_images/'.$imageName);
             $image->move(public_path('upload/package_images'), $imageName);
            $image_path = 'upload/package_images/'.$imageName;
        }

        $package = new Package();
        $package->name = $request->name;

        $package->slug = Str::slug($request->name);

        $package->banner = $image_path;

        $package->description = $request->description;

        $package->price = $request->price;

        $package->selling_price = $request->selling_price;

        $package->duration_value = $request->duration_value;

        $package->duration_unit = $request->duration_unit;

        $package->status = $request->status;

        $package->save();

        return redirect()->route('package.index')->with('message', 'Package created successfully.');
    }//end method



    //edit form
    public function edit($id){
        $package = Package::find($id);

        $permission_package_edit = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','editpackage')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_package_edit)){
            return view('panel.package.edit',compact('package'));
        } else {
            return back();
        }
    }//end method


    //update
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required',
            'selling_price' => 'required',
            'duration_value' => 'required|integer|min:1',
            'duration_unit' => 'required|in:day,month,year',
            'status' => 'required|boolean',
        ]);

        $package = Package::find($id);


         //banner upload
         if($request->file('banner')){
            if(File::exists($package->banner)){
                unlink($package->banner);
            }
            $image = $request->file('banner');
            $imageName = rand().'.'.$image->getClientOriginalName();
            //Image::make($image)->resize(620,620)->save('upload/user_images/'.$imageName);
             $image->move(public_path('upload/package_images'), $imageName);
            $image_path = 'upload/package_images/'.$imageName;

            $package->banner =  $image_path;
        }

        //data update
        $package->name = $request->name;

        $package->slug = Str::slug($request->name);

        $package->description = $request->description;

        $package->price = $request->price;

        $package->selling_price = $request->selling_price;

        $package->duration_value = $request->duration_value;

        $package->duration_unit = $request->duration_unit;

        $package->status = $request->status;

        $package->save();

        return redirect()->route('package.index')->with('message', 'Package updated successfully.');
    }//end method


    //view package details
    public function view($id){
        $package = Package::find($id);

        $permission_package_view = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','viewpackage')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_package_view)){
            return view('panel.package.view',compact('package'));
        } else {
            return back();
        }
    }//end method


    //delete package
    public function delete($id){
        $package = Package::find($id);

        $permission_package_delete = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','deletepackage')
            ->select('permissions.name')
            ->first();

         if(!empty($permission_package_delete)){
            if(File::exists($package->banner)){
                unlink($package->banner);
            }
            $package->delete();
            return redirect()->back()->with('message','Package deleted successfully');
         } else {
            return back();
         }

    }//end method
}//end class
