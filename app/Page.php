<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'page';

    public $timestamps = true;

    protected $fillable = ['title', 'slug', 'body'];

    protected $dates = ['created_at', 'updated_at'];

    public function slugTitle()
    {
        return str_slug($this->slug, '-');
    }
}
