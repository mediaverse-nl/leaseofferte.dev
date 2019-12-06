<?php

if (!function_exists('ValidateFields')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function ValidateFields($value)
    {
//        return dd(isset($errors));

        if (isset($errors)){
            $errors->has('form_part') ? '': ' is-invalid ';
        }{
            return ' is-valid';
        }

//        (!$errors->has('form_part') ? '': ' is-invalid ');
        return ' is-invalid';
    }
}
