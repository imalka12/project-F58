<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function showPostAdvertisementPage()
    {
        return view('pages.web.user.post-advertisements');
    }
}
