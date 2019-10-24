<?php

namespace App\Traits;

use App\Seo;

trait SeoManager
{
    public function getPageSeo()
    {
        $seo = new Seo();

        $routeName = request()->route()->getName();

        $seo = $seo->where('route_name', '=', $routeName);

        if ($seo->count() == 0){
            $seo = $this->createSeoEntry($routeName);
        }

        return $seo->first();
    }

    public function createSeoEntry($routeName)
    {
        $seo = new Seo();

        $seo->route_name = $routeName;
        $seo->title = '';
        $seo->description = '';
        $seo->save();

        return $seo;
    }
}