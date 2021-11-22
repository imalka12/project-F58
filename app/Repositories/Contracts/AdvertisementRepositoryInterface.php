<?php

namespace App\Repositories\Contracts;

use App\Models\Advertisement;
use App\Models\AdvertisementImage;
use App\Models\AdvertisementOption;
use App\Models\Category;
use App\Models\City;
use App\Models\SubCategory;
use Collator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface AdvertisementRepositoryInterface
{

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

    /**
     * Get ads by category
     *
     * @param Category $category; except unpaid or expired
     * @return LengthAwarePaginator
     */
    public function getByCategory(Category $category): LengthAwarePaginator;

    /**
     * Get ads by sub category; except unpaid or expired
     *
     * @param SubCategory $subCategory
     * @return LengthAwarePaginator
     */
    public function getBySubCategory(SubCategory $subCategory): LengthAwarePaginator;

    /**
     * Get ads by the city
     *
     * @param City $city
     * @return LengthAwarePaginator
     */
    public function getByCity(City $city): LengthAwarePaginator;

    /**
     * Get all advertisements; except unpaid or expired
     *
     * @return LengthAwarePaginator
     */
    public function getAllAdvertisements(): LengthAwarePaginator;

    /**
     * Perform a full-text Scout search for advertisements by given parameters
     *
     * @param Category|boolean $category
     * @param SubCategory|boolean $subCategory
     * @param City|boolean $city
     * @param string|boolean $searchWords
     * @return LengthAwarePaginator
     */
    public function searchAdvertisements(
        $category = false,
        $subCategory = false,
        $city = false,
        $searchWords = false
    ): LengthAwarePaginator;

    /**
     * Perform an Eloquent search for the Advertisements
     *
     * @param boolean $category
     * @param boolean $subCategory
     * @param boolean $city
     * @param boolean $searchWords
     * @return LengthAwarePaginator
     */
    public function searchAdvertisementsEloquent(
        $category = false,
        $subCategory = false,
        $city = false,
        $searchWords = false,
        $sortKey = 'date_newest',
        $prices = false,
        $options = false,
        $promoted = false
    ): LengthAwarePaginator;

    /**
     * Update advertisement
     *
     * @param Advertisement $advertisement
     * @param array $data
     * @return bool
     */
    public function update(Advertisement $advertisement, array $data): bool;

    /**
     * Update client created advertisement options
     *
     * @param Advertisement $advertisement
     * @param array $data
     * @return array $updated
     */
    public function updateOptions(Advertisement $advertisement, array $data): iterable;

    /**
     * Delete the given advertisement entry
     *
     * @param mixed $id
     * @return boolean
     */
    public function delete($id): bool;

    /**
     * Delete advertisement image entry
     *
     * @param string|int $id
     * @return boolean
     */
    public function deleteImage($id);

    /**
     * Delete advertisements by user
     *
     * @param int|string $user
     * @return void
     */
    public function deleteAdvertisementsByUser($user);

    /**
     * Get advertisement options for filters
     *
     * @param SubCategory $subCategory
     * @return Collection Collection
     */
    public function getOptionsForAdvertisementFilters(SubCategory $subCategory): Collection;

    /**
     * Get Promoted Advertisements for the given category and/or sub category
     * Returns only 2 advertisements selected randomly
     *
     * @param $category Category
     * @param $subCategory SubCategory
     *
     * @return $collection
     */
    public function getPromotedAdvertisements($category = false, $subCategory = false): Collection;

    /**
     * Increments total_views value by 1
     *
     * @param Advertisement $advertisement
     * @return Advertisement $advertisement
     */
    public function incrementViewCount(Advertisement $advertisement): Advertisement;
}
