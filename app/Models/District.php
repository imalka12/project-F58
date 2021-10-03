<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['province_id', 'title'];

    /**
     * A District belongs to Province
     *
     * @return void
     */
    public function province() {
        return $this->belongsTo(Province::class);
    }

    /**
     * A District has many Cities
     *
     * @return void
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

}
