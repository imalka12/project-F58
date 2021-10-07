<?php

namespace App\Repositories\Contracts;

use App\Models\OptionGroup;
use App\Models\OptionGroupValue;
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

    /**
     * Delete OptionGroup
     *
     * @param OptionGroup $optionGroup
     * @return bool $deleted
     */
    public function delete(OptionGroup $optionGroup): bool;

    /**
     * Find Option Group Value by id
     *
     * @param string|int $id
     * @return OptionGroupValue
     */
    public function getValueById($id): OptionGroupValue;

    /**
     * Update Option Group Value
     *
     * @param OptionGroupValue $optionGroupValue
     * @param array $data
     * @return boolean
     */
    public function updateValue(OptionGroupValue $optionGroupValue, array $data): bool;

    /**
     * Delete Option Group Value
     *
     * @param OptionGroupValue $optionGroupValue
     * @return boolean
     */
    public function deleteValue(OptionGroupValue $optionGroupValue): bool;

}