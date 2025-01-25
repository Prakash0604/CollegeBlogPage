<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BatchType;
use App\Models\Degree;
use App\Models\DegreeBatchSemester;
use App\Models\YearSemester;
use Illuminate\Http\Request;

class SyllabusContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['faculties']=Degree::all();
        $data['yearSemesters']=BatchType::all();
        return view('admin.syllabuscontent.list',$data);
    }

    public function getBatch($id){
        try{
            $data=DegreeBatchSemester::with('batch')->where('degree_id',$id)->get();
            return response()->json(['status'=>true,'message'=>$data]);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function getSemesterByBatch($id){
        try{
            $data=DegreeBatchSemester::with('yearSemester')->where('batch_id',$id)->get();
            return response()->json(['status'=>true,'message'=>$data]);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function getSemesterByType($id){
        try{
            $data=DegreeBatchSemester::with('yearSemester')->where('batch_type_id',$id)->get();
            return response()->json(['status'=>true,'message'=>$data]);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function getSubject(Request $request){
        try{
            $request->validate([
                'degree_id'=>'required|integer',
                'batch_id'=>'required|integer',
                'batch_type_id'=>'required|integer',
                'year_semester_id'=>'required|integer'
            ]);
            $data=DegreeBatchSemester::with('degreeSubject.subject')->where('year_semester_id',$request->year_semester_id)->where('degree_id',$request->degree_id)->where('batch_id',$request->batch_id)->get();
            return response()->json(['status'=>true,'message'=>$data]);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
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
    public function store(Request $request)
    {
        //
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
