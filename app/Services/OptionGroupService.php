<?php

namespace App\Services;

use App\Http\Requests\OptionGroupCreateRequest;
use App\Http\Requests\OptionGroupUpdateRequest;
use App\Http\Requests\OptionGroupValueCreateRequest;
use App\Http\Requests\OptionGroupValueUpdateRequest;
use App\Models\OptionGroup;
use App\Models\OptionGroupValue;
use App\Repositories\OptionGroupRepository;

class OptionGroupService {

    private $optionGroupRepository;

    public function __construct(OptionGroupRepository $optionGroupRepository) {
        $this->optionGroupRepository = $optionGroupRepository;
    }

    public function create(OptionGroupCreateRequest $request)
    {
        $data = $request->validated();
        $this->optionGroupRepository->create($data);
    }

    public function list()
    {
        return $this->optionGroupRepository->getAll();
    }

    public function find($id)
    {
        return $this->optionGroupRepository->getById($id);
    }

    public function update(OptionGroup $optionGroup, OptionGroupUpdateRequest $request)
    {
        $data = $request->validated();
        return $this->optionGroupRepository->update($optionGroup, $data);
    }

    public function delete(OptionGroup $optionGroup)
    {
        return $this->optionGroupRepository->delete($optionGroup);
    }

    public function createValue(OptionGroup $optionGroup, OptionGroupValueCreateRequest $request)
    {
        $data = $request->validated();
        return $optionGroup->optionGroupValues()->create($data);
    }

    public function getValuesForOptionGroup(OptionGroup $optionGroup)
    {
        return $optionGroup->optionGroupValues;
    }

    public function findOptionGroupValue($id)
    {
        return $this->optionGroupRepository->getValueById($id);
    }

    public function updateValue(OptionGroupValue $optionGroupValue, OptionGroupValueUpdateRequest $updateRequest)
    {
        return $this->optionGroupRepository->updateValue($optionGroupValue, $updateRequest->validated());
    }

    public function deleteValue(OptionGroupValue $optionGroupValue)
    {
        return $this->optionGroupRepository->deleteValue($optionGroupValue);
    }

}
