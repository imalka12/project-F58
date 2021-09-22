<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

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
