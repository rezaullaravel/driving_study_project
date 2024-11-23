<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Language;
use App\Models\ChapterGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    //chapter list
    public function index(){
        //$chapters = Chapter::with('chapterGroup')->get();
        $chapters = ChapterGroup::all();
        $permission_chapter_list = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','chapter')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_chapter_list)){
            return view('panel.chapter.index',compact('chapters'));
        } else {
            return back();
        }

    }//end method


    //create
    public function create(){
        $languages = Language::all();
        $permission_chapter_create = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','createchapter')
            ->select('permissions.name')
            ->first();

            if(!empty($permission_chapter_create)){
                return view('panel.chapter.create',compact('languages'));
            } else {
                return back();
            }
    }//end method


    //store
    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:chapters',
            'language_id'=>'required',
        ],[
            'language_id.required'=>'The language field is required',
        ]);

        $chapter = new Chapter();
        $chapter->name = $request->name;
        $chapter->language_id = $request->language_id;
        $chapter->save();

        $chapterGroup = new ChapterGroup();
        $chapterGroup->chapter_id =    $chapter->id;
        $chapterGroup->language_id =    $chapter->language_id;
        $chapterGroup->name =    $chapter->name;
        $chapterGroup->save();
        return redirect()->route('chapter.index')->with('message','Chapter Created Successfully');
    }//end method


    //chapter group create
    public function createChapterGroup($id){
        $chapter = ChapterGroup::find($id);
        $languages = Language::all();
        $permission_chapter_group_create = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','createchaptergroup')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_chapter_group_create)){
            return view('panel.chapter.create-chapter-group',compact('chapter','languages'));
        } else {
            return back();
        }

    }//end method



    //chapter group store
    public function storeChapterGroup(Request $request){
        $request->validate([
            'name'=>'required|unique:chapter_groups',
            'language_id'=>'required',
        ],[
            'language_id.required'=>'The language field is required',
        ]);

        $chapterGroup = ChapterGroup::where('language_id',$request->language_id)->where('chapter_id',$request->chapter_id)->first();

        if(!empty($chapterGroup)){
            return redirect()->back()->with('error','Chapter Already Exists..');
        } else {
        $chapterGroup = new ChapterGroup();
        $chapterGroup->chapter_id =    $request->chapter_id;
        $chapterGroup->language_id =    $request->language_id;
        $chapterGroup->name =    $request->name;
        $chapterGroup->save();
        }

        return redirect()->route('chapter.index')->with('message','Chapter Created Successfully');
    }//end method


    //chapter edit
    public function edit($id){
        $permission_chapter_edit = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','editchapter')
        ->select('permissions.name')
        ->first();

        $chapter = ChapterGroup::find($id);
        $languages = Language::all();

        if(!empty($permission_chapter_edit)){
            return view('panel.chapter.edit',compact('chapter','languages'));
        } else {
            return back();
        }
    }//end method


    //update
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required|unique:chapter_groups,name,'.$id,
            'language_id'=>'required',
        ],[
            'language_id.required'=>'The language field is required',
        ]);

        $chapter = ChapterGroup::find($id);
        $chapter->name = $request->name;
        $chapter->language_id = $request->language_id;
        $chapter->chapter_id = $request->chapter_id;
        $chapter->save();
        return redirect()->route('chapter.index')->with('message','Chapter Updated Successfully');

    }//end method


    //delete
    public function delete($id){
        $permission_chapter_delete = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','deletechapter')
            ->select('permissions.name')
            ->first();

            if(!empty($permission_chapter_delete)){
                $chapter = ChapterGroup::find($id);

                $book = Book::where('chapter_id',$chapter->chapter_id)->get();

                // Check if the $books collection is empty
            if ($book->isEmpty()) {
                // No related books found, proceed to delete the chapter
                $main = Chapter::where('id', $chapter->chapter_id)->first();

                // Delete the chapter group
                $chapter->delete();

                // Check if there are any remaining chapter groups related to the main chapter
                $count = ChapterGroup::where('chapter_id', $main->id)->count();

                // If no other chapter groups are related to the main chapter, delete the main chapter
                if ($count < 1) {
                    $main->delete();
                }

                // Redirect with success message
                return redirect()->route('chapter.index')->with('message', 'Chapter Deleted Successfully');
            } else {
                // Related books found, do not delete the chapter
                return redirect()->back()->with('error', 'This data cannot be deleted because it is related to other data.');
            }



            } else {
                return back();
            }

    }//end method
}//end class
