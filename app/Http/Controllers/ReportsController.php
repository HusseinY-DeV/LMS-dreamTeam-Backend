<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function allSections(Request $request)
    {
        $attendances = DB::select('SELECT SUM(CASE WHEN status = -1 THEN 1 END) AS Absent,
        SUM(CASE WHEN status = 0 THEN 1 END) AS Late,
        SUM(CASE WHEN status = 1 THEN 1 END) AS Present
        FROM (SELECT as2.id, as2.attendance_id, as2.student_id, as1.section_id, as2.status FROM attendance_student as2 
        JOIN (SELECT a.id, a.section_id FROM attendances a 
        JOIN sections s 
        ON a.section_id = s.id) as1
        ON as2.attendance_id = as1.id) AS k');
        return $attendances;
    }

    public function oneSection(Request $request, $id)
    {
        $from = "";
        $to = "";
        if ($request->from) {
            $from = $request->from;
        }
        if ($request->to) {
            $to = $request->to;
        }
        if ($from != 'null' && $from != 'null') {
            $attendances = DB::select('SELECT SUM(CASE WHEN status = -1 THEN 1 END) AS Absent,
        SUM(CASE WHEN status = 0 THEN 1 END) AS Late,
        SUM(CASE WHEN status = 1 THEN 1 END) AS Present
        FROM (SELECT as2.id, as2.attendance_id, as2.student_id, as1.section_id, as2.status FROM attendance_student as2 
        JOIN (SELECT a.id, a.section_id FROM attendances a 
        JOIN sections s 
        ON a.section_id = s.id where s.id = ? and a.date >= ? and a.date <= ?) as1
        ON as2.attendance_id = as1.id) AS k', [$id, $from, $to]);
            return $attendances;
        }
        $attendances = DB::select('SELECT SUM(CASE WHEN status = -1 THEN 1 END) AS Absent,
        SUM(CASE WHEN status = 0 THEN 1 END) AS Late,
        SUM(CASE WHEN status = 1 THEN 1 END) AS Present
        FROM (SELECT as2.id, as2.attendance_id, as2.student_id, as1.section_id, as2.status FROM attendance_student as2 
        JOIN (SELECT a.id, a.section_id FROM attendances a 
        JOIN sections s 
        ON a.section_id = s.id and s.id = ?) as1
        ON as2.attendance_id = as1.id) AS k', [$id]);
        return $attendances;
    }

    public function oneStudent(Request $request, $id)
    {
        $from = "";
        $to = "";
        if ($request->from) {
            $from = $request->from;
        }
        if ($request->to) {
            $to = $request->to;
        }
        if ($from != 'null' && $from != 'null') {
            $attendances = DB::select('SELECT SUM(CASE WHEN status = -1 THEN 1 END) AS Absent,
        SUM(CASE WHEN status = 0 THEN 1 END) AS Late,
        SUM(CASE WHEN status = 1 THEN 1 END) AS Present
        FROM (SELECT as2.id, as2.attendance_id, as2.student_id, as1.section_id, as2.status FROM attendance_student as2 
        JOIN (SELECT a.id, a.section_id FROM attendances a 
        JOIN sections s 
        ON a.section_id = s.id where a.date >= ? and a.date <= ?) as1
        ON as2.attendance_id = as1.id where as2.student_id = ?) AS k', [$from, $to, $id]);
            return $attendances;
        }
        $attendances = DB::select('SELECT SUM(CASE WHEN status = -1 THEN 1 END) AS Absent,
        SUM(CASE WHEN status = 0 THEN 1 END) AS Late,
        SUM(CASE WHEN status = 1 THEN 1 END) AS Present
        FROM (SELECT as2.id, as2.attendance_id, as2.student_id, as1.section_id, as2.status FROM attendance_student as2 
        JOIN (SELECT a.id, a.section_id FROM attendances a 
        JOIN sections s 
        ON a.section_id = s.id) as1
        ON as2.attendance_id = as1.id and as2.student_id = ?) AS k', [$id]);
        return $attendances;
    }
}
