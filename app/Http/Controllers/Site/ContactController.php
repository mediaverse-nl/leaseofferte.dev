<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\Site\ContactStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('site.contact');
    }

    public function store(ContactStoreRequest $request)
    {

        return redirect()->route('site.contact.index');
    }
}
