<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyllabusContentSubject extends Model
{
    use HasFactory;

    protected $fillable=['syllabus_content_id','chapter_name','chapter_title','chapter_description'];

    public function syllabus(){
        return $this->belongsTo(SyllabusContent::class,'syllabus_content_id');
    }
}
