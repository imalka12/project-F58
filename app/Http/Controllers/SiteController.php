<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{

    /**
     * Returns the home view
     */
    public function home()
    {
        /*
        Return home page
        inside pages. web folder
        */
        return view('pages.web.home');
    }

    public function about()
    {
        return view('pages.web.about');
    }

    public function faq()
    {
        return view('pages.web.faq');
    }

    public function pricing()
    {
        return view('pages.web.pricing');
    }

    public function contact()
    {
        return view('pages.web.contact');
    }

}
