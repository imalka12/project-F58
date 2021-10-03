<?php

namespace App\Repositories\Contracts;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface {

    /**
     * Returns a collection of categories from the database
     *
     * @return Collection<App\Models\Category> $categories
     */
    public function all(): Collection;

    /**
     * Create new SubCategory
     * @param array $data
     * @return SubCategory $subCategory
     */
    public function createSubCategory(array $data): SubCategory;

    /**
     * Returns a collection of subCategories
     * 
     * @return Collection $subCategories
     */
    public function getSubCategories(): Collection;

}