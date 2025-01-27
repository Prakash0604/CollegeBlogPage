<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyllabusContent extends Model
{
    use HasFactory;
    protected $fillable = ['degree_id', 'batch_id', 'batch_type_id', 'year_semester_id', 'subject_id', 'hasChapter', 'title', 'description', 'visibility', 'file', 'status'];

    public function degree()
    {
        return $this->belongsTo(Degree::class, 'degree_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function batchType()
    {
        return $this->belongsTo(BatchType::class, 'batch_type_id');
    }

    public function yearSemester()
    {
        return $this->belongsTo(YearSemester::class, 'year_semester_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function syllabusSubject(){
        return $this->hasMany(SyllabusContentSubject::class,'syllabus_content_id');
    }
}
