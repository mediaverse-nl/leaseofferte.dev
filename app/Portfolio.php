<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Portfolio extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';

    protected $table = 'portfolios';

    public $timestamps = true;

    protected $fillable = ['title', 'description'];

    protected $dates = ['created_at', 'updated_at'];

    public function solution()
    {
        return $this->belongsTo('App\Solution','solution_id', 'id');
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
