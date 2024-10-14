<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class UserBorrowedController extends Controller
{
    public function borrowedBook(Request $request){
        DB::table('borrowedbooks')
        ->where('form', 'Claimed')
        ->update([
            'delay' => DB::raw('GREATEST(DATEDIFF(CURDATE(), borrowedDate), 0)')
        ]);
        
        $userId = session('libId');

        $borrowed = DB::table('borrowedbooks')
        ->select('title', 'accNo', 'date', 'borrowedDate', 'duration', 'delay')
        ->where('libraryId', $userId)
        ->where('form', 'Claimed')
        ->get();

        return view('user.userBorrowed', ['userBorrowed' => $borrowed]);
    }
}