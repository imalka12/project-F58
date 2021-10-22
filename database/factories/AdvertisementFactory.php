<?php

namespace Database\Factories;

use App\Models\Advertisement;
use App\Models\City;
use App\Models\Payment;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertisementFactory extends Factory
{


    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Advertisement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sub_category_id' => '',
            'city_id' => '',
            'title' => $this->faker->text(190),
            'description' => $this->faker->paragraphs(4),
            'condition' => 'new',
            'price' => $this->faker->numberBetween(100, 300000),
            'is_price_negotiable' => false,
            'is_offers_accepted' => false,
            'min_offer' => 0.0,
            'expire_at' => now()->addWeek()->format('Y-m-d H:i:s'),
            'renewed_at' => null,
            'is_approved' => false,
            'user_id' => '',
            'is_promoted' => false,
            'payment_id' => null,
        ];
    }

    public function withUser(User $user)
    {
        return $this->state(function(array $attributes) use ($user) {
            return [
                'user_id' => $user->id,
            ];
        });
    }

    public function withCondition(string $condition = 'new') {
        return $this->state(function(array $attributes) use ($condition) {
            return [
                'condition' => $condition,
            ];
        });
    }

    public function withCity(City $city)
    {
        return $this->state(function(array $attributes) use ($city) {
            return [
                'city_id' => $city->id,
            ];
        });
    }

    public function withSubCategory(SubCategory $subCategory)
    {
        return $this->state(function(array $attributes) use($subCategory) {
            return [
                'sub_category_id' => $subCategory->id,
            ];
        });
    }

    public function unpaid()
    {
        return $this->state(function(array $attr){
            return [
                'is_approved' => false,
                'payment_id' => null,
            ];
        });
    }

    public function paid(Payment $payment)
    {
        return $this->state(function(array $attr) use($payment) {
            return [
                'is_approved' => true,
                'payment_id' => $payment->id,
            ];
        });
    }

    public function expired(Payment $payment)
    {
        return $this->state(function(array $attr) use($payment) {
            return [
                'is_approved' => true,
                'payment_id' => $payment->id,
                'expire_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'renewed_at' => null
            ];
        });
    }

    public function promoted(Payment $payment)
    {
        return $this->state(function(array $attr) use($payment) {
            return [
                'is_approved' => true,
                'payment_id' => $payment->id,
            ];
        });
    }

}
