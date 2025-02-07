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
        'is_full_day',
    ];

    // Relationship: An event has many event dates
    public function eventDates()
    {
        return $this->hasMany(EventDate::class);
    }

    // Relationship: An event can have many event schedules through event dates
    public function eventSchedules()
    {
        return $this->hasManyThrough(EventSchedule::class, EventDate::class);
    }
}

