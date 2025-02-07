<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'event_date_id',
        'start_time',
        'end_time',
        'description',
    ];

    // Relationship: An event schedule belongs to an event date
    public function eventDate()
    {
        return $this->belongsTo(EventDate::class);
    }
}

