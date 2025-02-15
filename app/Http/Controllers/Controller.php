<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function checkAccess($access, $action)
    {

        if ($access[$action] != 'Y') {
            return ['status' => false, 'message' => "You don't have access to perform this action", 'code' => 403];
        }
    }

    protected function accessCheck($type)
    {
        return checkAccessPrivileges($type);
    }
}
