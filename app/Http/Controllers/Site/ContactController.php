<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\Site\ContactStoreRequest;
use App\Mail\AdminContactRequest;
use App\Mail\ContactRequest;
use App\Mail\OrderRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('site.contact');
    }

    public function store(ContactStoreRequest $request)
    {
        Mail::to($request->email)
            ->send(new ContactRequest($request->except(['_token', 'g-recaptcha-response'])));

        Mail::to(env('MAIL_ADMIN'))
            ->send(new AdminContactRequest($request->except(['_token', 'g-recaptcha-response'])));

        return redirect()->route('site.contact.index');
    }
}
