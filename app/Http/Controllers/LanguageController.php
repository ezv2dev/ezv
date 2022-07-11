<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Http\Controllers\CurrencyController;

class LanguageController extends Controller
{
    public function set_language(Request $request)
    {
        $language = collect(CurrencyController::language());
        $find = $language->where('locale', request()->locale)->first();
        if($find) {
            session(['locale' => $find->locale]);
        }
        return redirect()->back();
    }

    public function set_currency(Request $request)
    {
        $currency = Currency::where('symbol', '!=', '')->get();
        $find = $currency->where('code', request()->currency)->first();

        if($find) {
            session(['currency' => $find->code]);
        }
        return redirect()->back();
    }
}
