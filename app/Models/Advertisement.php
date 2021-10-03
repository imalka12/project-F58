<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'type',
        'sub_category_id',
        'city_id',
        'title',
        'description',
        'condition',
        'price',
        'is_price_negotiable',
        'is_offers_accepted',
        'min_offer',
        'expire_at',
        'renewed_at',
        'is_approved',
        'user_id',
        'is_promoted',
    ];

    /**
     * Advertisement belongs to SubCategory
     *
     * @return void
     */
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    /**
     * Advertisement belongs to a City
     *
     * @return void
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Approved by user belongs to User
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
