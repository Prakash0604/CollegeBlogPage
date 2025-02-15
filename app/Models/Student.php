<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable=['full_name','image','dob','email','gender','contact','address','username','password','batch_id','batch_type_id','year_semester_id','status','created_by','updated_by','is_registered'];

    public function batch(){
        return $this->belongsTo(Batch::class,'batch_id','id');
    }

    // public function semester
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}
