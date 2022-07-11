<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\HostLanguage;

class CurrencyController extends Controller
{
    public function get(){

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://open.er-api.com/v6/latest/USD');
        $data = json_decode($res->getBody()->getContents(), true);

        foreach($data['rates'] as $key=>$value)
        {
            Currency::insert(array(
                'code' => $key,
                'currency' => $value,
            ));
        }

        dd("OKE");

    }

    public function sync(){
        $currency_json = '[{"code":"AED","id":"AED","name":"United Arab Emirates Dirham","symbol":"&#1583;.&#1573;","unicode_symbol":"ﺩ.ﺇ","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"ARS","id":"ARS","name":"Argentinian Pesos","symbol":"$","unicode_symbol":"$","show_currency_explicitly":true,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"AUD","id":"AUD","name":"Australian Dollars","symbol":"$","unicode_symbol":"$","show_currency_explicitly":true,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"BGN","id":"BGN","name":"Bulgarian Leva","symbol":"&#1083;&#1074;","unicode_symbol":"лв","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"BRL","id":"BRL","name":"Brazilian Reais","symbol":"R$","unicode_symbol":"R$","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"CAD","id":"CAD","name":"Canadian Dollar","symbol":"$","unicode_symbol":"$","show_currency_explicitly":true,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"CHF","id":"CHF","name":"Swiss Francs","symbol":"CHF","unicode_symbol":"CHF","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":true,"position":"after","space_between_price_and_symbol":true},{"code":"CLP","id":"CLP","name":"Chilean Pesos","symbol":"$","unicode_symbol":"$","show_currency_explicitly":true,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"CNY","id":"CNY","name":"Chinese Yuan","symbol":"&#65509;","unicode_symbol":"￥","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"COP","id":"COP","name":"Columbian Pesos","symbol":"$","unicode_symbol":"$","show_currency_explicitly":true,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"CRC","id":"CRC","name":"Colon","symbol":"&#8353;","unicode_symbol":"₡","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"CZK","id":"CZK","name":"Czech Koruny","symbol":"&#75;&#269;","unicode_symbol":"Kč","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"DKK","id":"DKK","name":"Danish Kroner","symbol":"kr","unicode_symbol":"kr","show_currency_explicitly":true,"explicit_currency_not_aesthetic":true,"hide_code_if_symbol_shown":false,"position":"after","space_between_price_and_symbol":true},{"code":"EUR","id":"EUR","name":"Euro","symbol":"&euro;","unicode_symbol":"€","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"special","space_between_price_and_symbol":false},{"code":"GBP","id":"GBP","name":"Pounds Sterling","symbol":"&pound;","unicode_symbol":"£","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"HKD","id":"HKD","name":"Hong Kong Dollars","symbol":"$","unicode_symbol":"$","show_currency_explicitly":true,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"HRK","id":"HRK","name":"Croatian Kuna","symbol":"kn","unicode_symbol":"kn","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"after","space_between_price_and_symbol":true},{"code":"HUF","id":"HUF","name":"Forint","symbol":"Ft","unicode_symbol":"Ft","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"IDR","id":"IDR","name":"Indonesian Rupiah","symbol":"Rp","unicode_symbol":"Rp","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"ILS","id":"ILS","name":"New Shekels","symbol":"&#8362;","unicode_symbol":"₪","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"INR","id":"INR","name":"Indian Rupee","symbol":"&#8377;","unicode_symbol":"₹","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"JPY","id":"JPY","name":"Yen","symbol":"&yen;","unicode_symbol":"¥","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":true},{"code":"KRW","id":"KRW","name":"South Korean Won","symbol":"&#8361;","unicode_symbol":"₩","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"MAD","id":"MAD","name":"Moroccan Dirham","symbol":"MAD","unicode_symbol":"MAD","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"MXN","id":"MXN","name":"Mexican Pesos","symbol":"$","unicode_symbol":"$","show_currency_explicitly":true,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"MYR","id":"MYR","name":"Ringgits","symbol":"&#82;&#77;","unicode_symbol":"RM","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"NOK","id":"NOK","name":"Krone","symbol":"kr","unicode_symbol":"kr","show_currency_explicitly":true,"explicit_currency_not_aesthetic":true,"hide_code_if_symbol_shown":false,"position":"after","space_between_price_and_symbol":true},{"code":"NZD","id":"NZD","name":"New Zealand Dollars","symbol":"$","unicode_symbol":"$","show_currency_explicitly":true,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"PEN","id":"PEN","name":"Nuevos Soles","symbol":"&#83;&#47;&#46;","unicode_symbol":"S/.","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"PHP","id":"PHP","name":"Philippines Peso","symbol":"&#8369;","unicode_symbol":"₱","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"PLN","id":"PLN","name":"Zlotych","symbol":"z&#22;&#322;","unicode_symbol":"zł","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"after","space_between_price_and_symbol":true},{"code":"RON","id":"RON","name":"New Lei","symbol":"lei","unicode_symbol":"lei","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"RUB","id":"RUB","name":"Rubles","symbol":"&#1088;","unicode_symbol":"₽","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"after","space_between_price_and_symbol":false},{"code":"SAR","id":"SAR","name":"Saudi Riyal","symbol":"SR","unicode_symbol":"SR","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"SEK","id":"SEK","name":"Sweden, Kronor","symbol":"kr","unicode_symbol":"kr","show_currency_explicitly":true,"explicit_currency_not_aesthetic":true,"hide_code_if_symbol_shown":false,"position":"after","space_between_price_and_symbol":true},{"code":"SGD","id":"SGD","name":"Singapore, Dollars","symbol":"$","unicode_symbol":"$","show_currency_explicitly":true,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"THB","id":"THB","name":"Baht","symbol":"&#3647;","unicode_symbol":"฿","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"TRY","id":"TRY","name":"Turkish Lira","symbol":"&#84;&#76;","unicode_symbol":"₺","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"after","space_between_price_and_symbol":true},{"code":"TWD","id":"TWD","name":"Taiwan Dollars","symbol":"$","unicode_symbol":"$","show_currency_explicitly":true,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"UAH","id":"UAH","name":"Ukrainian hryvnia","symbol":"&#8372;","unicode_symbol":"₴","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"USD","id":"USD","name":"United States Dollars","symbol":"$","unicode_symbol":"$","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"UYU","id":"UYU","name":"Uruguayan Pesos","symbol":"&#36;&#85;","unicode_symbol":"$U","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"VND","id":"VND","name":"Vietnamese Dong","symbol":"&#8363;","unicode_symbol":"₫","show_currency_explicitly":false,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false},{"code":"ZAR","id":"ZAR","name":"Rand","symbol":"R","unicode_symbol":"R","show_currency_explicitly":true,"explicit_currency_not_aesthetic":false,"hide_code_if_symbol_shown":false,"position":"before","space_between_price_and_symbol":false}]';

        $currencies = json_decode($currency_json);


        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://open.er-api.com/v6/latest/USD');
        $data = json_decode($res->getBody()->getContents(), true);

        foreach($data['rates'] as $key=>$value)
        {
            $currency = Currency::where('code', $key)->first();
            foreach($currencies as $item)
            {
                if($item->code == $key)
                {
                    $currency->update(array(
                        'name' => $item->name,
                        'code' => $key,
                        'symbol' => $item->unicode_symbol,
                        'currency' => $value,
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    ));
                }
            }
        }

        dd("OKE");
    }

