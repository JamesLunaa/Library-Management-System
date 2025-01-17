<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BorrowedBook;
use Illuminate\Support\Facades\DB;

class RemoveUserController extends Controller
{
    public function userList(Request $request) {
        if($request->has('search') && $request->filled('libId')) {
            $libId = $request->input('libId');

            $userList = DB::table('users as b')
            ->leftJoin('borrowedbooks as bb', 'b.libraryId', '=', 'bb.libraryId')
            ->select('b.name', 'b.libraryId', 'bb.form')
            ->where('b.libraryId', $libId)
            ->where('b.accStatus', 'Active')
            ->where('b.accLevel', 'user')
            ->orWhere('b.accLevel', 'Instructor')
            ->get();

        }else {
            $userList = DB::table('users as b')
            ->leftJoin('borrowedbooks as bb', 'b.libraryId', '=', 'bb.libraryId')
            ->select('b.name', 'b.libraryId', 'bb.form')
            ->where('b.accStatus', 'Active')
            ->where('b.accLevel', 'user')
            ->orWhere('b.accLevel', 'Instructor')
            ->limit(20)
            ->get();
        }
        return view('admin.removeUser', ['remove' => $userList]);
    }

    public function deleteUser(Request $request) {
        try{
            $libraryId = $request->input('delete');


            User::where('libraryId', $libraryId)
            ->update(['accStatus' => 'Inactive']);

            BorrowedBook::where('libraryId', $libraryId)
            ->delete();

            return redirect()->route('admin.removeUser');
        }catch (Exception $e) {
            // Log the error
            error_log($e->getMessage());
        }
    }
    
}