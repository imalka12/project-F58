<?php

namespace App\Repositories\Contracts;

use App\Models\OptionGroup;
use Illuminate\Database\Eloquent\Collection;

interface OptionGroupRepositoryInterface {

    /**
     * Create new OptionGroup
     *
     * @param array $data
     * @return OptionGroup $optionGroup
     */
    public function create(array $data): OptionGroup;

    /**
     * Get all OptionGroups
     *
     * @return Collection $optionGroups
     */
    public function getAll(): Collection;

}