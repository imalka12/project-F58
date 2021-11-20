<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientProfileUpdateRequest;
use App\Mail\UserAccountDeletionRequested;
use App\Models\User;
use App\Services\AdvertisementService;
use App\Services\ClientAuthService;
use App\Services\LocationService;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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
     * Handle client account deletion request
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function processDeleteRequest(Request $request, User $user)
    {
        $this->sendAccountDeleteConfirmationEmail($user);

        // redirect
        return redirect()->route('site.home')->with('success', 'Please check your email for a confirmation email.');
    }

    /**
     * Delete user profile
     *
     * @param User $id
     *
     */
    public function deleteUserProfile(Request $request, User $user)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        // delete ads
        $this->advertisements->deleteAdvertisementsByUser($user);

        // delete user
        $this->clientAuth->deleteUser($user);

        // send user account deleted confirmation
        $this->sendAccountDeletedEmail($user);

        // logout the currently logged user.
        Auth::logout();

        return redirect()->route('site.home')->with('success', 'Your profile deleted successfully.');
    }

    /**
     * Send confirmation email to user for deleting his account
     *
     * @param User $user
     */
    private function sendAccountDeleteConfirmationEmail(User $user)
    {
        // send email
        Mail::to($user->email)->send(new UserAccountDeletionRequested($user));
    }

    /**
     * Send email to user that his account has been deleted
     *
     * @param User $user
     */
    private function sendAccountDeletedEmail(User $user)
    {
        # code...
    }
}
