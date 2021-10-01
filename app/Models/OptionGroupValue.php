<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionGroupValue extends Model
{
    use HasFactory;

    protected $fillable = ['option_group_id', 'title'];

    public function optionGroup()
    {
        return $this->belongsTo(OptionGroup::class);
    }

}
