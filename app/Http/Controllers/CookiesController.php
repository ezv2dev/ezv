<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookiesController extends Controller
{
    //
    public function set_cookie_theme(Request $request){
        
        $response = new Response('Hello World');
        $response->withCookie(cookie()->forever('theme', $request->theme));
        return $response;
    }
}
