<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Record;
use Illuminate\Support\Facades\DB;
use Exception;

class RecordsController extends Controller
{
    public function recordList(Request $request) {

        if ($request->has('search') && $request->filled('info') && $request->filled('year')) { 
            $info = $request->input('info');
            $year = $request->input('year');

            $records = DB::table('records')
            ->where('libraryId', $info)
            ->whereYear('date', $year)
            ->orderBy('id', 'DESC')
            ->get();
            
        }else{
            $records = DB::table('records')->orderBy('id', 'DESC')
            ->limit(20)
            ->get();
        }

        return view('admin.records', ['recordsList' => $records]);
    }


}