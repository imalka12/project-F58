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
}
