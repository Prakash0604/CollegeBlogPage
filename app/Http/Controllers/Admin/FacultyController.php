<?php

namespace App\Http\Controllers\Admin;

use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchType;
use App\Models\DegreeBatchSemester;
use App\Models\DegreeSubject;
use App\Models\Subject;
use App\Models\YearSemester;
use Yajra\DataTables\Facades\DataTables;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $degrees = Degree::all();

            return DataTables::of($degrees)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $btn = '<button class="btn btn-warning ml-2 assignSubjectBtn" data-id="' . $item->id . '"><i class="bi bi-plus-lg"></i></button>';
                    $btn .= '&nbsp;<button class="btn btn-info ml-2 viewSubjectBtn" data-id="' . $item->id . '"><i class="bi bi-eye-fill"></i></button>';
                    $btn .= '&nbsp;<button class="btn btn-primary editDegreeBtn" data-id="' . $item->id . '" data-url="' . route('faculty.edit', $item->id) . '"><i class="bi bi-pencil-square"></i></button>';
                    $btn .= '&nbsp;<button class="btn btn-danger ml-2 deleteDegreeBtn" data-id="' . $item->id . '" data-url="' . route('faculty.destroy', $item->id) . '"><i class="bi bi-trash-fill"></i></button>';
                    return $btn;
                })
                ->addColumn('status', function ($status) {
                    $stat = $status->status == 'active' ? 'checked' : '';
                    return '<div class="form-check form-switch d-flex">
                    <input class="form-check-input statusToggle mx-auto" type="checkbox" ' . $stat . ' data-id="' . $status->id . '" role="switch" id="flexSwitchCheckDefault">
                    </div>';
                })

                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $extraJs = array_merge(
            config('js-map.admin.summernote.script'),
            config('js-map.admin.datatable.script'),
            config('js-map.admin.select2.script'),

        );
        $extraCs = array_merge(
            config('js-map.admin.summernote.style'),
            config('js-map.admin.datatable.style'),
            config('js-map.admin.select2.style'),
        );
        $title = "Degree List";
        $batches = Batch::where('status', 'active')->pluck('title', 'id');
        $types = BatchType::where('status', 'active')->pluck('title', 'id');
        // $semesters=YearSemester::where('status','active')->pluck('title','id');
        $subjects = Subject::where('status', 'active')->get();
        return view('admin.faculty.list', compact('extraJs', 'extraCs', 'title', 'batches', 'types', 'subjects'));
    }

    public function showDegreeSubject(Request $request)
    {
        try {
            $request->validate([
                'semester_id' => 'required|integer',
                'batch_type_id' => 'required|integer',
                'degree_id' => 'required|integer',
                'batch_id' => 'required|integer',
            ]);

            $degrees = DegreeBatchSemester::with('degreeSubject.subject')
                ->where('year_semester_id', $request->semester_id)
                ->where('batch_type_id', $request->batch_type_id)
                ->where('degree_id', $request->degree_id)
                ->where('batch_id', $request->batch_id)
                ->get();

            $rows = $degrees->flatMap(function ($degree) {
                return $degree->degreeSubject->map(function ($degreeSubject) {
                    return [
                        'id' => $degreeSubject->id,
                        'subject' => $degreeSubject->subject?->title,
                        'delete_url' => route('degreeSubject.delete', $degreeSubject->id),
                    ];
                });
            });

            return DataTables::of($rows)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<button type="button" class="btn btn-danger deleteDegreeSubjectBtn" data-url="' . e($row['delete_url']) . '"><i class="bi bi-trash-fill"></i></button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function toggleStatus($id)
    {
        try {

            $user = Degree::find($id);
            if ($user->status == 'active') {
                $user->status = 'inactive';
            } else {
                $user->status = 'active';
            }
            $user->save();
            // return $this->sendResponse(true,getMessageText('update'));
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getFacultySemester($id)
    {
        try {
            $data = YearSemester::where('batch_type_id', $id)->get();
            return response()->json(['status' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validate([
                'title' => 'required'
            ]);
            Degree::create($data);
            DB::commit();
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }


    public function storeSubject(Request $request)
    {
        try {

            $degree = DegreeBatchSemester::create([
                'degree_id' => $request->degree_id,
                'batch_id' => $request->batch_id,
                'batch_type_id' => $request->batch_type_id,
                'year_semester_id' => $request->semester_id
            ]);

            foreach ($request->subject_id as $subject) {
                DegreeSubject::create([
                    'degree_batch_semester_id' => $degree->id,
                    'subject_id' => $subject
                ]);
            }
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $degree = Degree::find($id);
            return response()->json(['status' => true, 'message' => $degree]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'title' => 'required'
            ]);
            $degree = Degree::find($id);
            $degree->update($data);
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if ($id) {
                $degree = Degree::find($id);
                $degree->delete();
            }
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteDegreeSubject($id){
        $id=DegreeSubject::find($id);
        if($id!=null){
            $id->delete();
            return response()->json(['status'=>true]);
        }else{
            return response()->json(['status'=>false,'message'=>"No Subject found to delete!"]);
        }
    }
}
