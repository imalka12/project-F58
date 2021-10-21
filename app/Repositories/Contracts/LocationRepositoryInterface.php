<?php

namespace App\Repositories\Contracts;

use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

interface LocationRepositoryInterface {

    /**
     * Get a list of Cities
     *
     * @return Collection<App\Models\City> $cities - A list of cities
     */
    public function citiesList(): Collection;

    /**
     * Find the City for the given ID
     *
     * @param string|int $id
     * @return City
     */
    public function findCityById($id): City;

}