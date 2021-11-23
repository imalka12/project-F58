<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertisement_id' , 'reason', 'comments', 'user_id'
    ];
}
