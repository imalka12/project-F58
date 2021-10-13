<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementImagesCreateRequest;
use App\Http\Requests\AdvertisementOptionValuesCreateRequest;
use App\Http\Requests\CreateAdvertisementRequest;
use App\Models\Advertisement;
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
        $categories = $this->categories->getCategoriesForSelect();
        // dd($categories);

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
        $advertisement = $this->advertisements->create($request);

        return redirect()->route('client.advertisement.create-options', $advertisement->id)
        ->with('success', 'Advertisement created successfully. Please add more details about your item.');
    }

    public function editAdvertisementOptions(Advertisement $advertisement)
    {
        $options = $this->advertisements->getAvailableOptionsForAdvertisement($advertisement);

        return view('pages.web.user.post-advertisements-options', compact('advertisement', 'options'));
    }

    public function createAdvertisementOptionValues(AdvertisementOptionValuesCreateRequest $request, Advertisement $advertisement)
    {
        $this->advertisements->createOptionValues($request,$advertisement);

        return redirect()->route('client.advertisement.add-images', $advertisement)
        ->with('success', 'Option values saved successfully. Please add item images.');
    }

    public function editAdvertisementImages(Advertisement $advertisement)
    {
        return view('pages.web.user.post-advertisements-images', compact('advertisement'));
    }

    public function createAdvertisementImages(AdvertisementImagesCreateRequest $request, Advertisement $advertisement)
    {
        $this->advertisements->createAdvertisementImages($request, $advertisement);

        return redirect()->route('client.profile')->with('success', 'Advertisement created successfully.');
    }

    /**
     * Show PayPal payment page for the selected advertisement
     *
     * @param Advertisement $advertisement
     * @return void
     */
    public function showPaymentPage(Advertisement $advertisement)
    {
        return view('pages.web.payments.payment-pay', compact('advertisement'));
    }

}
