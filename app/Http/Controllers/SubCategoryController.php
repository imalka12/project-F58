<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryCreateRequest;
use App\Http\Requests\SubCategoryUpdateRequest;
use App\Http\Requests\SubCategoryValueCreateRequest;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\OptionGroupService;

class SubCategoryController extends Controller
{
    private $categories;
    private $optionGroups;

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService, OptionGroupService $optionGroupService)
    {
        $this->middleware('auth');
        $this->categories = $categoryService;
        $this->optionGroups = $optionGroupService;
    }

    /**
     * Show sub category create page
     */
    public function showSubCategoryPage()
    {
        $categories = $this->categories->list();
        $subCategories = $this->categories->subCategoryList();
        return view('pages.admin.sub-categories.sub-categories-add', compact('categories', 'subCategories'));
    }

    /**
     * Create new sub category
     * @param SubCategoryCreateRequest $request
     */
    public function createSubCategories(SubCategoryCreateRequest $request)
    {
        $this->categories->createSubCategory($request);

        return redirect()->route('admin.subcategory.add')->with('success' , 'Category created successfully.');
    }

    /**
     * Show sub category edit page
     * 
     * @param string|int $id Sub category id
     */
    public function showSubCategoryEditPage($id)
    {
        $categories = $this->categories->getCategoriesForSelect();
        $subCategory = $this->categories->findSubCategory($id);
        return view('pages.admin.sub-categories.sub-categories-edit' , compact('categories' , 'subCategory'));
    }

    /**
     * Update sub category
     * 
     * @param SubCategoryUpdateRequest $request
     * @param SubCategory $id
     */
    public function updateSubCategories(SubCategoryUpdateRequest $request, SubCategory $id)
    {
        $this->categories->updateSubCategory($id , $request);
        return redirect()->route('admin.subcategory.edit', $id)->with('success', 'Sub category updated successfully.');
    }

}
