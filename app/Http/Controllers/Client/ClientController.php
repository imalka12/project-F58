<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientProfileUpdateRequest;
use App\Models\User;
use App\Services\AdvertisementService;
use App\Services\ClientAuthService;
use App\Services\LocationService;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    private $clientAuth;
    private $locations;
    private $advertisements;
    private $payments;

    public function __construct(
        ClientAuthService $clientAuthService,
        LocationService $locationService,
        AdvertisementService $advertisementService,
        PaymentService $paymentService
    ) {
        $this->clientAuth = $clientAuthService;
        $this->locations = $locationService;
        $this->advertisements = $advertisementService;
        $this->payments = $paymentService;
    }

    /**
     * Show client profile page
     *
     * @return void
     */
    public function showProfilePage()
    {
        $user = $this->clientAuth->getLoggedInUserWithProfile();

        if ($user->role_id == 3) {
            return redirect()->route('root');
        }

        $cities = $this->locations->getCitiesForSelects();
        $advertisements = $this->advertisements->getAllAdsCategorizedForCurrentUser();
        $payments = $this->payments->getAllPaymentsForCurrentUser();

        $paymentTypes = [
            'publish' => 'to publish',
            'promote' => 'to promote',
            'renew' => 'to renew',
        ];

        return view('pages.web.user.profile', compact('user', 'cities', 'advertisements', 'payments', 'paymentTypes'));
    }

    /**
     * Handle client profile update request
     *
     * @param ClientProfileUpdateRequest $request
     * @return void
     */
    public function updateClientProfile(ClientProfileUpdateRequest $request)
    {
        $this->clientAuth->updateClientProfile($request);

        return redirect()->route('client.profile')
            ->with('success', 'Profile updated successfully.');
    }


    /**
     * Delete user profile
     *
     * @param User $id
     *
     */
    public function deleteUserProfile(User $user)
    {
        $this->clientAuth->deleteUser($user);

        // TODO: send email to user email address

        // logout the currently logged user.
        Auth::logout();

        return redirect()->route('site.home')->with('success', 'Your profile deleted successfully.');
    }
}
