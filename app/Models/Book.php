<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function chapterGroup()
{
    return $this->belongsTo(ChapterGroup::class, 'chapter_id', 'chapter_id');
}

    public function licencetype(){
        return $this->belongsTo(Licencetype::class,'licence_type_id')->withDefault();
    }

    public function language(){
        return $this->belongsTo(Language::class,'language_id');
    }
}
