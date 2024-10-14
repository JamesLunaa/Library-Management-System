<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Books;

class AddBookController extends Controller
{
    
    public function addBook(Request $request) {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'accNo' => 'required|integer|unique:books,accNo',
            'author' => 'required|string|max:255',
            'synopsis' => 'required|string|max:5000',
            'image' => 'required|mimes:jpg,png,jpeg|max:10000'
        ]);

        $bookCover = time() . '-' . $request->accNo . '-' . 
        $request->image->extension();

        $request->image->move(public_path('BookCovers'), $bookCover);

        $book = new Books();
        $book->title = strtoupper($request->input('title'));
        $book->accNo = $request->input('accNo');
        $book->author = $request->input('author');
        $book->synopsis = $request->input('synopsis');
        $book->status = 'Available';
        $book->image_path = $bookCover;

        if ($book->save()) {
            return redirect()->back()->with('success', 'Book successfully registered!');
        } else {
            return redirect()->back()->withErrors(['registration' => 'Error while registering Book.']);
        }
        
    }
}