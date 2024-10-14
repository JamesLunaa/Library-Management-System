<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User; // Make sure you have a User model set up
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'libId' => 'required|integer|unique:users,libraryId',
        ]);

        $user = new User();
        $user->name = strtoupper($request->input('name'));
        $user->libraryId = $request->input('libId');
        $user->pass = Hash::make($request->input('libId'));
        $user->accLevel = 'user';

        if ($user->save()) {
            return redirect()->back()->with('success', 'User successfully registered!');
        } else {
            return redirect()->back()->withErrors(['registration' => 'Error while registering User.']);
        }
    }
}