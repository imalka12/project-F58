<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    const TYPE_PUBLISH = 'publish';
    const TYPE_RENEWAL = 'renewal';
    const TYPE_PROMOTE = 'promote';

    protected $fillable = ['user_id', 'advertisement_id', 'amount', 'request_code', 'response_code', 'status', 'type'];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class)->withTrashed();
    }
}
