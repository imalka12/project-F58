<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OptionGroupValue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['option_group_id', 'title'];

    public function optionGroup()
    {
        return $this->belongsTo(OptionGroup::class);
    }

}
