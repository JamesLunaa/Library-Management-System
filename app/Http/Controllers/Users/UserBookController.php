<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\BorrowedBook;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class UserBookController extends Controller
{
    public function userAjaxSearch(Request $request){
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

    public function bookList(Request $request) {
        if ($request->has('search') && $request->filled('info')) {
            $info = $request->input('info');
            
            $bookList = DB::table('books')
                ->select('title', 'accNo', 'status' , 'image_path')
                ->where('accNo', $info)
                ->orWhere('title', $info)
                ->orWhere(DB::raw('LOWER(title)'), 'LIKE', "%".strtolower($info)."%")
                ->orderBy('title', 'ASC')
                ->limit(10)
                ->get();
        }
        else {
            $bookList = DB::table('books')
                ->select('title', 'accNo', 'status', 'image_path')
                ->orderBy('title', 'ASC')
                ->get();
        }
        return view('user.searchBook', ['list' => $bookList]);
    }

    public function borrow(Request $request) {
        if ($request->has('borrow') && $request->filled('accNo')) {
            $accNo = $request->input('accNo');

            $borrowInfo = DB::table('books')
            ->select('title', 'accNo', 'status', 'author', 'synopsis')
            ->where('accNo', $accNo)
            ->get();

        $borrowingTime = Carbon::now()->format('h:i A'); // e.g., 02:30 PM
        }
        $todayDate = Carbon::today()->toDateString(); // Format: YYYY-MM-DD

    return view('user.borrowBook', ['list' => $borrowInfo, 'todayDate' => $todayDate, 'borrowingTime' => $borrowingTime,]);
    }

    public function thisBook(Request $request) {
        $name = $request->input('name');
        $userId = $request->input('libraryId');
        $accNo = $request->input('accNo');
        $date = $request->input('date');
        $duration = $request->input('duration');
        $title = $request->input('title');
        $status = 'Pending';
        $form = 'Unclaimed';

        //Check Approved
        $check = DB::table('borrowedbooks')
        ->where('libraryId', $userId)
        ->where('form', 'Claimed')
        ->where('status', 'Approved')
        ->exists();

        $availCheck = DB::table('books')
        ->where('accNo', $accNo)
        ->where('status', 'Unavailable')
        ->exists();

        if($availCheck) {
            return redirect()->route('user.searchBook')->with('error', 'Book is currently unavailable');
        }

        if($check) {
            return redirect()->route('user.searchBook')->with('error', 'You currently have a borrowed book or an approved request');
        }else {
            $check2 = DB::table('borrowedbooks')
            ->where('libraryId', $userId)
            ->where('accNo', $accNo)
            ->where('status', 'Pending')
            ->exists();

            if($check2){
                return redirect()->route('user.searchBook')->with('error', 'You have already requested to borrow this book');
            }else {
                BorrowedBook::create([
                    'name' => $name,
                    'libraryId' => $userId,
                    'title' => $title,
                    'date' => $date,
                    'duration' => $duration,
                    'accNo' => $accNo,
                    'status' => $status,
                    'form' => $form
                ]);
                return redirect()->route('user.searchBook')->with('success', 'Request is now Pending.');

            }
        }

    }

}