<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class AttendanceController extends Controller
{
    public function attendanceList(Request $request) {
        if ($request->has('search') && $request->filled('info') && $request->filled('year')) { 
            $info = $request->input('info');
            $year = $request->input('year');

            $attendance = DB::table('attendance')
            ->where('libraryId', $info)
            ->whereYear('date', $year)
            ->orderBy('date', 'DESC')
            ->get();

            $totalAttendance = DB::table('attendance')
            ->where('libraryId', $info)
            ->whereYear('date', $year)
            ->count();

            $totalRecord = null;
            
        }else{
            $attendance = DB::table('attendance')->orderBy('date', 'DESC')
            ->limit(20)
            ->get();

            $totalAttendance = null;

            $totalRecord = DB::table('attendance')
            ->count();
        }
        return view('admin.attendance', [
            'attendanceList' => $attendance,
            'totalAttendance' => $totalAttendance,
            'totalRecord' => $totalRecord
        ]);
    }
}