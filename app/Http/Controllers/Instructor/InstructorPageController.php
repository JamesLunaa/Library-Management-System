<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstructorPageController extends Controller
{
    public function changePass()
    {
        return view('instructor.instructorChangePass');
    }
}