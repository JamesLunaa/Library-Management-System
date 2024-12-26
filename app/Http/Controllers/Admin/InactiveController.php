<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class InactiveController extends Controller
{
    public function inactiveList(Request $request) {
        if($request->has('search') && $request->filled('libId')) {
            $libId = $request->input('libId');

            $userList = DB::table('users as b')
            ->leftJoin('borrowedbooks as bb', 'b.libraryId', '=', 'bb.libraryId')
            ->select('b.name', 'b.libraryId', 'bb.form')
            ->where('b.libraryId', $libId)
            ->where('b.accLevel', 'user')
            ->where('b.accStatus', 'Inactive')
            ->get();

        }else {
            $userList = DB::table('users as b')
            ->leftJoin('borrowedbooks as bb', 'b.libraryId', '=', 'bb.libraryId')
            ->select('b.name', 'b.libraryId', 'bb.form')
            ->where('b.accLevel', 'user')
            ->where('b.accStatus', 'Inactive')
            ->limit(20)
            ->get();
        }
        return view('admin.inactiveList', ['remove' => $userList]);
    }

    public function activateUser(Request $request) {
        try{
            $libraryId = $request->input('active');


            User::where('libraryId', $libraryId)
            ->update(['accStatus' => 'Active']);

            return redirect()->route('admin.removeUser');
        }catch (Exception $e) {
            // Log the error
            error_log($e->getMessage());
        }
    }
}