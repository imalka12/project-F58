<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id', 'title', 'icon', 'status'];

    /**
     * A Sub Category belongs to a Category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
}
