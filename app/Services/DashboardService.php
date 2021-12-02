<?php

namespace App\Services;

use App\Repositories\AdvertisementRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;

class DashboardService
{

    private $advertisementRepository;
    private $userRepository;
    private $paymentRepository;

    public function __construct(
        AdvertisementRepository $advertisementRepository,
        UserRepository $userRepository,
        PaymentRepository $paymentRepository
    ) {
        $this->advertisementRepository = $advertisementRepository;
        $this->userRepository = $userRepository;
        $this->paymentRepository = $paymentRepository;
    }

    // total users
    public function getTotalUsers()
    {
        $defaultRole = $this->userRepository->getDefaultRole();
        return $this->userRepository->getAllUsersByRole($defaultRole)->count();
    }

    // total ads
    public function getTotalAds()
    {
        return $this->advertisementRepository->getAllAds()->count();
    }

    public function getCurrentMonthAdsStats()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        return $this->getAdsByPeriod($currentYear, $currentMonth);
    }

    // monthly ad stats
    // published ads
    // promoted ads
    // renewed ads
    public function getAdsByPeriod($year, $month = false)
    {
        if ($month) {
            $startDate = Carbon::createFromDate($year, $month, 1);
            $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
        } else {
            $startDate = Carbon::createFromDate($year, 1, 1);
            $endDate = Carbon::createFromDate($year, 1, 1)->endOfYear();
        }

        return [
            'published' => $this->advertisementRepository->getAdsByPeriodAndType(
                $startDate,
                $endDate,
                'published'
            )->count(),
            'promoted' => $this->advertisementRepository->getAdsByPeriodAndType(
                $startDate,
                $endDate,
                'promoted'
            )->count(),
            'renewed' => $this->advertisementRepository->getAdsByPeriodAndType(
                $startDate,
                $endDate,
                'renewed'
            )->count(),
        ];
    }

    public function getThisMonthTotalEarnings()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        return $this->getPaymentsData($currentYear, $currentMonth);
    }

    public function getLastMonthTotalEarnings()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        if ($currentMonth == 1) {
            $lastMonth = 12;
            $lastYear = $currentYear - 1;
        } else {
            $lastMonth = $currentMonth - 1;
            $lastYear = $currentYear;
        }

        return $this->getPaymentsData($lastYear, $lastMonth);
    }

    // this month total earnings
    // last month total earnings
    // up or down percentage
    // yearly ad stats
    // published ads
    // promoted ads
    // renewed ads
    public function getPaymentsData($year, $month = null)
    {
        if ($month) {
            $startDate = Carbon::createFromDate($year, $month, 1);
            $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
        } else {
            $startDate = Carbon::createFromDate($year, 1, 1);
            $endDate = Carbon::createFromDate($year, 1, 1)->endOfYear();
        }

        $publishedAds = $this->paymentRepository->getPaymentsByPeriodAndType($startDate, $endDate, 'published');
        $promotedAds = $this->paymentRepository->getPaymentsByPeriodAndType($startDate, $endDate, 'promoted');
        $renewedAds = $this->paymentRepository->getPaymentsByPeriodAndType($startDate, $endDate, 'renewed');

        // this month payments
        $thisMonthStart = Carbon::now()->startOfMonth();
        $thisMonthEnd = Carbon::now()->endOfMonth();
        $thisMonth = $this->paymentRepository->getPaymentsByPeriod($thisMonthStart, $thisMonthEnd);

        // last month payments
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
        $lastMonth = $this->paymentRepository->getPaymentsByPeriod($lastMonthStart, $lastMonthEnd);

        // variation percentage
        $thisMonthTotal = $thisMonth->sum('amount');
        $lastMonthTotal = $lastMonth->sum('amount');
        $variationAmount = $thisMonthTotal - $lastMonthTotal;
        $variationPercentage = $variationAmount / $lastMonthTotal * 100;

        return [
            'ads' => [
                'published' => $publishedAds->count(),
                'promoted' => $promotedAds->count(),
                'renewed' => $renewedAds->count(),
            ],
            'payments' => [
                'thisMonth' => $thisMonth->sum('amount'),
                'lastMonth' => $lastMonth->sum('amount'),
            ],
            'variationAmount' => $variationAmount,
            'variationPercentage' => $variationPercentage,
        ];
    }
}
