<?php

namespace App\Services;

use App\Http\Requests\AdvertisementImagesCreateRequest;
use App\Http\Requests\AdvertisementOptionValuesCreateRequest;
use App\Http\Requests\CreateAdvertisementRequest;
use App\Models\Advertisement;
use App\Models\AdvertisementOption;
use App\Models\Category;
use App\Models\City;
use App\Models\SubCategory;
use App\Repositories\AdvertisementRepository;
use App\Repositories\OptionGroupRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdvertisementService {
    
    public $advertisementRepository;
    public $optionGroupRepository;

    public function __construct(AdvertisementRepository $advertisementRepository, OptionGroupRepository $optionGroupRepository) {
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
        $optionGroupValues = $request->post('option_groups');

        $adOptions = [];

        foreach ($optionGroupValues as $optionGroupId => $optionGroupValueId) {
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
        return $this->advertisementRepository->searchAdvertisementsEloquent($category, $subCategory, $city, $search);
        // return $this->advertisementRepository->searchAdvertisements($category, $subCategory, $city, $search);
    }

}