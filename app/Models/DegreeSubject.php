<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DegreeSubject extends Model
{
    use HasFactory;
    protected $fillable=['degree_batch_semester_id','subject_id'];

    public function degreeBatchSemester(){
        return $this->belongsTo(DegreeBatchSemester::class,'degree_batch_semester_id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
}
