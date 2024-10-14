<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\BorrowedBook;
use App\Models\Record;
use Illuminate\Support\Facades\DB;
use Exception;

class RemoveBookController extends Controller
{
    public function removeBook(Request $request) {

        if ($request->has('search') && $request->filled('info')) {
            $info = $request->input('info');

            $removeList = DB::table('books')
            ->select('title', 'accNo', 'status')
            ->where('accNo', $info)
            ->orWhere('title', $info)
            ->get();
        }else {
            $removeList = DB::table('books')
            ->select('title', 'accNo', 'status')

            ->get();
        }
        return view('admin.removeBook', ['remove' => $removeList]);
    }

    public function deleteBook(Request $request) {
        try {
            $accessionNo = $request->input('lost');
            
            BorrowedBook::where('accNo', $accessionNo)
            ->update(['status' => 'Phased Out']);

            $bookData = BorrowedBook::where('accNo', $accessionNo)->get();

            foreach ($bookData as $book) {
                Record::create([
                    'name' => $book->name,
                    'libraryId' => $book->libraryId,
                    'title' => $book->title,
                    'accNo' => $book->accNo,
                    'date' => $book->date,
                    'borrowedDate' => $book->borrowedDate,
                    'return_date' => now(), // Inserting current timestamp
                    'remarks' => $book->remarks,
                    'status' => $book->status
                ]);
            }

            BorrowedBook::where('accNo', $accessionNo)
            ->delete();

            Books::where('accNo', $accessionNo)
            ->delete();

            return redirect()->route('admin.removeBook');
        }catch (Exception $e) {
            // Log the error
            error_log($e->getMessage());
        }
        
    }
}