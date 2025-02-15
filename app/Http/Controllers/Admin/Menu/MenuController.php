<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $menu = Menu::all();

            return DataTables::of($menu)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $btn = '<button class="btn btn-primary editMenuBtn" data-id="' . $item->id . '" data-url="' . route('menu.edit',$item->id) . '"><i class="bi bi-pencil-square"></i></button>';
                    $btn .= '&nbsp;<button class="btn btn-danger ml-2 deleteMenuBtn" data-id="' . $item->id . '"><i class="bi bi-trash-fill"></i></button>';
                    return $btn;
                })
                ->addColumn('status', function ($status) {
                    $stat = $status->status == 'active' ? 'checked' : '';
                    return '<div class="form-check form-switch d-flex">
                    <input class="form-check-input statusToggle mx-auto" type="checkbox" ' . $stat . ' data-id="' . $status->id . '" role="switch" id="flexSwitchCheckDefault">
                    </div>';
                })
                ->rawColumns(['action','status'])
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
        return view('admin.menu.list',compact('extraJs','extraCs'));
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
    public function store(MenuRequest $request)
    {
        try{
            Menu::create($request->validated());
            return response()->json(['status'=>true,'message'=>'Menu Created Successfully']);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function toggleStatus($id)
    {
        try {

            $user = Menu::find($id);
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
            $menus=Menu::find($id);
            return response()->json(['status'=>true,'message'=>$menus]);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, string $id)
    {
        try{
            $menu=Menu::find($id);
            if($menu){
                $menu->update($request->validated());
            }
            return response()->json(['status'=>true,'message'=>'Menu updated Successfully']);
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
            Menu::find($id)->delete();
            return response()->json(['status'=>true,'message'=>'Menu Deleted Successfully!']);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
}
