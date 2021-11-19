<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormSubmissionRequest;
use App\Mail\ContactFormSubmitted;
use App\Models\ContactFormSubmission;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    private $categories;

    public function __construct(CategoryService $categoryService)
    {
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

    /**
     * Process contact form submission
     *
     * @param ContactFormSubmissionRequest $request
     * @return void
     */
    public function processContactFormSubmission(ContactFormSubmissionRequest $request)
    {
        // validate
        $data = $request->validated();

        // save data
        ContactFormSubmission::create($data);

        // TODO: send response email
        Mail::to($data['email'])
        ->send(new ContactFormSubmitted($data['name'], $data['email']));

        // redirect with success message
        return redirect()->route('site.contact')
        ->with('success', 'Your contact request submitted successfully.');
    }
}
