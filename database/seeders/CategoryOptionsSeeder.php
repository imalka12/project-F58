<?php

namespace Database\Seeders;

use App\Models\CategoryOption;
use Illuminate\Database\Seeder;

class CategoryOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Mobile Device Brand' => [
                'Nokia',
                'XIAOMI',
                'Samsung',
                'Huawei',
                'Apple',
                'LG',
                'Motorola',
                'Oppo',
                'Pocofone',
                'Ulefone',
                'Microsoft',
                'Toshiba',
                'Fujitsu',
                'Acer',
                'Asus',
                'Other',
            ],
            'Mobile Device Screen Type' => [
                'IPS', 'LCD', 'OLED', 'AMOLED', 'Super AMOLED', 'QLED', 'Other', 'None',
            ],
            'Mobile Device Audio Type' => [
                'Stereo', 'Mono',
            ],
            'Mobile Device Audio Connectivity' => [
                'Wired', 'Wireless',
            ],
            'Mobile Device Data Connectivity' => [
                '2G',
                '3G',
                '4G',
                '5G',
                'Other',
                'None'
            ],
            'Mobile Device USB Connectivity' => [
                'Type B',
                'Type C',
                'Lightening',
                'Other',
            ],
            'Mobile Device RAM' => [
                '128MB',
                '256MB',
                '512MB',
                '1GB',
                '2GB',
                '3GB',
                '4GB',
                '6GB',
                '8GB',
                '12GB',
                '16GB',
                '32GB',
                '64GB',
                '128GB',
                '256GB',
                '512GB',
                '1TB',
                '2TB',
                '5TB',
                '10TB',
            ],

            'Mobile Device Storage' => [
                'None',
                '128MB',
                '256MB',
                '512MB',
                '1GB',
                '2GB',
                '3GB',
                '4GB',
                '6GB',
                '8GB',
                '12GB',
                '16GB',
                '32GB',
                '64GB',
                '128GB',
                '256GB',
                '512GB',
                '1TB',
                '2TB',
                '5TB',
                '10TB',
            ],
            'Mobile Device Charging Mode' => ['Wired', 'Wireless'],

            'Computer Accessory Brand' => [
                'HP',
                'Asus',
                'DELL',
                'Acer',
                'LG',
                'Lenovo',
                'Fujitsu',
                'IBM',
                'Apple',
                'Samsung',
                'Toshiba',
                'NEC',
                'Gateway',
                'Other'
            ],
            'Computer Accessory USB Type' => [
                'USB 2.0',
                'USB 3.0',
                'USB 3.1',
                'USB C',
                'Thunderbolt',
                'Lightening',
            ],
            'Computer Accessory Screen Type' => [
                'IPS',
                'LCD',
                'OLED',
                'AMOLED',
                'Super AMOLED',
                'QOLED',
                'Other',
                'None',
            ],
            'Computer Accessory Storage' => [
                'None',
                '128MB',
                '256MB',
                '512MB',
                '1GB',
                '2GB',
                '3GB',
                '4GB',
                '6GB',
                '8GB',
                '12GB',
                '16GB',
                '32GB',
                '64GB',
                '128GB',
                '256GB',
                '512GB',
                '1TB',
                '2TB',
                '5TB',
                '10TB'
            ],
            'Computer Accessory RAM' => [
                '128MB',
                '256MB',
                '512MB',
                '1GB',
                '2GB',
                '3GB',
                '4GB',
                '6GB',
                '8GB',
                '12GB',
                '16GB',
                '32GB',
                '64GB',
                '128GB',
                '256GB',
                '512GB',
                '1TB',
                '2TB',
                '5TB',
                '10TB'
            ],
            'Computer Accessory Audio Connectivity' => ['Wired', 'Wireless'],
            'Computers or Tablet Type' => [
                'Desktop',
                'Laptop',
                'Foldable',
                'Mobile',
                'Tablet',
            ],
            'Computers or Tablet Brand' => [
                'HP',
                'Asus',
                'DELL',
                'Acer',
                'LG',
                'Lenovo',
                'Fujitsu',
                'IBM',
                'Apple',
                'Samsung',
                'Toshiba',
                'NEC',
                'Gateway',
                'Other'
            ],
            // 'Computers or Tablet Memory' (128MB/256MB/512MB/1GB/2GB/3GB/4GB/6GB/8GB/12GB/16GB/32GB/64GB/128GB/256GB/512GB/1TB/2TB/5TB/10TB)
            // Computers or Tablet Storage (128MB/256MB/512MB/1GB/2GB/3GB/4GB/6GB/8GB/12GB/16GB/32GB/64GB/128GB/256GB/512GB/1TB/2TB/5TB/10TB)
            // Computers or Tablet Charging (Wired/Wireless)
            // Musical Instrument Type (Brass/Percussion/Strings/Woodwind/Keyboards/Orchestra/Other)
            // Musical Instrument Sound Type (Acoustic/Electric/Semi-Acoustic/Digital/Electronic/Other)
            // Vehicle Brand (Honda/AMG/Mercedes/Porche/Suzuki/Toyota/Nissan/Aston Martin/Renault/Maclaren/BMW/Alfa Romeo/Ferrari/Lamborghini/Jaguar/Chevrolet/Daihatsu/Volkswagon/Subaru/Other)
            // Vehicle Fuel Type (Petrol/Diesel/Hybrid/Electric/CNG/other)
            // Vehicle Transmission (Manual/Automatic/Tiptronic/Other)
            // Vehicle Condition (Brand-New/Reconditioned/Used)
            // Vehicle Body Type (Saloon/Hatchback/Station Wagon/Convertible/Coupe/Sports/SUV/4X4/MPV/Other)


        ];


        // CategoryOption::create(['title' => 'Brand']);
    }
}
