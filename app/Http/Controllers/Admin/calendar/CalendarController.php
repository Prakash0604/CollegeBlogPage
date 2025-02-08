<?php

namespace App\Http\Controllers\Admin\calendar;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(){
        $batches=Batch::all();
        return view('admin.calendar.index',compact('batches'));
    }
}
