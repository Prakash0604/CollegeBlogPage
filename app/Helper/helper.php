<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

function getUserDetail()
{
    $user = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->select('users.id', 'users.full_name', 'users.email','roles.title','users.role_id')
        ->where('users.id', Auth::id())
        ->first();
    return $user;
}

function checkAccessPrivileges($form)
{
    $userdata = getUserDetail();
// dd($userdata);
    $access = DB::table('form_permissions')
        ->select('isinsert', 'isedit', 'isupdate', 'isdelete')
        ->where('role_id', $userdata->role_id)
        ->where('slug', $form)
        ->get();
    if (count($access) > 0) {
        return (array) $access[0];
    } else {
        return array('isinsert' => 'N', 'isedit' => 'N', 'isupdate' => 'N', 'isdelete' => 'N');
    }
}
