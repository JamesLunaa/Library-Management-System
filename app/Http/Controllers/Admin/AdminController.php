<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function searchBook()
    {
        return view('admin.searchBook');
    }

    public function addBook()
    {
        return view('admin.addBook');
    }

    public function addUser()
    {
        return view('admin.addUser');
    }

    public function approvedList()
    {
        return view('admin.approvedList');
    }

    public function attendance()
    {
        return view('admin.attendance');
    }

    public function borrowedBooks()
    {
        return view('admin.borrowedBooks');
    }

    public function changePass()
    {
        return view('admin.changePass');
    }

    public function records()
    {
        return view('admin.records');
    }

    public function removeBook()
    {
        return view('admin.removeBook');
    }

    public function removeUser()
    {
        return view('admin.removeUser');
    }

    public function requestInbox()
    {
        return view('admin.requestInbox');
    }


}