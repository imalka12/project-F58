<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\SubCategory;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface {

    /**
     * @inheritDoc
     */
    public function all(): Collection {
        return Category::with('subCategories')->orderBy('title')->get();
    }

    public function createSubCategory(array $data): SubCategory {
        return SubCategory::create($data);
    }

    public function getSubCategories(): Collection
    {
        return SubCategory::with('category')->orderBy('title')->get();
    }
}