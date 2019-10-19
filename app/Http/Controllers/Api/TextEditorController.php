<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Admin\TextUpdateRequest;
use App\Text;
use App\Http\Controllers\Controller;

class TextEditorController extends Controller
{
    public function edit(TextUpdateRequest $request, $id)
    {
        $text = Text::findOrFail($id);

        $text->update(['text' => $request->text]);

        return response()
            ->json('ok', 200);
    }
}
