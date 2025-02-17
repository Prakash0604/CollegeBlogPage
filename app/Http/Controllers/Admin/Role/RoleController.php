<?php

namespace App\Http\Controllers\Admin\Role;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $role = Role::with('permission')->get();

            return DataTables::of($role)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $btn = '<button class="btn btn-primary editRoleBtn" data-id="' . $item->id . '" data-url="' . route('role.edit',$item->id) . '"><i class="bi bi-pencil-square"></i></button>';
                    $btn .= '&nbsp;<button class="btn btn-danger ml-2 deleteRoleBtn" data-id="' . $item->id . '"><i class="bi bi-trash-fill"></i></button>';
                    return $btn;
                }) ->addColumn('permission', function ($item) {
                    $btn = '<a class="btn btn-info assignMenuBtn"  data-id="' . $item->id . '"><i class="bi bi-person-fill-check"></i></a>';
                    $btn .= '&nbsp;<a class="btn btn-warning assignPermissionBtn" data-id="' . $item->id . '" href="' . route('admin.permission',$item->id) . '"><i class="bi bi-shield-lock"></i></a>';
                    return $btn;
                })
                ->addColumn('status', function ($status) {
                    $stat = $status->status == 'active' ? 'checked' : '';
                    return '<div class="form-check form-switch d-flex">
                    <input class="form-check-input statusToggle mx-auto" type="checkbox" ' . $stat . ' data-id="' . $status->id . '" role="switch" id="flexSwitchCheckDefault">
                    </div>';
                })
                ->rawColumns(['action','status','permission'])
                ->make(true);
        }
        $extraJs = array_merge(
            config('js-map.admin.datatable.script'),
            config('js-map.admin.select2.script'),
        );
        $extraCs = array_merge(
            config('js-map.admin.datatable.style'),
            config('js-map.admin.select2.style')
        );
        $menus=Menu::where('status','active')->get();
        return view('admin.rolesPermission.list',compact('extraJs','extraCs','menus'));
    }

    public function toggleStatus($id)
    {
        try {

            $user = Role::find($id);
            if ($user->status == 'active') {
                $user->status = 'inactive';
            } else {
                $user->status = 'active';
            }
            $user->save();
            return response()->json(['status' => true]);
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
    public function store(Request $request)
    {
        // dd($request->all());
        $data=$request->validate([
            'title'=>'required|string|max:50'
        ]);

        try{
            Role::create($data);
            return response()->json(['status'=>true,'message'=>'Role Created Successfully']);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
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
        try{
            $roles=Role::find($id);
            return response()->json(['status'=>true,'message'=>$roles]);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=$request->validate([
            'title'=>'required|max:50'
        ]);
        try{
            $role=Role::find($id);
            if($role){
                $role->update($data);
            }
            return response()->json(['status'=>true,'message'=>'Role updated Successfully']);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            Role::find($id)->delete();
            return response()->json(['status'=>true,'message'=>'Role Deleted Successfully!']);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
}
