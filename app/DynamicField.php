<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DynamicField extends Model
{
    protected $fillable = [
        'field_name',
        'field_type',
        'field_validation',
        'field_form',
        'field_order',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category','category_id', 'id');
    }
}
