<?php

namespace App\Services;

class NumberToCurrencyService {

    public static function IDR($number)
    {
        $number = "200000";
        if(is_string($number)) {
            $number = (int)$number;
            // return var_dump($number);
        }
        return number_format($number, 0, ',', '.');
    }
}

