<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementOption extends Model
{
    use HasFactory;

    protected $fillable = ['advertisement_id', 'option_group_id', 'option_group_value_id'];

    /**
     * AdvertisementOption belongs to Advertisement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }

    /**
     * AdvertisementOption belongs to OptionGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function optionGroup()
    {
        return $this->belongsTo(OptionGroup::class);
    }

    /**
     * AdvertisementOption belongs to OptionGroupValue
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function optionGroupValue()
    {
        return $this->belongsTo(OptionGroupValue::class);
    }
}
