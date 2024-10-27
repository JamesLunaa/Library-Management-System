<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Record;
use App\Models\Books;
use App\Models\BorrowedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;


class ApprovedListController extends Controller
{
    public function approvedList(Request $request)
    {
        if ($request->has('search') && $request->filled('info')) {
            $info = $request->input('info');
            
            // Search query
            $approvedList = DB::table('borrowedbooks')
                ->select('id', 'name', 'libraryId', 'title', 'date', 'accNo')
                ->where('form', 'Unclaimed')
                ->where('status', 'Approved')
                ->where('libraryId', $info)
                ->whereNotIn('libraryId', function ($query) {
                    $query->select('libraryId')
                          ->from('borrowedbooks')
                          ->where('form', 'Claimed');
                })
                ->whereNotIn('accNo', function ($query) {
                    $query->select('accNo')
                          ->from('borrowedbooks')
                          ->where('form', 'Claimed');
                })
                ->orderBy('id', 'ASC')
                ->get();
        } else {
            // Default query
            $approvedList = DB::table('borrowedbooks')
                ->select('id', 'name', 'libraryId', 'title', 'date', 'accNo')
                ->where('form', 'Unclaimed')
                ->where('status', 'Approved')
                ->whereNotIn('libraryId', function ($query) {
                    $query->select('libraryId')
                          ->from('borrowedbooks')
                          ->where('form', 'Claimed');
                })
                ->whereNotIn('accNo', function ($query) {
                    $query->select('accNo')
                          ->from('borrowedbooks')
                          ->where('form', 'Claimed');
                })
                ->whereNotIn('accNo', function ($query) {
                    $query->select('accNo')
                          ->from('books')
                          ->where('status', 'Unavailable');
                })
                ->orderBy('id', 'ASC')
                ->get();
        }

        return view('admin.approvedList', ['approved' => $approvedList]);
    }

    // Method for marking as Claimed
    public function markClaimed(Request $request)
    {
        try {
            $accessionNo = $request->input('claimed');
            $id = $request->input('id');

            // Update borrowedbooks table
            DB::table('borrowedbooks')
                ->where('accNo', $accessionNo)
                ->where('id', $id)
                ->update([
                    'form' => 'Claimed',
                    'borrowedDate' => now(),
                    'duration' => 1
                ]);

            // Update books table to set status to Unavailable
            DB::table('books')
                ->where('accNo', $accessionNo)
                ->update(['status' => 'Unavailable']);

            // Check and update delay
            DB::table('borrowedbooks')
                ->where('accNo', $accessionNo)
                ->where('id', $id)
                ->update([
                    'delay' => DB::raw("GREATEST(DATEDIFF(CURDATE(), DATE_ADD(borrowedDate, INTERVAL duration DAY)), 0)")
                ]);

        } catch (Exception $e) {
            // Log the error
            error_log($e->getMessage());
        }

        return redirect()->route('approvedList'); // Redirect back to list
    }

    // Method for handling cancellation
    public function cancelRequest(Request $request)
    {
        try {
            $accessionNo = $request->input('cancel');
            $id = $request->input('id');

            // Delete the entry from borrowedbooks
            DB::table('borrowedbooks')
                ->where('accNo', $accessionNo)
                ->where('id', $id)
                ->delete();

        } catch (Exception $e) {
            // Log the error
            error_log($e->getMessage());
        }

        return redirect()->route('approvedList'); // Redirect back to list
    }
}