<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface PaymentRepositoryInterface
{

    /**
     * Get all payments
     *
     * @return Collection
     */
    public function getPaymentsForUser(User $user): Collection;

    /**
     * Get payments by period
     *
     * @param string $startDate
     * @param string $endDate
     *
     * @return Collection $payments
     */
    public function getPaymentsByPeriod(string $startDate, string $endDate): Collection;

    /**
     * Get payments by period and type
     * @param string $startDate
     * @param string $endDate
     * @param string $type
     *
     * @return Collection $payments
     */
    public function getPaymentsByPeriodAndType(string $startDate, string $endDate, string $type = null): Collection;
}
