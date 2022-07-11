<?php

namespace App\Services;

use AmrShawky\LaravelCurrency\Facade\Currency;

class CurrencyConversionService {

    public static function exchange($number)
    {
        if(!$number) {
            return null;
        }

        if(session()->has('currency') && session('currency') != 'IDR') {
            $number = Currency::convert()
                ->from('IDR')
                ->to('USD')
                ->amount(20000)
                ->get();
        }

        return $number;
    }

    public static function exchangeWithUnit($number)
    {
        if(!$number) {
            return null;
        }
        if(session()->has('currency') && session('currency') != 'IDR') {
            $number = Currency::convert()
                ->from('IDR')
                ->to(session('currency'))
                ->amount($number)
                ->get();
        }

        if(session()->has('currency')) {
            return session('currency').' '.number_format($number, 0, ".", ",");
        }

        return 'IDR '.number_format($number, 0, ".", ",");
    }
}
