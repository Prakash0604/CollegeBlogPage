<?php

namespace App\Http\Controllers\Admin\Student;

use App\Models\Batch;
use App\Models\Student;
use App\Models\BatchType;
use Illuminate\Support\Str;
use App\Models\YearSemester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $student = Student::all();

            return DataTables::of($student)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $btn = '<button class="btn btn-primary editStudentBtn" data-id="' . $item->id . '" data-url="' . route('student.edit',$item->id) . '"><i class="bi bi-pencil-square"></i></button>';
                    $btn .= '&nbsp;<button class="btn btn-danger ml-2 deleteStudentBtn" data-id="' . $item->id . '"><i class="bi bi-trash-fill"></i></button>';
                    return $btn;
                })
                ->addColumn('image', function ($image) {
                    // return '<span class="badge bg-primary">'..'"</span>';
                    $img = $image->image ? "/storage/". $image->image : "default.webp";
                    return '<img src="'.$img.'" class="rounded-circle img-thumbnail" width="100" height="100" alt="image">';
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        $extraJs = array_merge(
            config('js-map.admin.datatable.script')
        );
        $extraCs = array_merge(
            config('js-map.admin.datatable.style')
        );
        $data['title']="Student List";
        $data['batches']=Batch::all();
        $data['types']=BatchType::all();
        $data['yearSemesters']=YearSemester::all();

        return view('admin.student.list',compact('extraJs','extraCs'),$data);
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
    public function store(StudentRequest $request)
    {
        try{
            $data=$request->except('image');
            $data['username']=Str::upper(Str::random(4)).''.date('Ymd').Str::upper(Str::random(4));
            $data['password']=$data['username'];
            $data['created_by']=auth()->id();
            if($request->hasFile('image')){
                $folder='images/students/';
                $imagename=time().'.'.$request->file('image')->getClientOriginalName();
                $store=$request->file('image')->storeAs($folder,$imagename,'public');
                $data['image']=$store;
            }
            Student::create($data);
            return response()->json(['status'=>true,'message'=>'Student Created Successfully'],200);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()],500);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
