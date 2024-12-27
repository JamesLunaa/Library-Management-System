<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Record;
use App\Models\BorrowedBook;
use Illuminate\Support\Facades\DB;
use Exception;

class BorrowedBooksController extends Controller
{
    public function borrowedBooks(Request $request) {
        
        DB::table('borrowedbooks')
        ->where('form', 'Claimed')
        ->update([
            'delay' => DB::raw('GREATEST(DATEDIFF(CURDATE(), borrowedDate), 0)')
        ]);

        if($request->has('search') && $request->filled('info')) {
            $info = $request->input('info');

            $borrowedList = DB::table('borrowedbooks')
            ->select('id', 'name', 'libraryId', 'title', 'date', 'borrowedDate', 'accNo', 'delay')
            ->where('form', 'Claimed')
            ->where('libraryId', $info)
            ->orwhere('accNo', $info)

            ->orderBy('date', 'DESC')
            ->orderBy('id', 'ASC')
            ->get();
        }else {
            $borrowedList = DB::table('borrowedbooks')
            ->select('id', 'name', 'libraryId', 'title', 'date', 'borrowedDate', 'accNo', 'delay')
            ->where('form', 'Claimed')
            
            ->orderBy('date', 'DESC')
            ->orderBy('id', 'ASC')
            ->get();
        }

        return view('admin.borrowedBooks', ['borrowed' => $borrowedList]);
    }

    public function markReturned(Request $request) {
        try {
            // Fetch the accession number and ID from the form input
            $accessionNo = $request->input('returned');
            $id = $request->input('id');

            // Step 1: Update the borrowedbooks table to mark the book as 'Returned'
            BorrowedBook::where('accNo', $accessionNo)
                        ->where('id', $id)
                        ->update(['remarks' => 'Returned']);

            // Step 2: Update the books table to mark the book as 'Available'
            Books::where('accNo', $accessionNo)
                ->update(['status' => 'Available']);

            // Step 3: Retrieve the necessary details for insertion into the 'records' table
            $bookData = BorrowedBook::select('name', 'libraryId', 'title', 'accNo', 'date', 'borrowedDate', 'remarks', 'status')
                                    ->where('accNo', $accessionNo)
                                    ->where('id', $id)
                                    ->first();

                                    
            // Step 4: Insert the retrieved data into the 'records' table
            Record::create([
                'name' => $bookData->name,
                'libraryId' => $bookData->libraryId,
                'title' => $bookData->title,
                'accNo' => $bookData->accNo,
                'date' => $bookData->date,
                'borrowedDate' => $bookData->borrowedDate,
                'return_date' => now(), // Inserting current timestamp
                'remarks' => $bookData->remarks,
                'status' => $bookData->status
                ]);

            // Step 5: Delete the entry from the borrowedbooks table
            BorrowedBook::where('accNo', $accessionNo)
                        ->where('id', $id)
                        ->delete();
                        
            return redirect()->back()->with('success', 'Book Returned successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to return the book.');
        }
    }

    public function markLost(Request $request) { 
        try {
            $accessionNo = $request->input('lost');
            $id = $request->input('id');
            
            // Step 1: Update the borrowedbooks table to mark the book as 'Lost'
            BorrowedBook::where('accNo', $accessionNo)
                        ->where('id', $id)
                        ->update(['remarks' => 'Lost']);
            
            // Step 2: Retrieve the necessary details for insertion into the 'records' table
            $bookData = BorrowedBook::select('name', 'libraryId', 'title', 'accNo', 'date', 'borrowedDate', 'remarks', 'status')
                                    ->where('accNo', $accessionNo)
                                    ->where('id', $id)
                                    ->first();

            // Step 3: Insert the retrieved data into the 'records' table
            Record::create([
                'name' => $bookData->name,
                'libraryId' => $bookData->libraryId,
                'title' => $bookData->title,
                'accNo' => $bookData->accNo,
                'date' => $bookData->date,
                'borrowedDate' => $bookData->borrowedDate,
                'return_date' => now(), // Inserting current timestamp
                'remarks' => $bookData->remarks,
                'status' => $bookData->status
            ]);
                BorrowedBook::where('accNo', $accessionNo)
                ->where('remarks', 'Lost')
                ->delete();

                BorrowedBook::where('accNo', $accessionNo)
                ->update(['status' => 'Phased Out']);
    
                $bookData2 = BorrowedBook::where('accNo', $accessionNo)->get();
    
                foreach ($bookData2 as $book2) {
                    Record::create([
                        'name' => $book2->name,
                        'libraryId' => $book2->libraryId,
                        'title' => $book2->title,
                        'accNo' => $book2->accNo,
                        'date' => $book2->date,
                        'borrowedDate' => $book2->borrowedDate,
                        'return_date' => now(), // Inserting current timestamp
                        'remarks' => $book2->remarks,
                        'status' => $book2->status
                    ]);
                }
                
                // Step 4: Delete the entry from the borrowedbooks table
                BorrowedBook::where('accNo', $accessionNo)
                ->delete();
                
                // Step 5: Delete the entry from the books table
                Books::where('accNo', $accessionNo)
                ->update(['status' => 'Phased Out']);
                
                return redirect()->back()->with('success', 'Book is lost.');
            
            
        }catch (Exception $e) {
            // Log the error
            return redirect()->back()->with('error', 'Failed to return the book.');

        }
    }

}