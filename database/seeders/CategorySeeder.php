<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Electronics' => [
                'icon' => 'smart_phone.png',
                'subs' => [
                    'Mobile Phones',
                    'Computer Accessories',
                    'Mobile Phone Accessories',
                    'Computers & Tablets',
                    'Air Conditions & Electrical fittings',
                    'Audio & MP3',
                    'Electronic Home Appliances',
                    'Other Electronics',
                    'Cameras & Camcorders',
                    'Video Games & Consoles',
                    'TVs',
                    'TV & Video Accessories',
                ]
            ],

            'Vehicles' => [
                'icon' => 'car.png',
                'subs' => [
                    'Auto Parts & Accessories',
                    'Motorbikes',
                    'Cars',
                    'Three Wheelers',
                    'Auto Services',
                    'Rentals',
                    'Lorries & Trucks',
                    'Bicycles',
                    'Vans',
                    'Heavy Duty',
                    'Tractors',
                    'Buses',
                    'Boats & Water Transport',
                ],
            ],

            'Property' => [
                'icon' => 'house.png',
                'subs' => [
                    'Land',
                    'Houses For Sale',
                    'House Rentals',
                    'Apartment Rentals',
                    'Apartments For Sale',
                    'Room & Annex Rentals',
                    'Commercial Property Rentals',
                    'Commercial Properties For Sale',
                    'Holiday & Short-Term Rental',
                    'New Developments',
                    'Apartments',
                ],
            ],

            'Home & Garden' => [
                'icon' => 'microwave.png',
                'subs' => [
                    'Furniture',
                    'Kitchen items',
                    'Other Home Items',
                    'Building Material & Tools',
                    'Garden',
                    'Home Decor',
                    'Bathroom & Sanitary ware',
                ],
            ],

            'Animals' => [
                'icon' => 'animals.png',
                'subs' => [
                    'Pets',
                    'Farm Animals',
                    'Animal Accessories',
                    'Veterinary Services',
                    'Pet Food',
                    'Other Animals',
                ],
            ],

            'Business & Industry' => [
                'icon' => 'industrial.png',
                'subs' => [
                    'Industry Tools & Machinery',
                    'Office Equipment, Supplies & Stationery',
                    'Solar & Generators',
                    'Other Business Services',
                    'Raw Materials & Wholesale Lots',
                    'Healthcare, Medical Equipment & Supplies',
                    'Licences & Titles',
                ],
            ],

            'Services' => [
                'icon' => 'concrete_mixer.png',
                'subs' => [
                    'Trade Services',
                    'Domestic Services',
                    'Other Services',
                    'Events & Entertainment',
                    'Health & Wellbeing',
                    'Travel & Tourism',
                ],
            ],

            'Hobby, Sport & Kids' => [
                'icon' => 'football.png',
                'subs' => [
                    'Musical Instruments',
                    'Sports & Fitness',
                    'Art & Collectibles',
                    'Children\'s Items',
                    'Other Hobby, Sport & Kids Items',
                    'Music, Books & Movies',
                    'Sports Supplements',
                    'Travel, Events & Tickets',
                ],
            ],

            'Fashion & Beauty' => [
                'icon' => 'wristwatch.png',
                'subs' => [
                    'Beauty Products',
                    'Clothing',
                    'Watches',
                    'Jewellery',
                    'Shoes & Footwear',
                    'Bags & Luggage',
                    'Sunglasses & Opticians',
                    'Other Fashion Accessories',
                    'Other Personal Items',
                ],
            ],

            'Essentials' => [
                'icon' => 'essentials.png',
                'subs' => [
                    'Healthcare',
                    'Grocery',
                    'Fruits & Vegetables',
                    'Household',
                    'Baby Products',
                    'Other Essentials',
                    'Meat & Seafood',
                    'Gas',
                ],
            ],

            'Education' => [
                'icon' => 'education.png',
                'subs' => [
                    'Tuition',
                    'Other Education',
                    'Textbooks',
                    'Vocational Institutes',
                    'Higher Education',
                ],
            ],

            'Agriculture' => [
                'icon' => 'agriculture.png',
                'subs' => [
                    'Crops, Seeds & Plants',
                    'Other Agriculture',
                    'Farming Tools & Machinery',
                ],
            ],

            'Other' => [
                'icon' => 'other.png',
                'subs' => [
                    'Other',
                ],
            ],
        ];

        // iterate through each category
        foreach ($categories as $categoryName => $categoryData) {
            // create category
            $category = Category::create([
                'title' => $categoryName,
                'icon' => $categoryData['icon'],
            ]);

            // create sub categories for the category
            foreach ($categoryData['subs'] as $subCategoryName) {
                $category->subCategories()->create([
                    'title' => $subCategoryName,
                ]);
            }
        }
    }
}
