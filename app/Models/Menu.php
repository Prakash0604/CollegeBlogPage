<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable=['title','icon','redirect','status'];
    public function permission(){
        return $this->hasMany(FormPermission::class,'menu_id','id');
    }
}
