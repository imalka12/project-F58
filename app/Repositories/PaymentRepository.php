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

    public function getPaymentsByPeriod(string $startDate, string $endDate): Collection
    {
        return Payment::whereBetween('created_at', [$startDate, $endDate])
            ->with('advertisement')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getPaymentsByPeriodAndType(string $startDate, string $endDate, string $type = null): Collection
    {
        return Payment::whereBetween('created_at', [$startDate, $endDate])
            ->where('type', $type)
            ->with('advertisement')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
