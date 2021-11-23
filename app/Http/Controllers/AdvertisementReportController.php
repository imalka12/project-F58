<?php

namespace App\Http\Controllers;

use App\Models\AdvertisementReport;
use Illuminate\Http\Request;

class AdvertisementReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // load view here
        $submissions = AdvertisementReport::paginate(4);

        return view('pages.admin.advertisement-reports' , compact('submissions'));
    }
}
