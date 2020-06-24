<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\Site\ContactStoreRequest;
use App\Mail\AdminContactRequest;
use App\Mail\ContactRequest;
use App\Mail\OrderRequest;
use App\Traits\SeoManager;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    use SEOTools, SeoManager;

    public function index()
    {
        $this->seo()
            ->setTitle($this->getPageSeo()->title)
            ->setDescription($this->getPageSeo()->description);
        //opengraph
        $this->seo()
            ->opengraph()
            ->setUrl(url()->current())
            ->addProperty('type', 'website');
        //twitter
        $this->seo()
            ->twitter();

        return view('site.contact');
    }

    public function store(ContactStoreRequest $request)
    {
        Mail::to($request->email)
            ->send(new ContactRequest($request->except(['_token', 'g-recaptcha-response'])));

        Mail::to(env('MAIL_ADMIN'))
            ->send(new AdminContactRequest($request->except(['_token', 'g-recaptcha-response'])));

        session()->flash('sended', 'success');

        return redirect()->route('site.contact.index');
    }
}
