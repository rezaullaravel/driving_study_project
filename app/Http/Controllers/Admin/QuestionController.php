<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    //question list
    public function index(){

        $questions = DB::table('questions')
        ->join('languages', 'questions.language_id', '=', 'languages.id')
        ->join('licencetypes', 'questions.licence_type_id', '=', 'licencetypes.id')
        ->join('chapter_groups', function ($join) {
            $join->on('questions.chapter_id', '=', 'chapter_groups.chapter_id')
                 ->on('questions.language_id', '=', 'chapter_groups.language_id');
        })
        ->join('books', 'questions.book_id', '=', 'books.id') // Join with the books table using book_id
        ->select(
            'questions.*', // Select all columns from the questions table
            'chapter_groups.name as chapter_name', // Get the chapter name based on language
            'languages.name as language_name',
            'licencetypes.name as licence_type_name',
            'books.topic_name' // Fetch the topic_name from the books table
        )
        ->get();

         //return $questions; die;

        $permission_question_list = DB::table('permission_roles')
        ->where('role_id',Auth::user()->role_id)
        ->join('permissions','permission_roles.permission_id','=','permissions.id')
        ->where('permissions.slug','questions')
        ->select('permissions.name')
        ->first();

        if(!empty($permission_question_list)){
            return view('panel.question.index',compact('questions'));
        } else {
            return back();
        }
    }//end method


     //question create form
     public function create()
     {
         $books = Book::all();
         $permission_question_create = DB::table('permission_roles')
         ->where('role_id',Auth::user()->role_id)
         ->join('permissions','permission_roles.permission_id','=','permissions.id')
         ->where('permissions.slug','createquestion')
         ->select('permissions.name')
         ->first();
         if(!empty($permission_question_create)){
            return view('panel.question.create', compact('books'));
         } else {
            return back();
         }

     }//end method


    // Method to get book details for AJAX request
    public function getBookDetails(Request $request)
    {
        //$book = Book::with(['chapter', 'language'])->find($request->book_id);
        $book = Book::join('languages', 'books.language_id', '=', 'languages.id')
        ->join('chapter_groups', 'books.chapter_id', '=', 'chapter_groups.chapter_id')
        ->join('licencetypes', 'books.licence_type_id', '=', 'licencetypes.id')
        ->where('books.id', $request->book_id)
        ->where('books.language_id', '=', DB::raw('chapter_groups.language_id'))
        ->select(
           'books.id as book_id',
            'books.chapter_id',
            'books.licence_type_id', // Select licence_type_id
            'chapter_groups.name as chapter_name',
            'languages.id as language_id',
            'languages.name as language_name',
            'licencetypes.name as licence_type_name', // Select licencetypes.name
            'books.lesson'
        )
        ->first();

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        return response()->json([
            'book_id' => $book->book_id, // Accessing book_id from the select alias
            'chapter_id' => $book->chapter_id,
            'chapter_name' => $book->chapter_name ?? null, // Accessing chapter_name from the select alias
            'language_id' => $book->language_id,
            'language_name' => $book->language_name ?? null, // Accessing language_name from the select alias
            'licence_type_id' => $book->licence_type_id, // Accessing licence_type_id from the select alias
            'licence_type_name' => $book->licence_type_name ?? null, // Accessing licence_type_name from the select alias
            'lesson' => $book->lesson,
        ]);
    }//end method


    //store
    public function store(Request $request){
        $validated = $request->validate([
            'book_id' => 'required|integer',
            'chapter_id' => 'required|integer',
            'language_id' => 'required|integer',
            'licence_type_id' => 'required|integer',
            'lesson' => 'required|string',
            'question_text' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'correct_ans' => 'required',
            'difficulty_level' => 'required|string|in:easy,medium,hard',
            'paid_status' => 'required|boolean',
        ]);


        Question::create($validated);
        return redirect()->route('question.index')->with('message','Question Created Successfully');
    }//end method


    //edit question
    public function edit($id){
        $question = Question::
        join('languages', 'questions.language_id', '=', 'languages.id')
        ->join('licencetypes', 'questions.licence_type_id', '=', 'licencetypes.id')
        ->join('chapter_groups', function ($join) {
            $join->on('questions.chapter_id', '=', 'chapter_groups.chapter_id')
                 ->on('questions.language_id', '=', 'chapter_groups.language_id');
        })
        ->join('books', 'questions.book_id', '=', 'books.id') // Join with the books table using book_id
        ->where('questions.id', $id)
        ->select(
            'questions.*', // Select all columns from the questions table
            'chapter_groups.name as chapter_name', // Get the chapter name based on language
            'languages.name as language_name',
            'licencetypes.name as licence_type_name',
            'books.topic_name' // Fetch the topic_name from the books table
        )
        ->first();

        $books = Book::all();

        $permission_question_edit = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','editquestion')
            ->select('permissions.name')
            ->first();

        if(!empty($permission_question_edit)){
            return view('panel.question.edit',compact('question','books'));
        } else {
            return back();
        }
    }//end method


    //update question
    public function update(Request $request,$id){
        $validated = $request->validate([
            'book_id' => 'required|integer',
            'chapter_id' => 'required|integer',
            'language_id' => 'required|integer',
            'licence_type_id' => 'required|integer',
            'lesson' => 'required|string',
            'question_text' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'correct_ans' => 'required',
            'difficulty_level' => 'required|string|in:easy,medium,hard',
            'paid_status' => 'required|boolean',
        ]);
        $question = Question::find($id)->update($validated);
        return redirect()->route('question.index')->with('message','Question Updated Successfully');
    }//end method


    //view question details
    public function view($id){
        $question = Question::
        join('languages', 'questions.language_id', '=', 'languages.id')
        ->join('licencetypes', 'questions.licence_type_id', '=', 'licencetypes.id')
        ->join('chapter_groups', function ($join) {
            $join->on('questions.chapter_id', '=', 'chapter_groups.chapter_id')
                 ->on('questions.language_id', '=', 'chapter_groups.language_id');
        })
        ->join('books', 'questions.book_id', '=', 'books.id') // Join with the books table using book_id
        ->where('questions.id', $id)
        ->select(
            'questions.*', // Select all columns from the questions table
            'chapter_groups.name as chapter_name', // Get the chapter name based on language
            'languages.name as language_name',
            'licencetypes.name as licence_type_name',
            'books.topic_name' // Fetch the topic_name from the books table
        )
        ->first();

        $permission_question_view = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','viewquestion')
            ->select('permissions.name')
            ->first();

        if(!empty($permission_question_view)){
            return view('panel.question.view',compact('question'));
        } else {
            return back();
        }
    }//end method


    //delete question
    public function delete($id){
        $permission_question_delete = DB::table('permission_roles')
            ->where('role_id',Auth::user()->role_id)
            ->join('permissions','permission_roles.permission_id','=','permissions.id')
            ->where('permissions.slug','deletequestion')
            ->select('permissions.name')
            ->first();
        if(!empty($permission_question_delete)){
            Question::find($id)->delete();
            return redirect()->route('question.index')->with('message','Question Deleted Successfully');
        } else {
            return back();
        }
    }//end method
}//end class
