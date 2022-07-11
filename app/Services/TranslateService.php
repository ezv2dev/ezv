<?php

namespace App\Services;
use Stichoza\GoogleTranslate\GoogleTranslate;

use App\Http\Controllers\CurrencyController;

class TranslateService
{
    public static function translate($string)
    {
        $language = collect(CurrencyController::language());
        if($string == null) {
            return $string;
        }
        if(session()->has('locale') && session('locale') != 'en') {
            $find = $language->where('locale', session('locale'))->first();
            if($find) {
                $tr = new GoogleTranslate();
                $string = $tr->setSource()->setTarget($find->locale)->translate($string);
            }
            return $string;
        }
        return $string;
    }
}
