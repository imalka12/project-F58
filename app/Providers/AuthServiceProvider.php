<?php

namespace App\Providers;

use App\Notifications\ClientRegistered;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // customize email verification template and sending data
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            // get logged in user
            $loggedInUser = auth()->user();
            // create a new email using the template
            return (new MailMessage)
                ->view('emails.client-registered', ['url' => $url, 'user' => $loggedInUser])
                ->subject('Hello ' . $loggedInUser->firstname . '! Please verify Your Email Address');
        });
    }
}
