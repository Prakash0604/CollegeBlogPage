<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DegreeBatchSemester extends Model
{
    use HasFactory;
    protected $fillable=['degree_id','batch_id','batch_type_id','year_semester_id','status'];

    public function degree(){
        return $this->belongsTo(Degree::class);
    }

    public function batch(){
        return $this->belongsTo(Batch::class,'batch_id');
    }

    public function batchType(){
        return $this->belongsTo(BatchType::class,'batch_type_id');
    }

    public function yearSemester(){
        return $this->belongsTo(YearSemester::class,'year_semester_id');
    }
}
