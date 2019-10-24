<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'solutions';

    public $timestamps = true;

    protected $fillable = ['value'];

    protected $dates = ['created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo('App\Category','category_id', 'id');
    }

    public function getCategoriesAttribute()
    {
        $categories = new Category();

        return array_merge(['-- select --'], $categories->pluck('value', 'id')->toArray());
    }

    public function getUrlTitleAttribute()
    {
        $url = preg_replace('~[^\\pL0-9_]+~u', '-', $this->title);
        $url = trim($url, "-");
        $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
        $url = strtolower($url);
        $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

        return $url;
    }

    public function images($amount = '*')
    {
        $images = [];

        if(!empty($this->image)){
            $i = 1;
            foreach (explode(',', $this->image) as $image) {
                if ($amount == '*'){
                    $images[] = $image;
                }elseif ($i <= $amount){
                    $images[] = $image;
                }
                $i++;
            }
        }else{
            $images = null;
        }

        return $images;
    }

    public function thumbnail()
    {
        return $this->images(1)[0];
    }

}
