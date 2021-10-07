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

    /**
     * Get OptionGroup by id
     * @param string|int $id
     * 
     * @return OptionGroup $optionGroup
     */
    public function getById($id): OptionGroup;

    /**
     * Update OptionGroup
     *
     * @param [type] OptionGroup $optionGroup
     * @param array $data Update data
     * @return bool $updated
     */
    public function update(OptionGroup $optionGroup, array $data): bool;

}