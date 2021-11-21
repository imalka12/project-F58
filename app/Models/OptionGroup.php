<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class OptionGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['sub_category_id', 'title', 'slug'];

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

    /**
     * Set the option group slug attribute
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($this->attributes['title']);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($optionGroup) {
            $optionGroup->slug = Str::slug($optionGroup->title);
        });

        static::updating(function ($optionGroup) {
            $optionGroup->slug = Str::slug($optionGroup->slug);
        });
    }
}
