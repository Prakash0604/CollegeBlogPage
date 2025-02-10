<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'type',
        'color',
        'status'
    ];

    public function eventSheduled(){
        return $this->hasMany(EventSchedule::class,'event_id');
    }


}

