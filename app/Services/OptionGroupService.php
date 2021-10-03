<?php

namespace App\Services;

use App\Http\Requests\OptionGroupCreateRequest;
use App\Http\Requests\OptionGroupUpdateRequest;
use App\Http\Requests\OptionGroupValueCreateRequest;
use App\Models\OptionGroup;
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

    public function createValue(OptionGroup $optionGroup, OptionGroupValueCreateRequest $request)
    {
        $data = $request->validated();
        $optionGroup->optionGroupValues()->create($data);
    }

}