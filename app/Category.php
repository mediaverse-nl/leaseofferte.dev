<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable, SoftDeletes;

    protected $primaryKey = 'id';

    protected $table = 'category';

    public $timestamps = false;

    protected $fillable = ['*'];

    public function categories()
    {
        return $this->hasMany('App\Category','category_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category','category_id', 'id');
    }

    public function solutions()
    {
        return $this->hasMany('App\Solution','category_id', 'id');
    }

    public function dynamicFields()
    {
        return $this->hasMany('App\DynamicField','category_id', 'id');
    }

    public function dynamicFieldsExists($fieldName)
    {
        if (!is_array($fieldName)){
            return $this->dynamicFields()
                ->where('field_name', '=', $fieldName)
                ->exists();
        }else{
            foreach ($fieldName as $item){
                return $this->dynamicFields()
                    ->where('field_name', '=', $item)
                    ->exists();
            }
        }
    }

    public function scopeParents($query)
    {
        $query->where('category_id', '=', null);
    }
}
