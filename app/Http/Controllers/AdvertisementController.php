<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementImagesCreateRequest;
use App\Http\Requests\AdvertisementOptionValuesCreateRequest;
use App\Http\Requests\CreateAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use App\Http\Requests\UpdateOptionGroupValueRequest;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\City;
use App\Models\SubCategory;
use App\Services\AdvertisementService;
use App\Services\CategoryService;
use App\Services\LocationService;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    private $categories;
    private $locations;
    private $advertisements;

    public function __construct(CategoryService $categoryService, LocationService $locationService, AdvertisementService $advertisementService)
    {
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

        if(empty($advertisement->subCategory->optionGroups)) {
            // redirect to images page
            return redirect()->route('client.advertisement.add-images', $advertisement)
            ->with('success', 'Option values saved successfully. Please add item images.');
        }

        // has option groups for the sub category;
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
        $this->advertisements->createOptionValues($request, $advertisement);

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

    /**
     * Show ads page for the selected category
     *
     * @param Request $request
     * @param Category $category
     * @return void
     */
    public function showAdsByCategoryPage(Request $request, Category $category)
    {
        $cityId = $request->get('city');
        $selectedCity = new City();
        $selectedCity->id = 0;
        $selectedCity->title = 'Sri Lanka';
        if (!empty($cityId) && $cityId != 'all') {
            $selectedCity = $this->locations->findCityById($cityId);
        }

        $subCategoryId = $request->get('sub_category');
        $selectedSubCategory = new SubCategory();
        $selectedSubCategory->id = 0;
        $selectedSubCategory->title = 'Anything';
        if (!empty($subCategoryId) && $subCategoryId != 'all') {
            $selectedSubCategory = $this->categories->findSubCategory($subCategoryId);
            $category = $selectedSubCategory->category;
        }

        $selectedSortKey = $request->get('sort_key');
        $sortKeys = $this->getSortKeyList();

        $allSubCategories = $this->categories->getCategoriesForSelect();
        $categories = $this->categories->list();
        $cities = $this->locations->getCitiesForSelects();
        $subCategories = $category->subCategories;

        $searchStr = $request->get('search') ?? false;
        $searchSubCategory = $selectedSubCategory->id == 0 ? false : $selectedSubCategory;
        $searchCity = $selectedCity->id == 0 ? false : $selectedCity;

        $advertisementsByCategory = $this->advertisements->getAdsFiltered($category, $searchSubCategory, $searchCity, $searchStr);

        // $advertisementsByCategory = $this->advertisements->getAdsByCategory($category);

        return view('pages.web.ads.by-single-category', compact('categories', 'subCategories', 'cities', 'advertisementsByCategory', 
        'category', 'selectedCity', 'selectedSubCategory', 'searchStr', 'sortKeys', 'selectedSortKey'));
    }

    /**
     * Show all ads page
     *
     * @param Request $request
     * @return void
     */
    public function showAllAdsPage(Request $request)
    {
        $categories = $this->categories->list();
        $subCategories = $this->categories->getCategoriesForSelect();
        $cities = $this->locations->getCitiesForSelects();

        $cityId = $request->get('city');
        $selectedCity = new City();
        $selectedCity->id = 0;
        $selectedCity->title = 'Sri Lanka';
        if (!empty($cityId) && $cityId != 'all') {
            $selectedCity = $this->locations->findCityById($cityId);
        }

        $subCategoryId = $request->get('sub_category');
        $selectedSubCategory = new SubCategory();
        $selectedSubCategory->id = 0;
        $selectedSubCategory->title = 'All Categories';
        $category = false;
        if (!empty($subCategoryId) && $subCategoryId != 'all') {
            $selectedSubCategory = $this->categories->findSubCategory($subCategoryId);
            $category = $selectedSubCategory->category;
        }

        $selectedSortKey = $request->get('sort_key');
        $sortKeys = $this->getSortKeyList();

        $searchStr = $request->get('search') ?? false;
        $searchSubCategory = $selectedSubCategory->id == 0 ? false : $selectedSubCategory;
        $searchCity = $selectedCity->id == 0 ? false : $selectedCity;

        $advertisements = $this->advertisements->getAdsFiltered($category, $searchSubCategory, $searchCity, $searchStr);

        // $advertisements = $this->advertisements->getAllAds();
        return view('pages.web.ads.all', compact('categories', 'subCategories', 'cities', 'advertisements', 'selectedCity', 
        'selectedSubCategory', 'searchStr', 'sortKeys', 'selectedSortKey'));
    }

    /**
     * Show stripe payment page for the selected advertisement to promote ads
     *
     * @param Advertisement $advertisement
     * @return void
     */
    public function showPromotePage(Advertisement $advertisement)
    {
        return view('pages.web.payments.promote-pay', compact('advertisement'));
    }


    /**
     * Show stripe payment page for the selected advertisement to renew ads
     *
     * @param Advertisement $advertisement
     * @return void
     */
    public function showRenewPage(Advertisement $advertisement)
    {
        return view('pages.web.payments.renew-pay', compact('advertisement'));
    }

    /**
     * Returns an array containing the sort keys used in advertisement listing and searching
     *
     * @return array $sortKeys
     */
    private function getSortKeyList()
    {
        return [
            'date_newest' => 'Date: Newest',
            'date_oldest' => 'Date: Oldest',
            'price_high_to_low' => 'Price: High to Low',
            'price_low_to_high' => 'Price: Low to High',
        ];
    }

     /**
     * show client created advertisement to edit 
     * 
     * @param Advertisement $advertisement
     * @return void
     */
    public function showEditUnpaidAdvertisement(Advertisement $advertisement)
    {
        $categories = $this->categories->getCategoriesForSelect();
        $cities = $this->locations->getCitiesForSelects();

        return view('pages.web.user.edit-unpaid-advertisement' , compact('categories', 'cities' , 'advertisement'));
    }

    /**
     * update client edited advertisement
     * 
     * @param Advertisement $advertisement
     * @param UpdateAdvertisementRequest $updateAdvertisementRequest
     * @return void
     */
    public function saveEditUnpaidAdvertisement(Advertisement $advertisement , UpdateAdvertisementRequest $updateAdvertisementRequest)
    {
        $this->advertisements->update($advertisement , $updateAdvertisementRequest);

        return redirect()->route('advertisement.unpaid.options.edit.page' , $advertisement->id)
            ->with('success', 'Advertisement edited successfully. You can edit options from here or You can continue with same options you selected before.');   
    }

    /**
     * show client created advertisement option page to edit
     * 
     * @param Advertisement $advertisement
     * @return void
     */

    public function showEditCreatedAdvertisementOptions(Advertisement $advertisement)
    {
        $options = $this->advertisements->getAvailableOptionsForAdvertisement($advertisement);

        $advertisementOptions = $advertisement->advertisementOptions;
        
        $selectedOptions = [];
        foreach($advertisementOptions as $option) {
            $selectedOptions[$option->option_group_id] = $option->option_group_value_id;
        }

        return view('pages.web.user.edit-unpaid-advertisement-options' , compact('advertisement' , 'options', 'selectedOptions'));
    }

    /**
     * Update client edited advertisement options
     * 
     * @param Advertisement $advertisement
     * @param UpdateAdvertisementRequest $updateAdvertisementRequest
     * @return void
     */
    public function saveEditUnpaidAdvertisementOptions(Advertisement $advertisement , UpdateOptionGroupValueRequest $updateOptionGroupValueRequest)
    {
        $this->advertisements->updateOptions($advertisement , $updateOptionGroupValueRequest);

        return redirect()->route('client.profile' , $advertisement->id)
            ->with('success', 'Advertisement options edited successfully. You can edit uploaded images from here or You can continue with previous selected images.');   
    }

    public function showSingleAdView(Advertisement $advertisement)
    {
        return view('pages.web.ads.single', compact('advertisement'));
    }
}
