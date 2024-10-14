<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function searchBook()
    {
        return view('user.searchBook');
    }

    public function requestStatus()
    {
        return view('user.requestStatus');
    }

    public function borrowedBook()
    {
        return view('user.borrowedBook');
    }

    public function records()
    {
        return view('user.records');
    }
    
    public function feedback()
    {
        return view('user.userFeedback');
    }

    public function changePass()
    {
        return view('user.userChangePass');
    }
}