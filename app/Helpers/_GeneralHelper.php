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

if (!function_exists('de_slug')) {
    function de_slug($string)
    {
        $preg_split = preg_split("/[_.\-]+/", $string);

        // if (count($preg_split) > 1) {
        //     array_shift($preg_split);
        // }

        return ucwords(implode(" ", $preg_split ));

        implode(" ",preg_split("/[_.\-]+/", $string));
    }
}

if (!function_exists('thousandsFormat')) {
    function thousandsFormat($num) {

        if($num>1000) {
      
              $x = round($num);
              $x_number_format = number_format($x);
              $x_array = explode(',', $x_number_format);
              $x_parts = array('k', 'm', 'b', 't');
              $x_count_parts = count($x_array) - 1;
              $x_display = $x;
              $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
              $x_display .= ' '. $x_parts[$x_count_parts - 1];
      
              return $x_display;
      
        }
      
        return $num;
      }
}