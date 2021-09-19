<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    /**
     * A Province has multiple Districts
     *
     * @return void
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }

}
