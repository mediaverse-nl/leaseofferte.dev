<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('Editor')) {

    /**
     * description
     *
     * @param richtext  / richtext  / text
     * @return
     */
    function Editor($key, $textType = false, $hideEditorBtn = false, $value = false, $options = null)
    {
        $readableText = '';
        $textType ? $textType : 'text';
        $findText = \App\Text::where('key_name', '=', $key)->first();

        if(!empty($findText)) {
            $readableText = $findText->text;
        }elseif(!empty($value)) {
            $readableText = $value;
        }

        $model = \App\Text::firstOrCreate(
            ['key_name' => $key],
            [
                'key_name' => $key,
                'text_type' => $textType,
                'option' => json_encode($options),
                'text' => $readableText
            ]
        );

        if(Auth::check()
            && $hideEditorBtn == false
            && auth()->user()->admin == 1)
        {
            return view('components.admin-text-tool')
                ->with('text', $model);
        }

        if (isset($options))
        {
            foreach (collect($options['mentions'])->toArray() as $key => $v)
            {
                $readableText = str_replace('@'.$key, $v, $readableText);
            }
        }
        return $readableText;
    }
}
