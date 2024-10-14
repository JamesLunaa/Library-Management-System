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

            $userList = DB::table('users')
            ->select('name', 'libraryId')
            ->where('libraryId', $libId)
            ->where('accLevel', 'user')
            ->get();
        }else {
            $userList = DB::table('users')
            ->select('name', 'libraryId')
            ->where('accLevel', 'user')
            ->get();
        }
        return view('admin.removeUser', ['remove' => $userList]);
    }

    public function deleteUser(Request $request) {
        try{
            $libraryId = $request->input('delete');


            User::where('libraryId', $libraryId)
            ->delete();

            BorrowedBook::where('libraryId', $libraryId)
            ->delete();

            return redirect()->route('admin.removeUser');
        }catch (Exception $e) {
            // Log the error
            error_log($e->getMessage());
        }
    }
    
}