<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function many()
    {
        $attendance = Attendance::with(['section'])
            ->select('*')
            ->get();
        $attendance = json_decode(json_encode($attendance), true);
        print_r($attendance);
    }

    public function add(Request $request)
    {
        $newAttendance = new Attendance();
        $newAttendance->section_id = $request->section;
        $newAttendance->date = $request->date;
        $newAttendance->save();
        return response($newAttendance);
    }

    public function addAttendance(Request $request, $id)
    {
        $attendance = Attendance::find($id);
        $attendance->student()->attach($request->student, ['status' => $request->status]);
        return response('Attendance added');
    }

    public function manyA()
    {
        $attendance = Attendance::with(['student'])
            ->select('*')
            ->get();
        $attendance = json_decode(json_encode($attendance), true);
        print_r($attendance[0]['student'][0]['pivot']['status']);
    }
}