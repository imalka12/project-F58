<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryCreateRequest;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\OptionGroupService;

class SubCategoryController extends Controller
{
    private $categories;
    private $optionGroups;
    private $subcategoriries;

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

    public function showSubCategoryPage()
    {
        $categories = $this->categories->list();
        $subCategories = $this->categories->subCategoryList();
        return view('pages.admin.sub-categories-add', compact('categories', 'subCategories'));
    }

    public function createSubCategories(SubCategoryCreateRequest $request)
    {
        $this->categories->createSubCategory($request);

        return redirect()->route('admin.subcategory.add')->with('success' , 'Category created successfully.');
    }

    public function showSubCategoryEditPage(Request $request , $id)
    {
        
    }

}
