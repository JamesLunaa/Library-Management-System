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
    public function ajaxSearch(Request $request){
    $info = $request->input('info');
    $bookList = DB::table('books as b')
        ->select('b.title', 'b.accNo', 'b.status as book_status', 'b.image_path')
        ->where('b.accNo', 'LIKE', '%' . $info . '%')
        ->orWhere('b.title', 'LIKE', '%' . $info . '%')
        ->distinct()
        ->orderBy('b.title', 'ASC')
        ->limit(10)
        ->get();

    return response()->json($bookList);
    }

    public function bookListAdmin(Request $request) {
        if ($request->has('search') && $request->filled('info')) {
            $info = $request->input('info');
            
            $bookList = DB::table('books as b')
            ->select('b.title', 'b.accNo', 'b.status as book_status', 'b.image_path')
            ->where('b.accNo', $info)
            ->orWhere('b.title', $info)
            ->orWhere(DB::raw('LOWER(b.title)'), 'LIKE', "%".strtolower($info)."%")
            ->distinct()
            ->orderBy('title', 'ASC')
            ->limit(10)
            ->get();
        }
        else {
            $bookList = DB::table('books as b')
            ->select('b.title', 'b.accNo', 'b.status as book_status', 'b.image_path')
            ->distinct()
            ->orderBy('b.title', 'ASC')
            ->get();
        }
        return view('admin.searchBook', ['list' => $bookList]);
    }

    public function changeStatus(Request $request) {
    $accNo = $request->input('accNo');
    $newStatus = $request->input('new_status');

    $check = BorrowedBook::where('accNo', $accNo)
    ->where('form', "Claimed")
    ->exists();

    if($check){
        return redirect()->route('admin.searchBook')->with('error', 'Status cannot be change because someone is currently borrowing the book!');
    }else {
        // Update the book's status in the database using query builder
        $updateQuery = Books::where('accNo', $accNo)->update(['status' => $newStatus]);
        return redirect()->route('admin.searchBook')->with('success', 'Status Updated!');
    }
    
    }
}