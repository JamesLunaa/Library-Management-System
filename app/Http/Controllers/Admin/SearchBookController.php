<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\BorrowedBook;
use Illuminate\Support\Facades\DB;
use Exception;

class SearchBookController extends Controller
{
    public function bookList(Request $request) {
        if ($request->has('search') && $request->filled('info')) {
            $info = $request->input('info');
            
            $bookList = DB::table('books as b')
                ->leftJoin('borrowedbooks as bb', 'b.accNo', '=', 'bb.accNo')
                ->select('b.title', 'b.accNo', 'b.status as book_status', 'bb.status as borrowedbooks_status', 'b.image_path')
                ->where('b.accNo', $info)
                ->orWhere('b.title', $info)
                ->orWhere(DB::raw('LOWER(b.title)'), 'LIKE', "%".strtolower($info)."%")

                ->orderBy('title', 'ASC')
                ->get();
        }
        else {
            $bookList = DB::table('books as b')
            ->leftJoin('borrowedbooks as bb', 'b.accNo', '=', 'bb.accNo')
            ->select('b.title', 'b.accNo', 'b.status as book_status', 'bb.status as borrowedbooks_status', 'b.image_path')
            
            ->orderBy('title', 'ASC')
            ->get();
        }
        return view('admin.searchBook', ['list' => $bookList]);
    }

    public function changeStatus(Request $request) {
    $accNo = $request->input('accNo');
    $newStatus = $request->input('new_status');

    // Update the book's status in the database using query builder
    $updateQuery = Books::where('accNo', $accNo)->update(['status' => $newStatus]);

    // Check if the update was successful
    if ($updateQuery) {
        // Return back with a success message
        return redirect()->back()->with('success', 'Status Updated!');
    } else {
        // Return back with an error message
        return redirect()->back()->with('error', 'System Error!');
    }
    }
}