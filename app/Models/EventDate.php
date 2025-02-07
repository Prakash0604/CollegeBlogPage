<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDate extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'event_id',
        'event_date',
    ];

    // Relationship: An event date belongs to an event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relationship: An event date has many event schedules
    public function eventSchedules()
    {
        return $this->hasMany(EventSchedule::class);
    }
}

