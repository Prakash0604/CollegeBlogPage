<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPermission extends Model
{
    use HasFactory;
    protected $fillable=['formname','slug','isinsert','isupdate','isedit','isdelete','role_id','menu_id'];
    public function role(){
        return $this->belongsTo(Role::class,'role_id','id');
    }
}
