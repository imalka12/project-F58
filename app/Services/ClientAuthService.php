<?php

namespace App\Services;

use App\Http\Requests\ClientLoginRequest;
use App\Http\Requests\ClientProfileUpdateRequest;
use App\Http\Requests\ClientSignupRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientAuthService
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Signup a client user
     *
     * @param array $data
     * @return void
     */
    public function signUp(ClientSignupRequest $request)
    {
        $data = $request->validated();

        // has password
        $data['password'] = Hash::make($data['password']);

        // create user and profile
        $user = $this->userRepository->create($data);

        // log in the user - with remember set to true
        Auth::login($user, true);

        // fire registered events
        event(new Registered($user));
    }

    /**
     * Login the given user
     *
     * @param User $user
     * @return bool $isLoggedIn Returns true if logged in, false otherwise
     */
    public function login(ClientLoginRequest $request)
    {
        // get validated data
        $data = $request->validated();

        // get the user for the email address
        $user = $this->userRepository->findBy('email', $data['email']);

        // return false if user not found
        if (is_null($user)) {
            return false;
        }

        // verify password
        $passwordVerified = Hash::check($data['password'], $user->password);

        // return to login page if password is incorrect
        if (!$passwordVerified) {
            return false;
        }

        // check if remember me option is checked
        $isRememberMe = $request->post('remember_me') ? true : false;

        Auth::login($user, $isRememberMe);

        return true;
    }

    /**
     * Set the status of user account as active
     *
     * @return void
     */
    public function setActive()
    {
        // get current logged in user
        $userId = auth()->user()->id;

        $user = $this->userRepository->find($userId);

        $this->userRepository->setActive($user);
    }

    /**
     * Find user account by specified id
     *
     * @param mixed $userId
     * @return void
     */
    public function findClientByUserId($userId): User
    {
        return $this->userRepository->find($userId);
    }

    /**
     * Get logged in user with profile relation
     *
     * @return User $user
     */
    public function getLoggedInUserWithProfile()
    {
        $loggedInUser = auth()->user();
        if (!$loggedInUser) {
            return null;
        }

        return $this->findClientByUserId($loggedInUser->id);
    }

    /**
     * Update profile of current logged in user
     *
     * @param ClientProfileUpdateRequest $request
     * @return void
     */
    public function updateClientProfile(ClientProfileUpdateRequest $request)
    {
        $data = $request->validated();

        $user = $this->getLoggedInUserWithProfile();

        $user->update([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
        ]);

        $user->profile->update([
            'address_line_1' => $data['address_line_1'],
            'address_line_2' => $data['address_line_2'],
            'city_id' => $data['city_id'],
            'telephone' => $data['telephone'],
        ]);
    }

    /**
     * Deletes user profile
     *
     * @param User $user
     * @return void
     */
    public function deleteUser(User $user)
    {
        return $this->userRepository->delete($user->id);
    }

    public function getUserByEmailAddress($email)
    {
        return $this->userRepository->findBy('email', $email);
    }

    public function sendPasswordResetEmail($email)
    {
        $user = $this->getUserByEmailAddress($email);

        if (!$user) {
            return false;
        }

        $user->sendPasswordResetNotification($user->getEmailForPasswordReset());

        return true;
    }
}
