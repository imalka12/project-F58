<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
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
        'payment_id',
    ];

    /**
     * Advertisement belongs to SubCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    /**
     * Advertisement belongs to a City
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Approved by user belongs to User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Advertisement has many AdvertisementOptions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advertisementOptions()
    {
        return $this->hasMany(AdvertisementOption::class);
    }

    /**
     * Advertisement has many AdvertisementImages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advertisementImages()
    {
        return $this->hasMany(AdvertisementImage::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
