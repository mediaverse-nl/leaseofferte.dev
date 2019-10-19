<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Review extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';

    protected $table = 'review';

    public $timestamps = true;

    protected $fillable = ['user_id', 'product_id', 'text', 'name', 'rating'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function review()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

}
