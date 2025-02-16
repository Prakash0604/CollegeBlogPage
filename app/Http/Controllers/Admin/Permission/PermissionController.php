<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Models\FormPermission;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index($id){
        $menus=Menu::where('status','active')->get();
        $permissions=FormPermission::where('role_id',$id)->get();
        return view('admin.rolesPermission.permission-form',compact('menus','permissions'));
    }
}
