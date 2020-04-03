<?php

if (!function_exists('render_conditional_class')) {
    function render_conditional_class($condition, $class, $sub_class)
    {
        return ($condition) ? $class : $sub_class;
    }
}

if (!function_exists('set_full_request_class')) {

    function set_full_request_class($path, $class)
    {
        return call_user_func_array('Request::is', (array) $path) ? $class : '';
    }
}

// Temporary
if (!function_exists('split_sentence')) {
    function split_sentence($input, int $len, string $end)
    {
        $str = $input;
        if (strlen($input) > $len) {
            $str = explode("\n", wordwrap($input, $len));
            $str = $str[0] . $end;
        }

        return $str;
    }
}