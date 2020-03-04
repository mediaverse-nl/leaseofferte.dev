<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'news';

    public $timestamps = true;

    protected $fillable = ['title', 'description'];

    protected $dates = ['created_at', 'updated_at'];


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

    public function image()
    {
        return $this->images(1)[0];
    }
}
