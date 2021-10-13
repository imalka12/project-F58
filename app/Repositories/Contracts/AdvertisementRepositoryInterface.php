<?php

namespace App\Repositories\Contracts;

use App\Models\Advertisement;
use App\Models\AdvertisementImage;
use App\Models\AdvertisementOption;
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
     * @return \Illuminate\Database\Eloquent\Collection $advertisements
     */
    public function getByUser($userId): Collection;

    /**
     * Get active ads created by a user
     *
     * @param mixed $userId
     * @return \Illuminate\Database\Eloquent\Collection $activeAds
     */
    public function getActiveAdvertisementsByUser($userId): Collection;

    /**
     * Get unpaid ads created by a user
     *
     * @param [type] $userId
     * @return \Illuminate\Database\Eloquent\Collection $unpaidAds
     */
    public function getUnpaidAdvertisementsByUser($userId): Collection;

    /**
     * Get expired advertisements created by a user
     *
     * @param [type] $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getExpiredAdvertisementsByUser($userId): Collection;

    /**
     * Get option groups linked by the category of the advertisement
     *
     * @param Advertisement $advertisement
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOptionGroupsForAdvertisementCategory(Advertisement $advertisement): Collection;

    /**
     * Create advertisement options
     *
     * @param Advertisement $advertisement
     * @param array $advertisementOptions
     * @return array $created
     */
    public function createAdvertisementOptions(Advertisement $advertisement, array $advertisementOptions): iterable;

    /**
     * Create advertisement image
     *
     * @param Advertisement $advertisement
     * @param  array $data
     * @return AdvertisementImage
     */
    public function createAdvertisementImage(Advertisement $advertisement, array $data): AdvertisementImage;
}