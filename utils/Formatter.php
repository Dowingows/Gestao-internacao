<?php
namespace app\utils;

class Formatter{

    public static function money($val)
    {
        if (empty($val)) {
            $val = 0;
        }
        $val = str_replace(".", ',', sprintf("%.2f", $val));
        return 'R$ ' . $val;
    }

    public static function unformatDate($date)
    {
        return implode("-", array_reverse(explode("/", $date)));
    }

    public static function date($date)
    {
        if (empty($date)){
            return '';
        }
        return date('d/m/Y', strtotime($date));
    }
}