<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'address_line_1', 'address_line_2', 'city_id', 'telephone', 'image', 'is_approved', 'is_verified', 'is_seller', 'payment_id', 'membership_expire_at', 'is_blacklisted',];

    /**
     * Profile belongs to User
     * 
     * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
