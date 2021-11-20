<?php

namespace App\Services;

use App\Http\Requests\SubCategoryCreateRequest;
use App\Http\Requests\SubCategoryUpdateRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * List all categories
     *
     * @return Collection $catgories
     */
    public function list()
    {
        return $this->categoryRepository->all();
    }

    /**
     * Get a list of categories and sub-categories to use in an HTML select element
     *
     * @return array $categories
     */
    public function getCategoriesForSelect()
    {
        $categories = [];

        $allCategories = $this->categoryRepository->all();

        foreach ($allCategories as $category) {
            $categories[$category->id] = [
                'title' => $category->title,
                'subcategories' => [],
            ];

            foreach ($category->subCategories as $subCategory) {
                $categories[$category->id]['subcategories'][$subCategory->id] = $subCategory->title;
            }
        }

        return $categories;
    }

    public function createSubCategory(SubCategoryCreateRequest $request)
    {
        $data = $request->validated();
        $this->categoryRepository->createSubCategory($data);
    }

    public function subCategoryList()
    {
        return $this->categoryRepository->getSubCategories();
    }

    public function findSubCategory($id)
    {
        return $this->categoryRepository->getSubCategoryById($id);
    }

    public function updateSubCategory(SubCategory $subCategory, SubCategoryUpdateRequest $request)
    {
        $data = $request->validated();
        return $this->categoryRepository->updateSubCategory($subCategory, $data);
    }

    public function delete(SubCategory $subCategories)
    {
        return $this->categoryRepository->delete($subCategories);
    }

    public function getCategoriesWithAdsCount()
    {
        return $this->categoryRepository->categoriesWithAdsCount();
    }
}
