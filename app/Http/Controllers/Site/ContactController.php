<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('site.contact');
    }

    public function store()
    {
        return redirect()->route('site.contact.index');
    }
}
