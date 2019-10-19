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

    protected $table = 'categories';

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

    public function scopeParents($query)
    {
        $query->where('category_id', '=', null);
    }

    public function buildMenu($menu, $parentid = 0)
    {
        $result = null;

        foreach ($menu as $item)
        {
            if ($item->category_id == $parentid)
            {
                $result .=
                "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
                  <div class='dd-handle nested-list-handle'>
                    <i class='fa fa-fw fa-arrows'></i>
                  </div>
                  <div class='nested-list-content'>{$item->value}
                    <div class='pull-right'>
                      <a href='".url("admin/menu/edit/{$item->id}")."'>Edit</a>
                       |
                      <a href='#' class='delete_toggle' rel='{$item->id}'>Delete</a>
                    </div>
                  </div>
                  ".$this->buildMenu($menu, $item->id) .
                "</li>";
            }
        }
        return $result ? "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
    }

    // Getter for the HTML menu builder
    public function renderMenu()
    {
        $items = $this->get(['id', 'value', 'category_id', 'order']);

        return $this->buildMenu($items);
    }
}
