<?php

namespace App\Services\EventManagement;

use App\Models\EventManagement\EventManagement;
use App\Services\Main\BaseService;

class EventManagementService extends BaseService
{
    protected $eventManagement;

    // Inject EventManagement model into the service
    public function __construct(EventManagement $eventManagement)
    {
        $this->eventManagement = $eventManagement;
        parent::__construct($eventManagement);  // Call parent constructor if needed
    }

    /**
     * Create a new event
     *
     * @return \App\Models\EventManagement\EventManagement
     */
    public function createEvent(array $data)
    {
        return $this->eventManagement->create($data);
    }

    /**
     * Update an existing event
     *
     * @return \App\Models\EventManagement\EventManagement
     */
    public function updateEvent(int $id, array $data)
    {
        $event = $this->eventManagement->findOrFail($id);
        $event->update($data);

        return $event;
    }

    /**
     * Delete an event
     *
     * @return bool
     */
    public function deleteEvent(int $id)
    {
        $event = $this->eventManagement->findOrFail($id);

        return $event->delete();
    }

    /**
     * Get all events
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllEvents()
    {
        return $this->eventManagement->all();
    }

    /**
     * Find an event by ID
     *
     * @return \App\Models\EventManagement\EventManagement
     */
    public function findEventById(int $id)
    {
        return $this->eventManagement->findOrFail($id);
    }
}
