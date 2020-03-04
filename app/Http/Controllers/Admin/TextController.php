<?php

namespace App\Http\Controllers\Admin;

use App\Text;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TextController extends Controller
{
    protected $text;

    public function __construct(Text $text)
    {
        $this->text = $text;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $text = $this->text->get();

        return view('admin.text.index')
            ->with('texts', $text);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $text = $this->text->findOrFail($id);

        return view('admin.text.edit')
            ->with('text', $text);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $text = $this->text->where('key_name', '=', $id)->first();

        $text->update([
            'text' => $request->text,
        ]);

        return redirect()
            ->back();
    }
}