    public static function language()
    {
        $language = '[{"locale":"az","locale_name":"Azərbaycan dili"},{"locale":"id","locale_name":"Bahasa Indonesia"},{"locale":"ms","locale_name":"Bahasa Melayu"},{"locale":"bs","locale_name":"Bosanski"},{"locale":"ca","locale_name":"Català"},{"locale":"sr-ME","locale_name":"Crnogorski"},{"locale":"da","locale_name":"Dansk"},{"locale":"de","locale_name":"Deutsch"},{"locale":"et","locale_name":"Eesti"},{"locale":"en","locale_name":"English"},{"locale":"en-AU","locale_name":"English (Australia)"},{"locale":"en-CA","locale_name":"English (Canada)"},{"locale":"en-GB","locale_name":"English (UK)"},{"locale":"es","locale_name":"Español"},{"locale":"es-AR","locale_name":"Español (Argentina)"},{"locale":"es-XL","locale_name":"Español (Latinoamérica)"},{"locale":"es-419","locale_name":"Español (México)"},{"locale":"el","locale_name":"Eλληνικά"},{"locale":"fr","locale_name":"Français"},{"locale":"fr-CA","locale_name":"Français (canadien)"},{"locale":"ga","locale_name":"Gaeilge"},{"locale":"hr","locale_name":"Hrvatski"},{"locale":"it","locale_name":"Italiano"},{"locale":"sw","locale_name":"Kiswahili"},{"locale":"lv","locale_name":"Latviešu Valoda"},{"locale":"lt","locale_name":"Lietuvių kalba"},{"locale":"hu","locale_name":"Magyar"},{"locale":"mt","locale_name":"Malti"},{"locale":"nl","locale_name":"Nederlands"},{"locale":"no","locale_name":"Norsk"},{"locale":"pl","locale_name":"Polski"},{"locale":"pt","locale_name":"Português"},{"locale":"ro","locale_name":"Română"},{"locale":"sq","locale_name":"Shqip"},{"locale":"sk","locale_name":"Slovenčina"},{"locale":"sl","locale_name":"Slovenščina"},{"locale":"sr","locale_name":"Srpski"},{"locale":"fi","locale_name":"Suomi"},{"locale":"sv","locale_name":"Svenska"},{"locale":"tl","locale_name":"Tagalog"},{"locale":"vi","locale_name":"Tiếng Việt"},{"locale":"tr","locale_name":"Türkçe"},{"locale":"xh","locale_name":"isiXhosa"},{"locale":"zu","locale_name":"isiZulu"},{"locale":"is","locale_name":"Íslenska"},{"locale":"cs","locale_name":"Čeština"},{"locale":"bg","locale_name":"Български"},{"locale":"mk","locale_name":"Македонски"},{"locale":"ru","locale_name":"Русский"},{"locale":"uk","locale_name":"Українська"},{"locale":"hy","locale_name":"Հայերեն"},{"locale":"he","locale_name":"עברית"},{"locale":"ar","locale_name":"العربية"},{"locale":"hi","locale_name":"हिन्दी"},{"locale":"th","locale_name":"ภาษาไทย"},{"locale":"ka","locale_name":"ქართული"},{"locale":"zh","locale_name":"中文 (简体)"},{"locale":"zh-TW","locale_name":"中文 (繁體)"},{"locale":"ja","locale_name":"日本語"},{"locale":"ko","locale_name":"한국어"}]';

        $google = '[{"code" : "af"},{"code" : "sq"},{"code" : "am"},{"code" : "ar"},{"code" : "hy"},{"code" : "az"},{"code" : "eu"},{"code" : "be"},{"code" : "bn"},{"code" : "bs"},{"code" : "bg"},{"code" : "ca"},{"code" : "ceb"},{"code" : "zh"},{"code" : "zh-TW"},{"code" : "co"},{"code" : "hr"},{"code" : "cs"},{"code" : "da"},{"code" : "nl"},{"code" : "en"},{"code" : "eo"},{"code" : "et"},{"code" : "fi"},{"code" : "fr"},{"code" : "fy"},{"code" : "gl"},{"code" : "ka"},{"code" : "de"},{"code" : "el"},{"code" : "gu"},{"code" : "ht"},{"code" : "ha"},{"code" : "haw"},{"code" : "he"},{"code" : "hi"},{"code" : "hu"},{"code" : "is"},{"code" : "ig"},{"code" : "id"},{"code" : "ga"},{"code" : "it"},{"code" : "ja"},{"code" : "jv"},{"code" : "kn"},{"code" : "kk"},{"code" : "km"},{"code" : "rw"},{"code" : "ko"},{"code" : "ku"},{"code" : "ky"},{"code" : "lo"},{"code" : "lv"},{"code" : "lt"},{"code" : "lb"},{"code" : "mk"},{"code" : "mg"},{"code" : "ms"},{"code" : "ml"},{"code" : "mt"},{"code" : "mi"},{"code" : "mr"},{"code" : "mn"},{"code" : "my"},{"code" : "ne"},{"code" : "no"},{"code" : "ny"},{"code" : "or"},{"code" : "ps"},{"code" : "fa"},{"code" : "pl"},{"code" : "pt"},{"code" : "pa"},{"code" : "ro"},{"code" : "ru"},{"code" : "sm"},{"code" : "gd"},{"code" : "sr"},{"code" : "st"},{"code" : "sn"},{"code" : "sd"},{"code" : "si"},{"code" : "sk"},{"code" : "sl"},{"code" : "so"},{"code" : "es"},{"code" : "su"},{"code" : "sw"},{"code" : "sv"},{"code" : "tl"},{"code" : "tg"},{"code" : "ta"},{"code" : "tt"},{"code" : "te"},{"code" : "th"},{"code" : "tr"},{"code" : "tk"},{"code" : "uk"},{"code" : "ur"},{"code" : "ug"},{"code" : "uz"},{"code" : "vi"},{"code" : "cy"},{"code" : "xh"},{"code" : "yi"},{"code" : "yo"},{"code" : "zu"}]';

        $languages = json_decode($language);
        $googles = json_decode($google);

        $data = array();

        foreach($languages as $item)
        {
            foreach($googles as $item2)
            {
                if($item->locale == $item2->code)
                {
                    array_push($data, $item);
                    // HostLanguage::insert(array(
                    //     'locale' => $item->locale,
                    //     'name' => $item->locale_name,
                    //     'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    //     'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    // ));
                }
            }
        }
        // dd("oke");
        return $data;
    }
}
