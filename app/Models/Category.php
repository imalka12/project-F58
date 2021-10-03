<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'icon', 'status'];

    /**
     * A Category has many Sub Categories
     *
     * @return void
     */
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

}
