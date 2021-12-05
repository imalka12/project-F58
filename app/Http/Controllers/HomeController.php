<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionGroupCreateRequest;
use App\Http\Requests\CategoryCreateRequest;
use App\Models\OptionGroup;
use App\Models\User;
use App\Services\AdvertisementService;
use App\Services\CategoryService;
use App\Services\ClientAuthService;
use App\Services\DashboardService;
use App\Services\OptionGroupService;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    private $users;
    private $dashboard;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DashboardService $dashboard)
    {
        $this->middleware('auth');

        $this->dashboard = $dashboard;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function root()
    {
        // total users
        $totalUsers = $this->dashboard->getTotalUsers();

        // total ads
        $totalAds = $this->dashboard->getTotalAds();

        // monthly ad stats
        $monthlyAdStats = $this->dashboard->getCurrentMonthAdsStats();

        // published ads
        $currentMonthPublishedAds = $monthlyAdStats['published'];
        // promoted ads
        $currentMonthPromotedAds = $monthlyAdStats['promoted'];
        // renewed ads
        $currentMonthRenewedAds = $monthlyAdStats['renewed'];

        // this month total earnings
        $thisMonthTotalEarnings = $this->dashboard->getThisMonthTotalEarnings();
        // last month total earnings
        $lastMonthTotalEarnings = $this->dashboard->getLastMonthTotalEarnings();
        // up or down percentage
        $variationAmount = $thisMonthTotalEarnings['variationAmount'];
        $upDownPercentage = $thisMonthTotalEarnings['variationPercentage'];

        // yearly ad stats
        $yearlyAdStats = $this->dashboard->getCurrentYearAdsStats();

        return view(
            'pages.admin.index',
            compact(
                'totalUsers',
                'totalAds',
                'currentMonthPublishedAds',
                'currentMonthPromotedAds',
                'currentMonthRenewedAds',
                'thisMonthTotalEarnings',
                'lastMonthTotalEarnings',
                'variationAmount',
                'upDownPercentage',
                'yearlyAdStats',
            )
        );
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        // return $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'dob' => ['required', 'date', 'before:today'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->dob = date('Y-m-d', strtotime($request->get('dob')));

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            if (file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
            $user->avatar = '/images/' . $avatarName;
        }
        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            return response()->json([
                'isSuccess' => true,
                'Message' => "User Details Updated successfully!"
            ], 200); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Something went wrong!"
            ], 200); // Status code here
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200);
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }

    /**
     * Detele user profile
     * @param User $id
     */
    public function deleteUserProfile(User $user)
    {
        $this->users->delete($user);

        return redirect()->route('/')->with('success', 'Your profile deleted successfully');
    }
}
