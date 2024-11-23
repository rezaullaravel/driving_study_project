<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id', 'chapter_id', 'language_id','licence_type_id', 'lesson',
        'question_text', 'option1', 'option2', 'option3',
        'option4', 'correct_ans', 'difficulty_level', 'paid_status'
    ];

     // Relationship with ChapterGroup
     public function chapterGroup()
     {
         return $this->belongsTo(ChapterGroup::class, 'chapter_id', 'chapter_id');
     }

     // Relationship with Language
     public function language()
     {
         return $this->belongsTo(Language::class, 'language_id', 'id');
     }

     // Relationship with LicenceType
     public function licenceType()
     {
         return $this->belongsTo(LicenceType::class, 'licence_type_id', 'id');
     }

     //relation with book
     public function book(){
        return $this->belongsTo(Book::class,'book_id');
     }

      
}
