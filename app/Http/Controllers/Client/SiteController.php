<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    /**
     * Returns the home view
     */
    public function home()
    {
        // get categories
        $categories = Category::orderBy('title')->get();

        // Return home page inside pages. web folder
        return view('pages.web.home', compact('categories'));
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
