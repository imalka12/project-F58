<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormSubmissionRequest;
use App\Models\ContactFormSubmission;
use Illuminate\Http\Request;

class ContactFormSubmissionController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $submissions = ContactFormSubmission::paginate(4);

        return view('pages.admin.contact-form-submissions', compact('submissions'));
    }

    public function processContactFormSubmission(ContactFormSubmissionRequest $request)
    {
        // validate
        $data = $request->validated();

        // save data
        ContactFormSubmission::create($data);

        // TODO: send response email

        // redirect with success message
        return redirect()->route('site.contact')
        ->with('success', 'Your contact request submitted successfully.');
    }
}
