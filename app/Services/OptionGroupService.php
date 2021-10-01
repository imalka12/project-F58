<?php

namespace App\Services;

use App\Http\Requests\OptionGroupCreateRequest;
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

}