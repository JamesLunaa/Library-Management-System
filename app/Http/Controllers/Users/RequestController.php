<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BorrowedBook;
use Illuminate\Support\Facades\DB;
use Exception;

class RequestController extends Controller
{
    public function requestList(Request $request) {
        $userId = session('libId');
        
        $myRequest = DB::table('borrowedbooks')
        ->select('date', 'title', 'accNo', 'status', 'form', 'id')
        ->where('libraryId', $userId)
        ->where('form', 'Unclaimed')

        ->orderBy('date', 'DESC')
        ->orderBy('id', 'DESC')
        ->get();

        return view('user.requestStatus', ['myRequest' => $myRequest]);
    }

    public function cancel(Request $request) {
        $id = $request->input('id');
        $accessionNo = $request->input('cancel');

        BorrowedBook::where('accNo', $accessionNo)
        ->where('id', $id)
        ->delete();

        return redirect()->route('user.requestStatus');
    }
}