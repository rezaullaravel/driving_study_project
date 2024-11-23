<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    public function language(){
        return $this->belongsTo(Language::class,'language_id');
    }

    public function chapterGroup(){
        return $this->hasMany(ChapterGroup::class,'chapter_id');
    }
}
