<?php

namespace App\Models\EventManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventManagement extends Model
{
    use HasFactory;

    // Define the table name (optional if it's the default plural form of the model name)
    protected $table = 'event_management';

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'type',
        'description',
        'start_date',
        'end_date',
        'location',
        'additional_info',
    ];

    // Define the cast for attributes
    protected $casts = [
        'additional_info' => 'array', // Automatically cast JSON to an array
        'start_date' => 'date',       // Cast to date type
        'end_date' => 'date',         // Cast to date type
    ];

    // Define any relationships (if any) in the future, for example:
    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
