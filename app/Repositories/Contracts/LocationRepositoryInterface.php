<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface LocationRepositoryInterface {

    /**
     * Get a list of Cities
     *
     * @return Collection<App\Models\City> $cities - A list of cities
     */
    public function citiesList(): Collection;

}