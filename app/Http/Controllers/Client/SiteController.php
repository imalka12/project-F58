<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    /**
     * Returns the home view
     */
    public function home()
    {
        // Return home page inside pages. web folder
        return view('pages.web.home');
    }

    /**
     * Show About Us page
     */
    public function about()
    {
        return view('pages.web.about');
    }

    /**
     * Show FAQs pages
     */
    public function faq()
    {
        return view('pages.web.faq');
    }

    /**
     * Show pricing page
     */
    public function pricing()
    {
        return view('pages.web.pricing');
    }

    /**
     * Show contact page
     */
    public function contact()
    {
        return view('pages.web.contact');
    }

}
