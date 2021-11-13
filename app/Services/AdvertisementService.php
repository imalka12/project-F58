<?php

namespace App\Services;

use App\Http\Requests\AdvertisementImagesCreateRequest;
use App\Http\Requests\AdvertisementOptionValuesCreateRequest;
use App\Http\Requests\CreateAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use App\Http\Requests\UpdateOptionGroupValueRequest;
use App\Models\Advertisement;
use App\Models\AdvertisementImage;
use App\Models\AdvertisementOption;
use App\Models\Category;
use App\Models\City;
use App\Models\SubCategory;
use App\Repositories\AdvertisementRepository;
use App\Repositories\OptionGroupRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class AdvertisementService
{

    public $advertisementRepository;
    public $optionGroupRepository;

    public function __construct(
        AdvertisementRepository $advertisementRepository,
        OptionGroupRepository $optionGroupRepository
    ) {
        $this->advertisementRepository = $advertisementRepository;
        $this->optionGroupRepository = $optionGroupRepository;
    }

    /**
     * Create new advertisement
     *
     * @param CreateAdvertisementRequest $request
     * @return Advertisement
     */
    public function create(CreateAdvertisementRequest $request): Advertisement
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;
        $data['expire_at'] = null;

        return $this->advertisementRepository->create($data);
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

    public function getAvailableOptionsForAdvertisement(Advertisement $advertisement)
    {
        return $this->advertisementRepository->getOptionGroupsForAdvertisementCategory($advertisement);
    }

    public function createOptionValues(AdvertisementOptionValuesCreateRequest $request, Advertisement $advertisement)
    {
        $optionGroupValues = $request->validated();

        if (empty($optionGroupValues)) {
            return false;
        }

        $adOptions = [];

        foreach ($optionGroupValues['option_groups'] as $optionGroupId => $optionGroupValueId) {
            $adOption = new AdvertisementOption;
            $adOption->option_group_id = $optionGroupId;
            $adOption->option_group_value_id = $optionGroupValueId;
            $adOptions[] = $adOption;
        }

        return $this->advertisementRepository->createAdvertisementOptions($advertisement, $adOptions);
    }

    public function createAdvertisementImages(AdvertisementImagesCreateRequest $request, Advertisement $advertisement)
    {
        foreach ($request->files as $fileName => $file) {
            $image_path = $request->file($fileName)->store('public/advs-images');
            $this->advertisementRepository->createAdvertisementImage($advertisement, [
                'image' => basename($image_path),
            ]);
        }
    }

    /**
     * Get advertisements matching the selected category
     *
     * @param Category $category
     * @return LengthAwarePaginator
     */
    public function getAdsByCategory(Category $category)
    {
        return $this->advertisementRepository->getByCategory($category);
    }

    /**
     * Get all ads
     *
     * @return LengthAwarePaginator
     */
    public function getAllAds()
    {
        return $this->advertisementRepository->getAllAdvertisements();
    }

    /**
     * Get advertisements matching the selected city
     *
     * @param City $city
     * @return LengthAwarePaginator
     */
    public function getAdsByCity(City $city)
    {
        return $this->advertisementRepository->getByCity($city);
    }

    public function getAdsFiltered($category = 'all', $subCategory = 'all', $city = 'all', $search = '', $sortKey = 'date_newest')
    {
        return $this->advertisementRepository->searchAdvertisementsEloquent($category, $subCategory, $city, $search, $sortKey);
    }

    public function update(Advertisement $advertisement, UpdateAdvertisementRequest $updateAdvertisementRequest)
    {
        $data = $updateAdvertisementRequest->validated();
        return $this->advertisementRepository->update($advertisement, $data);
    }

    /**
     * Update advertisement options
     *
     * @param Advertisement $advertisement
     * @param UpdateOptionGroupValueRequest $updateOptionGroupValueRequest
     * @return iterable
     */
    public function updateOptions(
        Advertisement $advertisement,
        UpdateOptionGroupValueRequest $updateOptionGroupValueRequest
    ): iterable {
        $optionGroupValues = $updateOptionGroupValueRequest->validated();

        $adOptions = [];

        foreach ($optionGroupValues['option_groups'] as $optionGroupId => $optionGroupValueId) {
            $adOption = new AdvertisementOption;
            $adOption->option_group_id = $optionGroupId;
            $adOption->option_group_value_id = $optionGroupValueId;
            $adOptions[] = $adOption;
        }

        return $this->advertisementRepository->updateOptions($advertisement, $adOptions);
    }

    /**
     * Delete the advertisement
     *
     * @param Advertisement $advertisement
     * @return mixed
     */
    public function delete(Advertisement $advertisement)
    {
        if (! $advertisement) {
            return false;
        }

        return $this->advertisementRepository->delete($advertisement->id);
    }

    public function deleteAdvertisementImage(AdvertisementImage $advertisementImage)
    {
        if (! Storage::exists('public/advs-images/' . $advertisementImage->image)) {
            return false;
        }

        $deleted = Storage::delete('public/advs-images/' . $advertisementImage->image);
        if (! $deleted) {
            return false;
        }

        return $this->advertisementRepository->deleteImage($advertisementImage->id);
    }
}
