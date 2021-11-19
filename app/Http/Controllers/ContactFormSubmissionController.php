<?php

namespace App\Http\Controllers;

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
}
