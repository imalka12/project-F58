<?php

namespace App\Repositories;

use App\Models\Advertisement;
use App\Models\AdvertisementImage;
use App\Models\AdvertisementOption;
use App\Models\Category;
use App\Models\City;
use App\Models\OptionGroup;
use App\Models\SubCategory;
use App\Repositories\Contracts\AdvertisementRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
        return Advertisement::whereNotNull('payment_id')
        ->where('user_id', $userId)
        ->where('expire_at', '>', now()->format('Y-m-d H:i:s'))
        ->with(['subCategory', 'city'])
        ->get();
    }

    /**
     * @inheritDoc
     */
    public function getUnpaidAdvertisementsByUser($userId): Collection {
        return Advertisement::whereNull('payment_id')
        ->where('user_id', $userId)
        ->with(['subCategory', 'city'])
        ->get();
    }

    /**
     * @inheritDoc
     */
    public function getExpiredAdvertisementsByUser($userId): Collection {
        return Advertisement::where('expire_at', '<', now()->format('Y-m-d H:i:s'))
        ->where('user_id', $userId)
        ->whereNotNull('payment_id')
        ->with(['subCategory', 'city'])
        ->get();
    }

    /**
     * @inheritDoc
     */
    public function getOptionGroupsForAdvertisementCategory(Advertisement $advertisement): Collection {
        return OptionGroup::with('optionGroupValues')->where('sub_category_id', $advertisement->sub_category_id)->get();
    }

    /**
     * @inheritDoc
     */
    public function createAdvertisementOptions(Advertisement $advertisement, array $advertisementOptions): iterable {
        return $advertisement->advertisementOptions()->saveMany($advertisementOptions);
    }

    /**
     * @inheritDoc
     */
    public function createAdvertisementImage(Advertisement $advertisement, array $data): AdvertisementImage {
        return $advertisement->advertisementImages()->create($data);
    }

    /**
     * @inheritDoc
     */
    public function getByCategory(Category $category): LengthAwarePaginator {
        return Advertisement::join('sub_categories', 'sub_categories.id', '=', 'advertisements.sub_category_id')
        ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
        ->select('advertisements.*')
        ->where('categories.id', $category->id)
        ->whereNotNull('advertisements.payment_id')
        ->where('expire_at', '>', now()->format('Y-m-d H:i:s'))
        ->with(['advertisementImages', 'payments'])
        ->paginate(25);
    }

    /**
     * @inheritDoc
     */
    public function getBySubCategory(SubCategory $subCategory): LengthAwarePaginator {
        return Advertisement::where('sub_category_id', $subCategory)
        ->whereNotNull('advertisements.payment_id')
        ->where('expire_at', '>', now()->format('Y-m-d H:i:s'))
        ->with(['advertisementImages', 'payments'])
        ->select('advertisements.*')
        ->paginate(25);
    }

    /**
     * Get ads by the city
     *
     * @param City $city
     * @return LengthAwarePaginator
     */
    public function getByCity(City $city): LengthAwarePaginator {
        return Advertisement::where('city_id', $city->id)
        ->whereNotNull('advertisements.payment_id')
        ->where('expire_at', '>', now()->format('Y-m-d H:i:s'))
        ->with(['advertisementImages', 'payments'])
        ->select('advertisements.*')
        ->paginate(25);
    }

    /**
     * @inheritDoc
     */
    public function getAllAdvertisements(): LengthAwarePaginator {
        return Advertisement::whereNotNull('advertisements.payment_id')
        ->where('expire_at', '>', now()->format('Y-m-d H:i:s'))
        ->with(['advertisementImages', 'payments'])
        ->select('advertisements.*')
        ->paginate(25);
    }

    /**
     * @inheritDoc
     */
    public function searchAdvertisements($category = false, $subCategory = false, $city = false, $searchWords = false, $sortKey = 'date_newest'): LengthAwarePaginator {
        $search = Advertisement::search($searchWords);
        // if($category) {
        //     $search = $search->where('category_id', $category->id);
        // }
        if($subCategory) {
            $search = $search->where('sub_category_id', $subCategory->id);
        }
        if($city) {
            $search = $search->where('city_id', $city->id);
        }

        return $search->paginate(25);
    }

    public function searchAdvertisementsEloquent($category = false, $subCategory = false, $city = false, $searchWords = false, $sortKey = 'date_newest'): LengthAwarePaginator {
        return Advertisement::join('cities', 'cities.id', '=', 'advertisements.city_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'advertisements.sub_category_id')
        ->when($searchWords, function($query, $searchWords){
            return $query->whereRaw('MATCH(advertisements.title, advertisements.description) AGAINST(? IN NATURAL LANGUAGE MODE)', $searchWords);
        })
        ->when($category, function($query, $category) {
            return $query->where('sub_categories.category_id', $category->id);
        })
        ->when($subCategory, function($query, $subCategory) {
            return $query->where('sub_categories.id', $subCategory->id);
        })
        ->when($city, function($query, $city) {
            return $query->where('cities.id', $city->id);
        })
        ->whereNotNull('advertisements.payment_id')
        ->where('expire_at', '>', now()->format('Y-m-d H:i:s'))
        ->with(['advertisementImages', 'payments'])
        ->select('advertisements.*')
        ->paginate(25);
    }

    
    /**
     * @inheritDoc
     */
    public function update(Advertisement $advertisement, array $data):bool {
        return $advertisement->update($data);
    }

    /**
     * @inheritDoc
     */
    public function updateOptions(Advertisement $advertisement , array $advertisementOptions):iterable {
        $advertisement->advertisementOptions()->delete();
        return $advertisement->advertisementOptions()->saveMany($advertisementOptions);        
    }

}
