<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FormPermission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index($id)
    {
        // $menus = Menu::with('permission')->where('')->where('status', 'active')->get();
        $menus = DB::table('menus')
            ->join('form_permissions', 'form_permissions.menu_id', '=', 'menus.id')
            ->join('roles', 'form_permissions.role_id', '=', 'roles.id')
            ->where('roles.id', $id)
            ->select('menus.*')
            ->get();

        $permissions = FormPermission::where('role_id', $id)->get();
        // dd($permissions);
        return view('admin.rolesPermission.permission-form', compact('menus', 'permissions'));
    }

    public function excludeMenu($id){
        try{
            $menus = DB::table('menus')
            ->whereNotExists(function ($query) use ($id) {
                $query->select(DB::raw(1))
                    ->from('form_permissions')
                    ->whereRaw('form_permissions.menu_id = menus.id')
                    ->where('form_permissions.role_id', $id);
            })
            ->select('menus.*')
            ->get();
            return response()->json(['status'=>true,'message'=>$menus]);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }


    public function giveMenuAccess(Request $request)
    {
        try {
            if ($request->has('menu_id') && $request->role_id) {
                foreach ($request->menu_id as $menu) {
                    $menuData = Menu::find($menu);
                        FormPermission::create([
                            'menu_id'  => $menu,
                            'role_id'  => $request->role_id,
                            'isinsert' => 'N',
                            'isupdate' => 'N',
                            'isedit'   => 'N',
                            'isdelete' => 'N',
                            'formname' => $menuData->title,
                            'slug'     => Str::slug($menuData->title),
                        ]);
                }
            }

            return response()->json(['status' => true, 'message' => 'Menu has been assigned successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateStatus(Request $request)
{
    try {
        // Check the data sent
        // dd($request->all());

        $permission = FormPermission::query();

        $id = $request->data_id;
        $data_value = $request->data_value;
        $data_status = $request->data_status;

        switch ($data_status) {
            case 'isinsert':
                $permission->where('id', $id)->update(['isinsert' => $data_value]);
                break;

            case 'isedit':
                $permission->where('id', $id)->update(['isedit' => $data_value]);
                break;

            case 'isupdate':
                $permission->where('id', $id)->update(['isupdate' => $data_value]);
                break;

            case 'isdelete':
                $permission->where('id', $id)->update(['isdelete' => $data_value]);
                break;
        }

        return response()->json(['status' => true, 'message' => 'Status Updated Successfully!']);

    } catch (\Exception $e) {
        return response()->json(['status' => false, 'message' => $e->getMessage()]);
    }
}

}
