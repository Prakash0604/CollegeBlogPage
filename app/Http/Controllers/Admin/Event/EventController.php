<?php


namespace App\Http\Controllers\Admin\Event;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Services\EventService;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * Display a listing of the events.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $events = Event::all();

            return response()->json([
                'status' => true,
                'data' => $events
            ]);
        }

        return view('admin.event.index');
    }

    public function getEvent(Request $request)
    {
        // try {
        //     $events = Event::with('eventDates','eventSchedules')->get();
        //     return response()->json($events);
        // } catch (\Exception $e) {
        //     return response()->json(['status' => false, 'message' => $e->getMessage()]);
        // }

        // For testing only
        return response()->json([
            ['title' => 'Laravel Workshop', 'start' => '2025-02-10', 'end' => '2025-02-12', "color" => "#00ff00"],
            ['title' => 'Conference', 'start' => '2025-02-15', "color" => "#ff0000"],
            ['title' => 'Meeting', 'start' => '2025-02-10', "color" => "#0000ff"],
        ]);
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(EventRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();  // If you have user associations
            $event = Event::create($data);  // Create a new Event

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Event created successfully.',
                'event' => $event
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(string $id)
    {
        try {
            $event = Event::findOrFail($id);
            return response()->json([
                'status' => true,
                'event' => $event
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified event in storage.
     */
    public function update(EventRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $event = Event::findOrFail($id);
            $event->update($data);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Event updated successfully.',
                'event' => $event
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(string $id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();

            return response()->json([
                'status' => true,
                'message' => 'Event deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
