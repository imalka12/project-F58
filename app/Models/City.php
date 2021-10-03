<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['city'];

    /**
     * A City belongs to District
     *
     * @return void
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
}
