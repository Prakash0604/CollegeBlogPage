<?php

namespace App\Observers;

use App\Models\EventManagement\EventManagement;

class EventManagementObserver
{
    /**
     * Handle the EventManagement "created" event.
     */
    public function created(EventManagement $eventManagement): void
    {
        //
    }

    /**
     * Handle the EventManagement "updated" event.
     */
    public function updated(EventManagement $eventManagement): void
    {
        //
    }

    /**
     * Handle the EventManagement "deleted" event.
     */
    public function deleted(EventManagement $eventManagement): void
    {
        //
    }

    /**
     * Handle the EventManagement "restored" event.
     */
    public function restored(EventManagement $eventManagement): void
    {
        //
    }

    /**
     * Handle the EventManagement "force deleted" event.
     */
    public function forceDeleted(EventManagement $eventManagement): void
    {
        //
    }
}
