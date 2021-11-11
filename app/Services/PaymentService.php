<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\PaymentRepository;

class PaymentService
{
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getAllPaymentsForCurrentUser()
    {
        $user = auth()->user();
        return $this->paymentRepository->getPaymentsForUser($user);
    }
}
