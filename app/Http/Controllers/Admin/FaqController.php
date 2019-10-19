<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use App\Http\Requests\Admin\FaqStoreRequest;
use App\Http\Requests\Admin\FaqUpdateRequest;
use App\Notifications\DeleteModelNotification;
use App\Notifications\OrderNotification;
use App\Notifications\StoreModelNotification;
use App\Notifications\UpdateModelNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    protected $faq;

    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faq = $this->faq->get();

        return view('admin.faq.index')
            ->with('faqs', $faq);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqStoreRequest $request)
    {
        $faq = $this->faq;

        $faq->title = $request->title;
        $faq->description = $request->description;

        $faq->save();

        auth()->user()->notify(new StoreModelNotification($faq));

        return redirect()->route('admin.faq.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = $this->faq->findOrFail($id);

        return view('admin.faq.edit')
            ->with('faq', $faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqUpdateRequest $request, $id)
    {
        $faq = $this->faq->findOrFail($id);

        $faq->title = $request->title;
        $faq->description = $request->description;

        $faq->save();

        auth()->user()->notify(new UpdateModelNotification($faq));

        return redirect()->route('admin.faq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = $this->faq->findOrFail($id);

        $faq->delete();

        auth()->user()->notify(new DeleteModelNotification($faq));

        return redirect()
            ->route('admin.faq.index');
    }
}
