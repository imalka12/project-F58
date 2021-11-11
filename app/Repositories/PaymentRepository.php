<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Models\User;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PaymentRepository implements PaymentRepositoryInterface
{
    /**
     * Get Payments for user
     *
     * @param User $user
     * @return Collection
     */
    public function getPaymentsForUser(User $user): Collection
    {
        return Payment::where('user_id', $user->id)->with('advertisement')->orderBy('created_at', 'desc')->get();
    }
}
