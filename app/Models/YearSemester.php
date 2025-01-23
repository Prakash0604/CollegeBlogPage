<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearSemester extends Model
{
    use HasFactory;
    protected $fillable=['batch_type_id','title','stauts'];

    public function batchType(){
        return $this->belongsTo(BatchType::class);
    }
}
