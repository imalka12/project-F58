<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdvertisementRequest;
use App\Services\AdvertisementService;
use App\Services\CategoryService;
use App\Services\LocationService;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    private $categories;
    private $locations;
    private $advertisements;

    public function __construct(CategoryService $categoryService, LocationService $locationService, AdvertisementService $advertisementService) {
        $this->categories = $categoryService;
        $this->locations = $locationService;
        $this->advertisements = $advertisementService;
    }

    /**
     * Show the advertisement create page for clients
     *
     * @return void
     */
    public function showPostAdvertisementPage()
    {
        $categories = $this->categories->list();
        $cities = $this->locations->getCitiesForSelects();

        return view('pages.web.user.post-advertisements', compact('categories', 'cities'));
    }

    /**
     * Process create advertisement request
     *
     * @param CreateAdvertisementRequest $request
     * @return void
     */
    public function createAdvertisement(CreateAdvertisementRequest $request)
    {
        $this->advertisements->create($request);

        return redirect()->route('client.profile')->with('success', 'Advertisement created successfully.');
    }

}
