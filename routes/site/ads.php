<?php

// categories and ads view pages

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('ads', [AdvertisementController::class, 'showAllAdsPage'])
    ->name('ads.all');

Route::get(
    'ads/{category}',
    [AdvertisementController::class, 'showAdsByCategoryPage']
)->name('ads.category.single');

Route::get(
    'ads/view-ad/{advertisement}',
    [AdvertisementController::class, 'showSingleAdView']
)->name('ads.view.single');

// Client Profile Routes
Route::middleware(['verified'])->group(function () {
    Route::get(
        'client/create-advertisement',
        [AdvertisementController::class, 'showPostAdvertisementPage']
    )->name('client.advertisement.show-create');

    Route::post(
        'client/create-advertisement',
        [AdvertisementController::class, 'createAdvertisement']
    )->name('client.advertisement.create');

    Route::get(
        'client/create-advertisement-options/{advertisement}',
        [AdvertisementController::class, 'editAdvertisementOptions']
    )->name('client.advertisement.create-options');

    Route::post(
        'client/create-advertisement-options/{advertisement}',
        [AdvertisementController::class, 'createAdvertisementOptionValues']
    )->name('client.advertisement.create-options-values');

    Route::get(
        'client/create-advertisement-images/{advertisement}',
        [AdvertisementController::class, 'editAdvertisementImages']
    )->name('client.advertisement.add-images');

    Route::post(
        'client/create-advertisement-images/{advertisement}',
        [AdvertisementController::class, 'createAdvertisementImages']
    )->name('client.advertisement.create-images');

    Route::get(
        'advertisement/{advertisement}/pay',
        [AdvertisementController::class, 'showPaymentPage']
    )->name('advertisement.pay');

    Route::post(
        'advertisement/{advertisement}/pay',
        [PaymentController::class, 'processPayment']
    )->name('payment.process');

    Route::get(
        'advertisement/{advertisement}/promote',
        [AdvertisementController::class, 'showPromotePage']
    )->name('advertisement.promote.show');

    Route::post(
        'advertisement/{advertisement}/promote',
        [PaymentController::class, 'processPromotePayment']
    )->name('advertisement.promote.process');

    Route::get(
        'advertisement/{advertisement}/renew',
        [AdvertisementController::class, 'showRenewPage']
    )->name('advertisement.renew.show');

    Route::post(
        'advertisement/{advertisement}/renew',
        [PaymentController::class, 'processRenewPayment']
    )->name('advertisement.renew.process');

    Route::get(
        'advertisement/{advertisement}/edit',
        [AdvertisementController::class, 'showEditUnpaidAdvertisement']
    )->name('advertisement.unpaid.edit.page');

    Route::post(
        'advertisement/{advertisement}/edit',
        [AdvertisementController::class, 'saveEditUnpaidAdvertisement']
    )->name('advertisement.unpaid.edit.save');

    Route::get(
        'advertisement/edit-advertisement-options/{advertisement}',
        [AdvertisementController::class, 'showEditCreatedAdvertisementOptions']
    )->name('advertisement.unpaid.options.edit.page');

    Route::post(
        'advertisement/edit-advertisement-options/{advertisement}',
        [AdvertisementController::class, 'saveEditUnpaidAdvertisementOptions']
    )->name('advertisement.unpaid.options.edit.save');

    Route::post(
        'advertisement/delete/{advertisement}',
        [AdvertisementController::class, 'deleteSelectedAdvertisement']
    )->name('selected.advertisement.delete');

    Route::get(
        'advertisement/edit-advertisement-images/{advertisement}',
        [AdvertisementController::class, 'showEditUnpaidAdImagesView']
    )->name('advertisement.unpaid.images.edit.page');

    Route::post(
        'advertisement/edit-advertisement-images/{advertisement}',
        [AdvertisementController::class, 'updateUnpaidAdImages']
    )->name('advertisement.unpaid.images.update');

    Route::post(
        'advertisement/delete-advertisement-images/{advertisementImage}',
        [AdvertisementController::class, 'deleteUnpaidAdImage']
    )->name('advertisement.unpaid.images.delete');

    Route::post(
        'report-ad/{advertisement}',
        [AdvertisementController::class, 'advertisementReport']
    )->name('advertisement.report');
});
