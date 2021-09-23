<?php

namespace App\Repositories;

use App\Models\Advertisement;
use App\Repositories\Contracts\AdvertisementRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AdvertisementRepository implements AdvertisementRepositoryInterface {

    /**
     * @inheritDoc
     */
    public function create(array $data): Advertisement {
        return Advertisement::create($data);
    }

    /**
     * @inheritDoc
     */
    public function getByUser($userId): Collection {
        return Advertisement::whereUserId($userId)->get();
    }

    /**
     * @inheritDoc
     */
    public function getActiveAdvertisementsByUser($userId): Collection {
        return Advertisement::where('is_approved', 1)
        ->where('expire_at', '>', now()->format('Y-m-d H:i:s'))
        ->with(['subCategory', 'city'])
        ->get();
    }

    /**
     * @inheritDoc
     */
    public function getUnpaidAdvertisementsByUser($userId): Collection {
        return Advertisement::where('is_approved', 0)
        ->with(['subCategory', 'city'])
        ->get();
    }

    /**
     * @inheritDoc
     */
    public function getExpiredAdvertisementsByUser($userId): Collection {
        return Advertisement::where('expire_at', '<', now()->format('Y-m-d H:i:s'))
        ->with(['subCategory', 'city'])
        ->get();
    }
}
