<?php

namespace App\Services;

use App\Http\Requests\CreateAdvertisementRequest;
use App\Models\Advertisement;
use App\Repositories\AdvertisementRepository;

class AdvertisementService {
    
    public $advertisementRepository;

    public function __construct(AdvertisementRepository $advertisementRepository) {
        $this->advertisementRepository = $advertisementRepository;
    }

    /**
     * Create new advertisement
     *
     * @param CreateAdvertisementRequest $request
     * @return void
     */
    public function create(CreateAdvertisementRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;
        $data['expire_at'] = now()->addWeek()->format('Y-m-d H:i:s');

        $this->advertisementRepository->create($data);
    }

    public function getAllForCurrentUser()
    {
        $userId = auth()->user()->id;

        return $this->advertisementRepository->getByUser($userId);
    }

    public function getAllAdsCategorizedForCurrentUser()
    {
        $userId = auth()->user()->id;

        return collect([
            'active' => $this->advertisementRepository->getActiveAdvertisementsByUser($userId),
            'unpaid' => $this->advertisementRepository->getUnpaidAdvertisementsByUser($userId),
            'expired' => $this->advertisementRepository->getExpiredAdvertisementsByUser($userId),
        ]);
    }

}