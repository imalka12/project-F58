<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'advertisement_id', 'amount', 'request_code', 'response_code', 'status' ];
}
