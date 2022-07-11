<?php

namespace App\Services;
use Stichoza\GoogleTranslate\GoogleTranslate;

use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\URL;

class LazyLoadService
{
    public static function show()
    {
        // $link = 'https://c.tenor.com/64UaxgnTfx0AAAAC/memes-loading.gif';
        $link = URL::asset('/assets/background/skeleton-load.gif');
        return $link;
    }
}
