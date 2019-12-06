<?php

if (!function_exists('StripReplace')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function StripReplace($word, $replaces = [])
    {
        $defaultReplaces = ['-', '_', '/', '.', ',', ' '];

        $replaces = array_merge($replaces, $defaultReplaces);

        foreach ($replaces as $r){
            $word = str_replace($r, '_', $word);
        }

        return strtolower($word);
    }
}
