<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Faq extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';

    protected $table = 'faq';

    public $timestamps = true;

    protected $fillable = ['title', 'description'];

    protected $dates = ['created_at', 'updated_at'];

}
