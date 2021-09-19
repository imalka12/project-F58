<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $provinces = [
            'Western' => [
                'Colombo' => [
                    'Angoda',
                    'Athurugiriya',
                    'Avissawella',
                    'Battaramulla',
                    'Boralesgamuwa',
                    'Colombo 1',
                    'Colombo 2',
                    'Colombo 3',
                    'Colombo 4',
                    'Colombo 5',
                    'Colombo 6',
                    'Colombo 7',
                    'Colombo 8',
                    'Colombo 9',
                    'Colombo 10',
                    'Colombo 11',
                    'Colombo 12',
                    'Colombo 13',
                    'Colombo 14',
                    'Colombo 15',
                    'Dehiwala',
                    'Godagama',
                    'Hanwella',
                    'Homagama',
                    'Kaduwela',
                    'Kesbewa',
                    'Kohuwala',
                    'Kolonnawa',
                    'Kottawa',
                    'Kotte',
                    'Maharagama',
                    'Malabe',
                    'Meegoda',
                    'Moratuwa',
                    'Mount Lavinia',
                    'Nawala',
                    'Nugegoda',
                    'Padukka',
                    'Pannipitiya',
                    'Piliyandala',
                    'Rajagiriya',
                    'Ratmalana',
                    'Talawatugoda',
                    'Wellampitiya',
                ],
                'Gampaha' => [
                    'Delgoda',
                    'Divulapitiya',
                    'Gampaha City',
                    'Ganemulla',
                    'Ja-Ela',
                    'Kadawatha',
                    'Kandana',
                    'Katunayake',
                    'Kelaniya',
                    'Kiribathgoda',
                    'Minuwangoda',
                    'Mirigama',
                    'Negombo',
                    'Nittambuwa',
                    'Ragama',
                    'Seeduwa',
                    'Veyangoda',
                    'Wattala',
                ],
                'Kalutara' => [
                    'Alutgama',
                    'Bandaragama',
                    'Beruwala',
                    'Horana',
                    'Ingiriya',
                    'Kalutara City',
                    'Matugama',
                    'Panadura',
                    'Wadduwa',
                ]
            ],
            'Central' => [
                'Kandy' => [
                    'Akurana',
                    'Ampitiya',
                    'Digana',
                    'Galagedara',
                    'Gampola',
                    'Gelioya',
                    'Kadugannawa',
                    'Kandy City',
                    'Katugastota',
                    'Kundasale',
                    'Madawala Bazaar',
                    'Menikhinna',
                    'Nawalapitiya',
                    'Peradeniya',
                    'Pilimatalawa',
                    'Wattegama',
                ],
                'Matale' => [
                    'Dambulla',
                    'Galewela',
                    'Matale City',
                    'Palapathwela',
                    'Pallepola',
                    'Rattota',
                    'Sigiriya',
                    'Ukuwela',
                    'Yatawatta',
                ],
                'Nuwara Eliya' => [
                    'Ginigathhena',
                    'Hatton',
                    'Madulla',
                    'Nuwara Eliya City',
                ],
            ],
            'Southern' => [
                'Galle' => [
                    'Ahangama',
                    'Ambalangoda',
                    'Baddegama',
                    'Batapola',
                    'Bentota',
                    'Elpitiya',
                    'Galle City',
                    'Hikkaduwa',
                    'Karapitiya',
                ],
                'Matara' => [
                    'Akuressa',
                    'Deniyaya',
                    'Dikwella',
                    'Gandara',
                    'Hakmana',
                    'Kamburugamuwa',
                    'Kamburupitiya',
                    'Kekanadurra',
                    'Matara City',
                    'Weligama',
                ],
                'Hambantota' => [
                    'Ambalantota',
                    'Beliatta',
                    'Hambantota City',
                    'Tangalla',
                    'Tissamaharama',
                ],
            ],
            'North Western' => [
                'Kurunegala' => [
                    'Alawwa',
                    'Bingiriya',
                    'Galgamuwa',
                    'Giriulla',
                    'Hettipola',
                    'Ibbagamuwa',
                    'Kuliyapitiya',
                    'Kurunegala City',
                    'Mawathagama',
                    'Narammala',
                    'Nikaweratiya',
                    'Pannala',
                    'Polgahawela',
                    'Wariyapola',
                ],
                'Puttalam' => [
                    'Anamaduwa',
                    'Chilaw',
                    'Dankotuwa',
                    'Marawila',
                    'Nattandiya',
                    'Puttalam City',
                    'Wennappuwa',
                ],
            ],
            'Sabaragamuwa' => [
                'Ratnapura' => [
                    'Balangoda',
                    'Eheliyagoda',
                    'Embilipitiya',
                    'Kuruwita',
                    'Pelmadulla',
                    'Ratnapura City',
                ],
                'Kegalle' => [
                    'Dehiowita',
                    'Deraniyagala',
                    'Galigamuwa',
                    'Kegalle City',
                    'Kitulgala',
                    'Mawanella',
                    'Rambukkana',
                    'Ruwanwella',
                    'Warakapola',
                    'Yatiyantota',
                ],
            ],
            'North Central' => [
                'Anuradhapura' => [
                    'Anuradhapura City',
                    'Eppawala',
                    'Galenbindunuwewa',
                    'Galnewa',
                    'Habarana',
                    'Kekirawa',
                    'Medawachchiya',
                    'Mihintale',
                    'Nochchiyagama',
                    'Talawa',
                    'Tambuttegama',
                ],
                'Polonnaruwa' => [
                    'Hingurakgoda',
                    'Kaduruwela',
                    'Medirigiriya',
                    'Polonnaruwa City',
                ],
            ],
            'Northern' => [
                'Jaffna' => [
                    'Chavakachcheri',
                    'Jaffna City',
                    'Nallur',
                ],
                'Vavuniya' => [
                    'Vavuniya City',
                ],
                'Kilinochchi' => [
                    'Kilinochchi City',
                ],
                'Mannar' => [
                    'Mannar City',
                ],
                'Mullaitivu' => [
                    'Mullativu City',
                ],
            ],
            'Uva' => [
                'Monaragala' => [
                    'Bibile',
                    'Buttala',
                    'Kataragama',
                    'Monaragala City',
                    'Wellawaya',
                ],
                'Badulla' => [
                    'Badulla City',
                    'Bandarawela',
                    'Diyatalawa',
                    'Ella',
                    'Hali Ela',
                    'Haputale',
                    'Mahiyanganaya',
                    'Passara',
                    'Welimada',
                ],
            ],
            'Eastern' => [
                'Ampara' => [
                    'Akkarepattu',
                    'Ampara City',
                    'Kalmunai',
                    'Sainthamaruthu',
                ],
                'Batticaloa' => [
                    'Batticaloa City'
                ],
                'Trincomalee' => [
                    'Kinniya',
                    'Trincomalee City',
                ],
            ],
        ];

        // iterate through the cities array
        foreach ($provinces as $provinceName => $districts) {
            // create province
            $province = Province::create([
                'title' => $provinceName,
            ]);

            // iterate through the districts of the province
            foreach ($districts as $districtName => $cities) {
                // create district
                $district = $province->districts()->create([
                    'title' => $districtName,
                ]);

                // create city
                foreach ($cities as $city) {
                    $district->cities()->create([
                        'title' => $city,
                    ]);
                }
            }
        }
    }
}
