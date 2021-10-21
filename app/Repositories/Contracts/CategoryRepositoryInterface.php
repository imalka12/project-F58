<?php

namespace App\Repositories\Contracts;

use App\Models\Category;
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

    /**
     * get subcategory by id
     * @param string|int $id
     * @return SubCategory $subCategory
     */
    public function  getSubCategoryById($id): SubCategory;
    
    /**
     * update subcategory
     * 
     * @param SubCategory $id Category Id
     * @param array $data update data
     * @return bool updated
     */
    public function updateSubCategory(SubCategory $subCategory , array $data): bool;

    /**
     * delete SubCategories
     * 
     * @param SubCategory $subCategories
     * @return bool $deleted
     */
    public function delete(SubCategory $subCategories): bool;
}