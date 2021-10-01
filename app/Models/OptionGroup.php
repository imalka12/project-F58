<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    use HasFactory;

    protected $fillable = ['sub_category_id', 'title'];

    /**
     * OptionGroup has many OptionGroupValues
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function optionGroupValues()
    {
        return $this->hasMany(OptionGroupValue::class);
    }

    /**
     * OptionGroup belongs to SubCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

}
