<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function __construct()
    {
        // check if this is a logged in user with a middleware
        // redirect to login page if not a valid user
    }

    public function showProfilePage()
    {
        $user = auth()->user();
        return view('pages.web.user.profile', compact('user'));
    }
}
