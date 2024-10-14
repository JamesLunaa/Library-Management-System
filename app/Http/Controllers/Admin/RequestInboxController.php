<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\BorrowedBook;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RequestInboxController extends Controller
{
    public function requestInbox(Request $request) 
    {
        if ($request->has('search') && $request->filled('info')) {
            $info = $request->input('info');
            
            // Search query
            $requestInbox = DB::table('borrowedbooks as bb')
            ->join('books as b', 'bb.accNo', '=', 'b.accNo')
            ->where('bb.form', 'Unclaimed')
            ->where('bb.status', 'Pending')
            ->where('b.status', 'Available')
            ->where('bb.libraryId', $info) // Dynamically filter by libraryId
            ->whereNotIn('bb.libraryId', function($query) {
                $query->select('libraryId')
                      ->from('borrowedbooks')
                      ->where('form', 'Claimed');
                      
            })
            ->whereNotIn('bb.accNo', function($query) {
                $query->select('accNo')
                      ->from('borrowedbooks')
                      ->where('form', 'Claimed');
            })
            
            ->orderBy('bb.id', 'ASC')
            ->get(['bb.id', 'bb.name', 'bb.libraryId', 'bb.title', 'bb.date', 'bb.accNo']);
        } else {
            // Default query
            $requestInbox = DB::table('borrowedbooks as bb')
            ->join('books as b', 'bb.accNo', '=', 'b.accNo')
            ->where('bb.form', 'Unclaimed')
            ->where('bb.status', 'Pending')
            ->where('b.status', 'Available')
            
            ->whereNotIn('bb.libraryId', function($query) {
                $query->select('libraryId')
                      ->from('borrowedbooks')
                      ->where(function ($subQuery) {
                          $subQuery->where('status', 'Approved')
                                   ->orWhere('form', 'Claimed');
                      });
            })
            ->whereNotIn('bb.accNo', function($query) {
                $query->select('accNo')
                      ->from('borrowedbooks')
                      ->where('form', 'Claimed');
                      
            })
           
            ->orderBy('bb.id', 'ASC')
            ->get(['bb.id', 'bb.name', 'bb.libraryId', 'bb.title', 'bb.date', 'bb.accNo']);
        }
        
        return view('admin.requestInbox', ['requestList' => $requestInbox]);
    }
    
    
    public function approveRequest(Request $request)
    {
        try {
            // Retrieve the necessary data
            $accessionNo = $request->input('approve');
            $id = $request->input('id');

            // Approve the book by updating the status in 'borrowedbooks'
            BorrowedBook::where('accNo', $accessionNo)
                ->where('id', $id)
                ->update(['status' => 'Approved']);

            return redirect()->back()->with('success', 'Request approved successfully.');
        } catch (Exception $e) {
            // Handle exceptions if any
            return redirect()->back()->with('error', 'Failed to approve the request.');
        }
    }

    public function rejectRequest(Request $request)
    {
        try {
            // Retrieve the necessary data
            $accessionNo = $request->input('reject');
            $id = $request->input('id');

            
            // Fetch the details of the rejected book request
            $book = BorrowedBook::where('accNo', $accessionNo)->where('id', $id)->first();
            
            // Insert the book data into the 'records' table
            Record::create([
                'name' => $book->name,
                'libraryId' => $book->libraryId,
                'title' => $book->title,
                'date' => $book->date,
                'accNo' => $book->accNo,
                'return_date' => now(),
                'remarks' => $book->remarks,
                'status' => 'Rejected'
            ]);

            // Delete the rejected request from 'borrowedbooks'
            $book->delete();
            
            return redirect()->back()->with('success', 'Request rejected successfully.');
        } catch (Exception $e) {
            // Handle exceptions if any
            return redirect()->back()->with('error', 'Failed to reject the request.');
        }
    }
    
}