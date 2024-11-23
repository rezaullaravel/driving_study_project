<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Language;
use App\Models\Licencetype;
use App\Models\ChapterGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    //all books
    public function index(){

        $books = Book::join('chapter_groups', 'books.chapter_id', '=', 'chapter_groups.chapter_id')
        ->join('languages', 'books.language_id', '=', 'languages.id')
        ->where('books.language_id', '=', DB::raw('chapter_groups.language_id'))
        ->select('books.*', 'chapter_groups.name as chapter_name', 'languages.name as lang_name')
        ->orderBy('id','asc')
        ->get();
        //return $books; die;
        $permission_book_list = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','book')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_book_list)){
            return view('panel.book.index',compact('books'));
        } else {
            return back();
        }
    }//end method


    //create
    public function create(){
        $licencetype = Licencetype::all();
        //$chapters = Chapter::where('language_id',1)->get();
        $languages = Language::all();

        $permission_book_create = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','createbook')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_book_create)){
            return view('panel.book.create',compact('licencetype','languages'));
        } else {
            return back();
        }
    }//end method


    //store
    public function store(Request $request){
        $request->validate([
            'licence_type_id'=>'required',
            'language_id'=>'required',
            'chapter_id'=>'required',
            'lesson'=>'required',
            'topic_name'=>'required',
            'topic_description'=>'required',
            'video_url'=>'nullable',
            'paid_status'=>'required',
        ],[
            'licence_type_id.required'=>'The licence type field  is  required.',
            'chapter_id.required'=>'The chapter field  is  required.',
            'language_id.required'=>'The language field  is  required.',
        ]);

        //data insert
        $book = new Book;
        $book->licence_type_id = $request->licence_type_id;
        $book->chapter_id = $request->chapter_id;
        $book->language_id = $request->language_id;
        $book->lesson = $request->lesson;
        $book->topic_name = $request->topic_name;
        $book->topic_description = $request->topic_description;
        $book->paid_status = $request->paid_status;
        if(!empty($request->video_url)){
            $book->video_url = $request->video_url;
        }

        $book->save();

        return redirect()->route('book.index')->with('message','Book Created Successfully');

    }//end method


    //edit
    public function edit($id){
        $book = Book::find($id);
        $licencetype = Licencetype::all();
        $chapters = ChapterGroup::where('language_id',$book->language_id)->get();
        $languages = Language::all();

        $permission_book_edit = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','editbook')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_book_edit)){
            return view('panel.book.edit',compact('book','licencetype','chapters','languages'));
        } else {
            return back();
        }
    }//end method


    //update
    public function update(Request $request,$id){
        $request->validate([
            'licence_type_id'=>'required',
            'language_id'=>'required',
            'chapter_id'=>'required',
            'lesson'=>'required',
            'topic_name'=>'required',
            'topic_description'=>'required',
            'video_url'=>'nullable',
        ],[
            'licence_type_id.required'=>'The licence type field  is  required.',
            'chapter_id.required'=>'The chapter field  is  required.',
            'language_id.required'=>'The language field  is  required.',
        ]);

        //data update
        $book = Book::find($id);
        $book->licence_type_id = $request->licence_type_id;
        $book->chapter_id = $request->chapter_id;
        $book->language_id = $request->language_id;
        $book->lesson = $request->lesson;
        $book->topic_name = $request->topic_name;
        $book->topic_description = $request->topic_description;
        $book->paid_status = $request->paid_status;
        if(!empty($request->video_url)){
            $book->video_url = $request->video_url;
        }

        $book->save();

        return redirect()->route('book.index')->with('message','Book Updated Successfully');
    }//end method


    //view book details
    public function details($id){
        $permission_book_view = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','viewbook')
            ->select('permissions.name')
            ->first();

         if(!empty($permission_book_view)){
            $book = Book::join('licencetypes', 'books.licence_type_id', '=', 'licencetypes.id')
            ->join('languages', 'books.language_id', '=', 'languages.id')
            ->join('chapter_groups', 'books.chapter_id', '=', 'chapter_groups.chapter_id')
            ->where('books.id', $id)
            ->where('books.language_id', '=', DB::raw('chapter_groups.language_id'))
            ->select('books.*', 'licencetypes.name as licence_type_name', 'chapter_groups.name as chapter_group_name', 'languages.name as language_name')
            ->first();

            return view('panel.book.view',compact('book'));
         } else {
            return back();
         }
    }//end method


    //delete
    public function delete($id){
        $permission_book_delete = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','deletebook')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_book_delete)){
            Book::find($id)->delete();
        } else {
            return back();
        }

        return redirect()->route('book.index')->with('message','Book Deleted Successfully');
    }//end  method


    //ajax route for language wise chater select
    public function chapterAutoSelect($language_id){
        $chapters = ChapterGroup::where('language_id',$language_id)->get();
        return json_encode($chapters);
    }//end method


}//end class
