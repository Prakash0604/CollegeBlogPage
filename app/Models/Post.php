<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['user_id','title','description','type','visibility'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function attachment(){
        return $this->hasMany(Attachment::class,'post_id','id');
    }
}
