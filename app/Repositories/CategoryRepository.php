<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface {

    /**
     * @inheritDoc
     */
    public function all(): Collection {
        return Category::orderBy('title')->get();
    }
}