<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Contracts\LocationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LocationRepository implements LocationRepositoryInterface {
 
    /**
     * @inheritDoc
     */
    public function citiesList(): Collection {
        return City::orderBy('title')->get();
    }

    /**
     * @inheritDoc
     */
    public function findCityById($id): City {
        return City::find($id);
    }

}