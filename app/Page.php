<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $table = 'page';

    public $timestamps = true;

    protected $fillable = ['title', 'slug', 'body'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function slugTitle()
    {
        return str_slug($this->slug, '-');
    }

    public function getStatusAttribute()
    {
        return $this->deleted_at == null ? 1 : null;
    }
}
