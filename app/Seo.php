<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'seo';

    public $timestamps = true;

    protected $fillable = ['title', 'description', 'route_name'];

    protected $dates = ['created_at', 'updated_at'];
}
