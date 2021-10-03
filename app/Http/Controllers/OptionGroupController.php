<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionGroupCreateRequest;
use App\Http\Requests\OptionGroupUpdateRequest;
use App\Http\Requests\OptionGroupValueCreateRequest;
use App\Models\OptionGroup;
use App\Services\CategoryService;
use App\Services\OptionGroupService;
use Illuminate\Http\Request;

class OptionGroupController extends Controller
{
    private $categories;
    private $optionGroups;

    public function __construct(CategoryService $categoryService, OptionGroupService $optionGroupService)
    {
        $this->middleware('auth');
        $this->categories = $categoryService;
        $this->optionGroups = $optionGroupService;
    }

    public function showOptionGroupsPage()
    {
        $categories = $this->categories->getCategoriesForSelect();
        $optionGroups = $this->optionGroups->list();

        return view('pages.admin.option-groups-create', compact('categories', 'optionGroups'));
    }

    public function createOptionGroup(OptionGroupCreateRequest $request)
    {
        $this->optionGroups->create($request);

        return redirect()->route('admin.option-groups.add')->with('success', 'Option group created successfully.');
    }

    public function showOptionGroupEditPage(Request $request, $id)
    {
        $categories = $this->categories->getCategoriesForSelect();
        $optionGroup = $this->optionGroups->find($id);
        return view('pages.admin.option-groups-edit', compact('categories', 'optionGroup'));
    }

    public function updateOptionGroup(OptionGroupUpdateRequest $request, OptionGroup $id)
    {
        $this->optionGroups->update($id, $request);

        return redirect()->route('admin.option-groups.edit', $id)->with('success', 'Option group updated successfully.');
    }

    public function createOptionGroupValues(OptionGroup $optionGroup, OptionGroupValueCreateRequest $request)
    {
        $this->optionGroups->createValue($optionGroup, $request);
        return redirect()->route('admin.option-groups.edit', $optionGroup->id)->with('success', 'Option group value added successfully.');
    }
}
