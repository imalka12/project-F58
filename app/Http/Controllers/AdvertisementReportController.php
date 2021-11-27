<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
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

        return view('pages.admin.advertisement-reports', compact('submissions'));
    }

    /**
     * Reported advertisement force to expire
     * 
     * @param Request $request
     * @param Advertisement $advertisement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function advertisementForceToExpire(Request $request, Advertisement $advertisement)
    {
        $advertisement->update([
            'expire_at' => now()->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('admin.advertisement-reports')->with('success', 'Advertisement force expired successfully.');
    }

    /**
     * Reported advertisement force to delete
     * 
     * @param Request $request
     * @param Advertisement $advertisement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function advertisementForceToDelete(Request $request, Advertisement $advertisement)
    {
        $advertisement->delete([
            'deleted_at' => now()->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('admin.advertisement-reports')->with('success', 'Advertisement force deleted successfully');
    }

    /**
     * Reported report dismiss
     * 
     * @param Request $request
     * @param Advertisement $advertisement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function advertisementReportDismiss(Request $request, AdvertisementReport $report)
    {
        $report->delete([
            'deleted_at' => now()->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('admin.advertisement-reports')->with('success', 'Report record deleted successfully');
    }
}
