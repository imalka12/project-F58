<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

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

    /**
     * 
     */
    public function isIncomplete() {
        $fields = [
            $this->address_line_1, 
            $this->city_id,
            $this->telephone
        ];

        return in_array(null, $fields) || in_array('', $fields);
    }

}
