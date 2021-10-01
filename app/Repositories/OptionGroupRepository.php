<?php

namespace App\Repositories;

use App\Models\OptionGroup;
use App\Repositories\Contracts\OptionGroupRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OptionGroupRepository implements OptionGroupRepositoryInterface {
    
    /**
     * @inheritDoc
     */
    public function create(array $data): OptionGroup {
        return OptionGroup::create($data);
    }

    public function getAll(): Collection
    {
        return OptionGroup::with('subCategory')
        ->orderBy('title', 'asc')
        ->get();
    }
}