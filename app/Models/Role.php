<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'is_default_role'];

    /**
     * A Role has many Users
     *
     * @return void
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function getDefault()
    {
        return static::whereIsDefaultRole(true)->first();
    }
}
