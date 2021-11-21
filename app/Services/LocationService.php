<?php

namespace App\Services;

use App\Repositories\LocationRepository;
use Illuminate\Database\Eloquent\Collection;

class LocationService
{

    public $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    /**
     * Get a list of City entries
     *
     * @return Collection $cities
     */
    public function cities(): Collection
    {
        return $this->locationRepository->citiesList();
    }

    /**
     * Returns an array with the structure for an HTML select element.
     * Has cities grouped by their districts
     *
     * @return array $cities
     */
    public function getCitiesForSelects(): array
    {
        $cities = $this->cities();

        $list = [];

        foreach ($cities as $city) {
            if (!array_key_exists($city->district->title, $list)) {
                $list[$city->district->title] = [];
            }

            $list[$city->district->title][] = $city;
        }

        return $list;
    }

    public function findCityById($id)
    {
        return $this->locationRepository->findCityById($id);
    }
}
