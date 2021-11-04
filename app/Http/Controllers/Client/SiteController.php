<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    private $categories;

    public function __construct(CategoryService $categoryService) {
        $this->categories = $categoryService;
    }

    /**
     * Returns the home view
     */
    public function home()
    {
        // get categories
        $categories = $this->categories->list();
        $categoriesWithAdsCount = $this->categories->getCategoriesWithAdsCount();

        // Return home page inside pages. web folder
        return view('pages.web.home', compact('categories', 'categoriesWithAdsCount'));
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
