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
        return Category::with('subCategories', 'subCategories.advertisements')->orderBy('title')->get();
    }

    /**
     * @inheritDoc
     */
    public function createSubCategory(array $data): SubCategory {
        return SubCategory::create($data);
    }

    /**
     * @inheritDoc
     */
    public function getSubCategories(): Collection
    {
        return SubCategory::with('category')->orderBy('title')->get();
    }

    /**
     * @inheritDoc
     */
    public function getSubCategoryById($id): SubCategory
    {
        return SubCategory::find($id);
    }

    /**
     * @inheritDoc
     */
    public function updateSubCategory(SubCategory $subCategory , array $data): bool
    {
        return $subCategory->update($data);
    }

    /**
     * @inheritDoc
     */
    public function delete(SubCategory $subCategories): bool
    {
        return $subCategories->delete();
    }

    public function categoriesWithAdsCount(): Collection {
        return Category::selectRaw('
        (
            SELECT COUNT(advertisements.id) FROM advertisements 
            INNER JOIN sub_categories ON sub_categories.category_id = categories.id 
            WHERE advertisements.sub_category_id = sub_categories.id and advertisements.is_approved = true
        ) AS ads_count,
        categories. *')->orderBy('categories.title')->get();
    }
}
