<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\City;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\SubCategory;
use App\Models\User;
use Database\Factories\AdvertisementsFactory;
use Illuminate\Database\Seeder;

class AdvertisementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Profile::first()->user;
        $subCategories = SubCategory::all(['id', 'title']);
        $cities = City::all('id', 'title');

        foreach ($subCategories as $subCategory) {
            foreach ($cities as $city) {
                $this->unpaid($subCategory, $city, $user);
            }
        }
    }


    public function unpaid(SubCategory $subCategory, City $city, User $user)
    {
        Advertisement::factory()->count(2)
        ->for($city)
        ->for($subCategory)
        ->for($user)
        ->unpaid()
        ->create();
    }

    public function paid(SubCategory $subCategory, City $city, User $user)
    {
        Advertisement::factory()->count(2)
        ->forCity([
            'city_id' => $city->id
        ])
        ->forSubCategory([
            'sub_category_id' => $subCategory->id,
        ])
        ->forUser([
            'user_id' => $user->id,
        ])
        ->hasPayments(1)
        ->create();
    }

    public function expiry(SubCategory $subCategory, City $city)
    {
        # code...
    }
}
