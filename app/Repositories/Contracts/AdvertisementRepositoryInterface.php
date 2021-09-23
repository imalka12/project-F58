<?php

namespace App\Repositories\Contracts;

use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Collection;

interface AdvertisementRepositoryInterface {
    
    /**
     * Creates new Advertisement entry
     *
     * @param array $data
     * @return Advertisement $advertisement
     */
    public function create(array $data): Advertisement;

    /**
     * Get the ads created by the user
     *
     * @param [type] $userId
     * @return Collection $advertisements
     */
    public function getByUser($userId): Collection;

    /**
     * Get active ads created by a user
     *
     * @param mixed $userId
     * @return Collection $activeAds
     */
    public function getActiveAdvertisementsByUser($userId): Collection;

    /**
     * Get unpaid ads created by a user
     *
     * @param [type] $userId
     * @return Collection $unpaidAds
     */
    public function getUnpaidAdvertisementsByUser($userId): Collection;

    /**
     * Get expired advertisements created by a user
     *
     * @param [type] $userId
     * @return Collection
     */
    public function getExpiredAdvertisementsByUser($userId): Collection;
}