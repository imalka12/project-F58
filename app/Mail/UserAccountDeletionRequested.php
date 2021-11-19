<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class UserAccountDeletionRequested extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = URL::temporarySignedRoute(
            'user.profile.delete',
            now()->addHours(6),
            ['user' => $this->user->id]
        );

        return $this->view('emails.user-account-delete-requested')
        ->subject('Please Confirm Account Deletion | ' . config('app.name'))
        ->with('url', $url)
        ->with('user', $this->user);
    }
}
