<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable=['title','status'];

    public function permission(){
        return $this->hasMany(FormPermission::class,'role_id','id');
    }
}
