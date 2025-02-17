<?php


namespace App\Http\Controllers\Admin\Event;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Services\EventService;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EventSchedule;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

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
        $access = $this->accessCheck('post');
        if ($request->ajax()) {
            $events = Event::all();
            return DataTables::of($events)
                ->addIndexColumn()
                ->addColumn('action', function ($item) use ($access) {
                    $btn="";
                    if($access['isedit'] == 'Y'){
                        $btn = '<button class="btn btn-primary editEventBtn" data-id="' . $item->id . '" data-url="' . route('event.edit', $item->id) . '"><i class="bi bi-pencil-square"></i></button>';
                    }

                    if($access['isdelete'] == 'Y'){
                        $btn .= '&nbsp;<button class="btn btn-danger ml-2 deleteEventBtn" data-id="' . $item->id . '"><i class="bi bi-trash-fill"></i></button>';
                    }
                    return $btn;
                })
                ->addColumn('title', function ($title) {
                    return ucfirst($title->title);
                })->addColumn('type', function ($type) {
                    return ucfirst($type->type);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $extraJs = array_merge(
            config('js-map.admin.datatable.script')
        );

        $extraCs = array_merge(
            config('js-map.admin.datatable.style')
        );

        return view('admin.event.index', compact('extraJs', 'extraCs','access'));
    }

    public function getEvent()
    {
        try {
            $events = Event::with('eventSheduled')->get();
            $formattedEvents = $events->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'start_date' => $event->start_date,
                    'end_date' => $event->end_date,
                    'color' => $event->color,
                    'event_sheduled' => $event->eventSheduled,
                ];
            });

            return response()->json(["status" => true, "event" => $formattedEvents]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }


    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $accessCheck = $this->checkAccess($this->accessCheck('event'), 'isinsert');
            if ($accessCheck && $accessCheck['status'] == false) {
                return response()->json(['status' => $accessCheck['status'], 'message' => $accessCheck['message'], 403]);
            }
            $event = Event::create([
                'title' => $request->event_title,
                'description' => $request->event_description,
                'type' => $request->date_selection,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'color' => $request->eventColor
            ]);


            if ($request->has('eventDate')) {
                foreach ($request->eventDate as $key => $date) {
                    EventSchedule::create([
                        'event_id' => $event->id,
                        'date' => $date,
                        'start_time' => $request->eventStarttime[$key],
                        'end_time' => $request->eventendTime[$key],
                        'description' => $request->eventDescription[$key]
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Event created successfully.',
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
            $accessCheck = $this->checkAccess($this->accessCheck('event'), 'isedit');
            if ($accessCheck && $accessCheck['status'] == false) {
                return response()->json(['status' => $accessCheck['status'], 'message' => $accessCheck['message'], 403]);
            }
            $event = Event::with('eventSheduled')->findOrFail($id);
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
            $accessCheck = $this->checkAccess($this->accessCheck('event'), 'isupdate');
            if ($accessCheck && $accessCheck['status'] == false) {
                return response()->json(['status' => $accessCheck['status'], 'message' => $accessCheck['message'], 403]);
            }
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
            $accessCheck = $this->checkAccess($this->accessCheck('event'), 'isdelete');
            if ($accessCheck && $accessCheck['status'] == false) {
                return response()->json(['status' => $accessCheck['status'], 'message' => $accessCheck['message'], 403]);
            }
            $event = Event::findOrFail($id);
            if($event){
                EventSchedule::where('event_id',$id)->delete();
            }
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

    public function deleteSheduled($id){
        try{
            $event=EventSchedule::find($id)->delete();
            if($event){
                return response()->json(['status'=>true]);
            }else{
                return response()->json(['status'=>false,'message'=>"Something went wrong!"]);
            }
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
}
