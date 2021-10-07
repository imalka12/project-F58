<?php

namespace App\Repositories;

use App\Models\OptionGroup;
use App\Models\OptionGroupValue;
use App\Repositories\Contracts\OptionGroupRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OptionGroupRepository implements OptionGroupRepositoryInterface {
    
    /**
     * @inheritDoc
     */
    public function create(array $data): OptionGroup {
        return OptionGroup::create($data);
    }

    /**
     * @inheritDoc
     */
    public function getAll(): Collection
    {
        return OptionGroup::with('subCategory')
        ->orderBy('title', 'asc')
        ->get();
    }
    
    /**
     * @inheritDoc
     */
    public function getById($id): OptionGroup {
        return OptionGroup::find($id);
    }

    /**
     * @inheritDoc
     */
    public function update(OptionGroup $optionGroup, array $data): bool
    {
        return $optionGroup->update($data);
    }

    /**
     * Delete Option Group
     *
     * @param OptionGroup $optionGroup
     * @return boolean
     */
    public function delete(OptionGroup $optionGroup): bool {
        return $optionGroup->delete();
    }

    /**
     * @inheritDoc
     */
    public function getValueById($id): OptionGroupValue {
        return OptionGroupValue::find($id);
    }

    /**
     * @inheritDoc
     */
    public function updateValue(OptionGroupValue $optionGroupValue, array $data): bool {
        return $optionGroupValue->update($data);
    }

    /**
     * @inheritDoc
     */
    public function deleteValue(OptionGroupValue $optionGroupValue): bool {
        return $optionGroupValue->delete();
    }

}