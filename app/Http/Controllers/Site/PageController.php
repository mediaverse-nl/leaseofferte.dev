<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    protected $page;

    public function __construct()
    {
        $this->page;
    }

    public function show($slug)
    {
        $templates = [
            'default-page',
        ];

        if (in_array($slug, $templates)){

            $template = 'page';

            return view('site.templates.'.$template);
        }
        exit;
        return 'asdasd';
    }
}
