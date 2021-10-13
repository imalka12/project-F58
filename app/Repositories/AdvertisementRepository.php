<?php

namespace App\Repositories;

use App\Models\Advertisement;
use App\Models\AdvertisementImage;
use App\Models\AdvertisementOption;
use App\Models\OptionGroup;
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

}
