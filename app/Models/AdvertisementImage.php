<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementImage extends Model
{
    use HasFactory;

    protected $fillable = ['advertisement_id', 'image', 'title', 'description', 'is_featured_image'];

    /**
     * AdvertisementImage belongs to Advertisement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}
