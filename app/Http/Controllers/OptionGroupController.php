<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionGroupCreateRequest;
use App\Http\Requests\OptionGroupUpdateRequest;
use App\Http\Requests\OptionGroupValueCreateRequest;
use App\Http\Requests\OptionGroupValueUpdateRequest;
use App\Models\OptionGroup;
use App\Models\OptionGroupValue;
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

    /**
     * Show OptionGroups create and listing page
     *
     * @return void
     */
    public function showOptionGroupsPage()
    {
        $categories = $this->categories->getCategoriesForSelect();
        $optionGroups = $this->optionGroups->list();

        return view('pages.admin.option-groups.option-groups-create', compact('categories', 'optionGroups'));
    }

    /**
     * Create new OptionGroup
     *
     * @param OptionGroupCreateRequest $request
     * @return void
     */
    public function createOptionGroup(OptionGroupCreateRequest $request)
    {
        $this->optionGroups->create($request);

        return redirect()->route('admin.option-groups.add')
            ->with('success', 'Option group created successfully.');
    }

    /**
     * Show OptionGroups edit page
     *
     * @param Request $request
     * @param int|string $id
     * @return void
     */
    public function showOptionGroupEditPage(Request $request, $id)
    {
        $categories = $this->categories->getCategoriesForSelect();
        $optionGroup = $this->optionGroups->find($id);
        $optionGroupValues = $this->optionGroups->getValuesForOptionGroup($optionGroup);

        return view(
            'pages.admin.option-groups.option-groups-edit',
            compact('categories', 'optionGroup', 'optionGroupValues')
        );
    }

    /**
     * Update OptionGroup
     *
     * @param OptionGroupUpdateRequest $request
     * @param OptionGroup $id
     * @return void
     */
    public function updateOptionGroup(OptionGroupUpdateRequest $request, OptionGroup $id)
    {
        $this->optionGroups->update($id, $request);

        return redirect()->route('admin.option-groups.edit', $id)
            ->with('success', 'Option group updated successfully.');
    }

    /**
     * delete Option Group
     *
     * @param OptionGroup $optionGroup
     * @return void
     */
    public function deleteOptionGroup(OptionGroup $optionGroup)
    {
        $this->optionGroups->delete($optionGroup);
        return redirect()->route('admin.option-groups.add')
            ->with('success', 'Option group deleted successfully.');
    }

    /**
     * Create new OptionGroupValue for OptionGroup
     *
     * @param OptionGroup $optionGroup
     * @param OptionGroupValueCreateRequest $request
     * @return void
     */
    public function createOptionGroupValues(OptionGroup $optionGroup, OptionGroupValueCreateRequest $request)
    {
        $this->optionGroups->createValue($optionGroup, $request);

        return redirect()->route('admin.option-groups.edit', $optionGroup->id)
            ->with('success', 'Option group value added successfully.');
    }

    /**
     * Edit Option Group Value
     *
     * @param OptionGroupValue $optionGroupValue
     * @return void
     */
    public function editOptionGroupValue(OptionGroupValue $optionGroupValue)
    {
        $optionGroup = $optionGroupValue->optionGroup;
        $categories = $this->categories->getCategoriesForSelect();
        $optionGroupValues = $this->optionGroups->getValuesForOptionGroup($optionGroup);

        return view(
            'pages.admin.option-groups.option-group-values-edit',
            compact(
                'optionGroup',
                'categories',
                'optionGroupValues',
                'optionGroupValue'
            )
        );
    }

    /**
     * Update Option Group Value
     *
     * @param OptionGroupValueUpdateRequest $request
     * @param OptionGroupValue $optionGroupValue
     * @return void
     */
    public function updateOptionGroupValue(OptionGroupValueUpdateRequest $request, OptionGroupValue $optionGroupValue)
    {
        $this->optionGroups->updateValue($optionGroupValue, $request);
        return redirect()->route('admin.option-groups.edit', $optionGroupValue->optionGroup->id)
            ->with('success', 'Option group value updated successfully.');
    }

    /**
     * Delete Option Group Value
     *
     * @param OptionGroupValue $optionGroupValue
     * @return void
     */
    public function deleteOptionGroupValue(OptionGroupValue $optionGroupValue)
    {
        $this->optionGroups->deleteValue($optionGroupValue);
        return redirect()->route('admin.option-groups.edit', $optionGroupValue->optionGroup->id)
            ->with('success', 'Option group value deleted successfully.');
    }
}
