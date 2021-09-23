<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientProfileUpdateRequest;
use App\Models\City;
use App\Models\User;
use App\Services\AdvertisementService;
use App\Services\ClientAuthService;
use App\Services\LocationService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $clientAuth;
    private $locations;
    private $advertisements;

    public function __construct(ClientAuthService $clientAuthService, LocationService $locationService, AdvertisementService $advertisementService) {
        $this->clientAuth = $clientAuthService;
        $this->locations = $locationService;
        $this->advertisements = $advertisementService;
    }

    /**
     * Show client profile page
     *
     * @return void
     */
    public function showProfilePage()
    {
        $user = $this->clientAuth->getLoggedInUserWithProfile();

        if($user->role_id == 3) {
            return redirect()->route('root');
        }

        $cities = $this->locations->getCitiesForSelects();
        $advertisements = $this->advertisements->getAllAdsCategorizedForCurrentUser();

        return view('pages.web.user.profile', compact('user', 'cities', 'advertisements'));
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
}
