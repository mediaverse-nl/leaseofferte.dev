<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LeaseOffer extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';

    protected $table = 'lease_offers';

    public $timestamps = true;

    protected $fillable = ['title', 'description'];

    protected $dates = ['created_at', 'updated_at'];

    public function operationalLeasePrices()
    {
        return $this->hasMany('App\OperationalLeasePrice','lease_offers_id', 'id');
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

        if(!empty($this->images)){
            $i = 1;
            foreach (explode(',', $this->images) as $image) {
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

    public static function amountOfDoors()
    {
        return [
            3,
            4,
            5
        ];
    }

    public static function carrosserie()
    {
        return [
            'Bestelwagen',
            'Coupé',
            'Hatchback',
            'Sedan',
            'SUV',
            'Stationwagen',
        ];
    }

    public static function fuels()
    {
        return [
            'Diesel',
            'Benzine',
            'Elektrisch',
            'Hybride',
            'LPG',
            'Waterstof',
        ];
    }

    public static function segment()
    {
        return [
            'Personenauto',
            'Bedrijfsauto'
        ];
    }
}
