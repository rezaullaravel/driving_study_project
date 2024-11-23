<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterGroup extends Model
{
    use HasFactory;
    protected $fillable = ['chapter_id', 'language_id', 'name'];
    public function language(){
        return $this->belongsTo(Language::class,'language_id');
    }
}
