<?php
// Administration Panel Routes

use App\Http\Controllers\ContactFormSubmissionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionGroupController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('admin', [HomeController::class, 'root'])->name('root');

# option groups
Route::get(
    'admin/option-groups',
    [OptionGroupController::class, 'showOptionGroupsPage']
)->name('admin.option-groups.add');

Route::post(
    'admin/option-groups',
    [OptionGroupController::class, 'createOptionGroup']
)->name('admin.option-groups.create');

Route::get(
    'admin/option-groups/{id}',
    [OptionGroupController::class, 'showOptionGroupEditPage']
)->name('admin.option-groups.edit');

Route::post(
    'admin/option-group/{id}',
    [OptionGroupController::class, 'updateOptionGroup']
)->name('admin.option-groups.update');

Route::post(
    'admin/option-group/delete/{optionGroup}',
    [OptionGroupController::class, 'deleteOptionGroup']
)->name('admin.option-groups.delete');

# option group values
Route::get(
    'admin/option-group-values/{optionGroupValue}',
    [OptionGroupController::class, 'editOptionGroupValue']
)->name('admin.option-groups-values.edit');

Route::post(
    'admin/option-groups/{optionGroup}/values',
    [OptionGroupController::class, 'createOptionGroupValues']
)->name('admin.option-group-values.create');

Route::post(
    'admin/option-group-values/{optionGroupValue}',
    [OptionGroupController::class, 'updateOptionGroupValue']
)->name('admin.option-groups-values.update');

Route::post(
    'admin/option-group-values/delete/{optionGroupValue}',
    [OptionGroupController::class, 'deleteOptionGroupValue']
)->name('admin.option-groups-values.delete');

//categories
Route::get(
    'admin/subcategory',
    [SubCategoryController::class, 'showSubCategoryPage']
)->name('admin.subcategory.add');

Route::post(
    'admin/subcategory',
    [SubCategoryController::class, 'createSubCategories']
)->name('admin.subcategory.create');

Route::get(
    'admin/subcategory/{id}',
    [SubCategoryController::class, 'showSubCategoryEditPage']
)->name('admin.subcategory.edit');

Route::post(
    'admin/subcategory/{id}',
    [SubCategoryController::class, 'updateSubCategories']
)->name('admin.subcategory.update');

Route::post(
    'admin/subcategory/delete/{subCategories}',
    [SubCategoryController::class, 'deleteSubCategories']
)->name('admin.subcategory.delete');

Route::get(
    'admin/contact-form-submissions',
    [ContactFormSubmissionController::class, 'index']
)->name('admin.contact-form-submissions');
