<?php

namespace App\Http\Controllers\Admin;

use App\Models\Degree;
use App\Models\BatchType;
use App\Models\YearSemester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DegreeBatchSemester;
use App\Http\Controllers\Controller;
use App\Http\Requests\SyllabusContentRequest;
use App\Models\SyllabusContent;
use App\Models\SyllabusContentSubject;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class SyllabusContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $access = $this->accessCheck('syllabus-content');

        if ($request->ajax()) {
            $syllabus = SyllabusContent::with('degree', 'batch', 'batchType', 'yearSemester', 'subject')->get();
            return DataTables::of($syllabus)
                ->addIndexColumn()
                ->addColumn('faculty', function ($fac) {
                    return $fac->degree->title;
                })
                ->addColumn('batch', function ($batch) {
                    return $batch->batch->title;
                })
                ->addColumn('type', function ($type) {
                    return $type->batchType->title;
                })
                ->addColumn('semester', function ($semester) {
                    return $semester->yearSemester->title;
                })
                ->addColumn('subject', function ($subject) {
                    return $subject->subject->title;
                })
                ->addColumn('action', function ($item) use ($access) {
                    $btn="";
                    if($access['isedit'] == 'Y'){
                        $btn = '<button class="btn btn-warning ml-2 viewSyllabusBtn" type="button" data-id="' . $item->id . '"  data-url="' . route('syllabus-content.show', $item->id) . '"><i class="bi bi-eye-fill"></i></button>';
                    }
                    if($access['isedit'] == 'Y'){
                        $btn .= '&nbsp;<button class="btn btn-primary editSyllabusBtn" type="button" data-id="' . $item->id . '" data-url="' . route('syllabus-content.show', $item->id) . '"><i class="bi bi-pencil-square"></i></button>';
                    }

                    if($access['isdelete'] == 'Y'){
                        $btn .= '&nbsp;<button class="btn btn-danger ml-2 deleteSyllabusBtn" data-id="' . $item->id . '" data-url="' . route('syllabus-content.destroy', $item->id) . '"><i class="bi bi-trash-fill"></i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['faculties'] = Degree::all();
        $data['yearSemesters'] = BatchType::all();
        $data['extraCs'] = array_merge(
            config('js-map.admin.summernote.style'),
            config('js-map.admin.datatable.style')
        );
        $data['extraJs'] = array_merge(
            config('js-map.admin.summernote.script'),
            config('js-map.admin.datatable.script')
        );
        return view('admin.syllabuscontent.list', $data);
    }

    public function getBatch($id)
    {
        try {
            $data = DegreeBatchSemester::with('batch')->where('degree_id', $id)->get();
            return response()->json(['status' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getSemesterByBatch($id)
    {
        try {
            $data = DegreeBatchSemester::with('yearSemester')->where('batch_id', $id)->get();
            return response()->json(['status' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getSemesterByType(Request $request)
    {
        try {
            $request->validate([
                'degree_id' => 'required|integer',
                'batch_id' => 'required|integer',
                'batch_type_id' => 'required|integer'
            ]);

            $data = DegreeBatchSemester::with('yearSemester')->where('batch_type_id', $request->batch_id)->where('degree_id', $request->degree_id)->where('batch_type_id', $request->batch_type_id)->get();
            return response()->json(['status' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getSubject(Request $request)
    {
        try {
            $request->validate([
                'degree_id' => 'required|integer',
                'batch_id' => 'required|integer',
                'batch_type_id' => 'required|integer',
                'year_semester_id' => 'required|integer'
            ]);
            $data = DegreeBatchSemester::with('degreeSubject.subject')->where('year_semester_id', $request->year_semester_id)->where('degree_id', $request->degree_id)->where('batch_id', $request->batch_id)->get();
            return response()->json(['status' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
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
    public function store(SyllabusContentRequest $request)
    {
        DB::beginTransaction();
        try {
            $accessCheck = $this->checkAccess($this->accessCheck('syllabus-content'), 'isinsert');
            if ($accessCheck && $accessCheck['status'] == false) {
                return response()->json(['status' => $accessCheck['status'], 'message' => $accessCheck['message'], 403]);
            }
            if ($request->hasChapter === 'N') {
                if ($request->file != null) {
                    $image = 'images/syllabus/';
                    $imgname = time() . '.' . $request->file->getClientOriginalName();
                    $store = $request->file->storeAs($image, $imgname, 'public');
                    $path = $store;
                }
                SyllabusContent::create([
                    'degree_id' => $request->faculty_id,
                    'batch_id' => $request->batch_id,
                    'batch_type_id' => $request->batch_type_id,
                    'year_semester_id' => $request->semester_id,
                    'subject_id' => $request->subject_id,
                    'hasChapter' => $request->hasChapter,
                    'title' => $request->title,
                    'description' => $request->description,
                    'visibility' => $request->visibility,
                    'file' => $path,
                ]);
            } else {
                $syllabus = SyllabusContent::create([
                    'degree_id' => $request->faculty_id,
                    'batch_id' => $request->batch_id,
                    'batch_type_id' => $request->batch_type_id,
                    'year_semester_id' => $request->semester_id,
                    'subject_id' => $request->subject_id,
                    'hasChapter' => $request->hasChapter,
                ]);

                foreach ($request->chapter_title as $index => $title) {
                    SyllabusContentSubject::create([
                        'chapter_name' => $request->chapter_name[$index],
                        'chapter_title' => $title,
                        'chapter_description' => $request->chapter_description[$index],
                        'syllabus_content_id' => $syllabus->id,
                    ]);
                }
            }
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Syllabus Created Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $accessCheck = $this->checkAccess($this->accessCheck('syllabus-content'), 'isedit');
            if ($accessCheck && $accessCheck['status'] == false) {
                return response()->json(['status' => $accessCheck['status'], 'message' => $accessCheck['message'], 403]);
            }
            $syllabus = SyllabusContent::with('degree', 'batch', 'batchType', 'yearSemester', 'subject', 'syllabusSubject')->find($id);
            return response()->json(['status' => true, 'message' => $syllabus]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $accessCheck = $this->checkAccess($this->accessCheck('syllabus-content'), 'isupdate');
        if ($accessCheck && $accessCheck['status'] == false) {
            return response()->json(['status' => $accessCheck['status'], 'message' => $accessCheck['message'], 403]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $accessCheck = $this->checkAccess($this->accessCheck('syllabus-content'), 'isdelete');
            if ($accessCheck && $accessCheck['status'] == false) {
                return response()->json(['status' => $accessCheck['status'], 'message' => $accessCheck['message'], 403]);
            }
            $syllabus = SyllabusContent::find($id);
            if ($syllabus) {
                SyllabusContentSubject::where('syllabus_content_id', $id)->delete();
            }
            $syllabus->delete();
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
