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
        $defaultReplaces = ['-', '_', '/', '.', ',', ' ', ')', '(', '[', ']', '__', '___'];

        $replaces = array_merge($replaces, $defaultReplaces);

        foreach ($replaces as $r){
            $word = str_replace($r, '_', $word);
        }

        if (substr($word, -1) == "_"){
            $word = rtrim($word,"_");
        }

        return strtolower($word);
    }
}
