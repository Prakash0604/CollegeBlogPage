<?php

namespace App\Http\Controllers\Admin\EventManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventManagement\EventManagementRequest;
use App\Models\Attachment;
use App\Models\EventManagement\EventManagement;
use App\Services\EventManagement\EventManagementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class EventManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $eventService;

    public function __construct(EventManagementService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search.value');
            $columns = $request->input('columns');
            $pageSize = $request->input('length');
            $order = $request->input('order')[0];
            $IndexOrderColumn = $order['column'];
            $orderBy = $order['dir'];
            $start = $request->input('start');

            $event = EventManagement::query();
            $totalCount = $event->count();
            $searchData = $event
                ->when($search, function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('description', 'LIKE', "%$search%")
                        ->orWhere('type', 'LIKE', "%$search%")
                        ->orWhere('location', 'LIKE', "%$search%");
                });

            $searchCount = $searchData->count();
            $response = $searchData->orderBy($columns[$IndexOrderColumn]['data'], $orderBy)
                ->offset($start)
                ->limit($pageSize);

            return DataTables::of($response)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $btn = '<button class="btn btn-primary editEventBtn" data-id="'.$item->id.'">Edit</button>';
                    $btn .= '<button class="btn btn-danger ml-2 deleteEventBtn" data-id="'.$item->id.'">Delete</button>';

                    return $btn;
                })
                ->addColumn('description', function ($desc) {
                    return Str::limit($desc->description, 30);
                })
                ->addColumn('image', function ($image) {
                    return "<a type='button' data-id='".$image->id."' class='imageListPopup d-flex'><span class='btn btn-primary text-dark mx-auto'>".$image->attachment_count.'</span></a>';
                })
                ->with('recordsFiltered', $searchCount)
                ->with('recordsTotal', $totalCount)
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        $extraJs = array_merge(
            config('js-map.admin.summernote.script'),
            config('js-map.admin.datatable.script')
        );
        $extraCs = array_merge(
            config('js-map.admin.summernote.style'),
            config('js-map.admin.datatable.style')
        );

        return view('admin.eventmanagement.index', ['extraJs' => $extraJs, 'extraCs' => $extraCs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventManagementRequest $request)
    {
        DB::beginTransaction();
        try {
            // Validate and extract data
            $data = $request->validated();
            $data['user_id'] = Auth::id();

            // Convert additional_info to JSON format
            $data['additional_info'] = json_encode($data['additional_info'] ?? []);

            // Store the event
            $event = EventManagement::create($data);

            // Handle image uploads
            if ($request->images != null) {
                foreach ($request->images as $image) {
                    $filePath = 'images/events/';
                    $imageName = time().'.'.$image->getClientOriginalName();
                    $path = $image->storeAs($filePath, $imageName, 'public');
                    Attachment::create([
                        'event_id' => $event->id,
                        'image' => $path,
                    ]);
                }
            }

            DB::commit();

            return response()->json(['success' => true, 'status' => 200]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = EventManagement::find($id);

        return response()->json(['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = EventManagement::find($id);

        return response()->json(['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventManagementRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            // Convert additional_info to JSON format
            $data['additional_info'] = json_encode($data['additional_info'] ?? []);

            // Find and update the event
            $event = EventManagement::find($id);
            $event->update($data);

            // Handle image uploads (if any)
            if ($request->images != null) {
                foreach ($request->images as $image) {
                    $filePath = 'images/events/';
                    $imageName = time().'.'.$image->getClientOriginalName();
                    $path = $image->storeAs($filePath, $imageName, 'public');
                    Attachment::create([
                        'event_id' => $event->id,
                        'image' => $path,
                    ]);
                }
            }

            DB::commit();

            return response()->json(['success' => true, 'status' => 200]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Delete related attachments first
            $attachments = Attachment::where('event_id', $id);
            foreach ($attachments as $file) {
                Storage::disk('public')->delete($file->image);
            }
            $attachments->delete();

            // Delete event record
            EventManagement::find($id)->delete();

            return response()->json(['success' => true, 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
