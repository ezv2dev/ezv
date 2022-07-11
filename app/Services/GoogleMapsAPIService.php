<?php

namespace App\Services;

class GoogleMapsAPIService
{
    public static function calculateTime($url) {
        // try {
        //     $c = curl_init();
        //     curl_setopt($c, CURLOPT_URL, $url);
        //     curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        //     $response = curl_exec($c);
        //     curl_close($c);
        //     $data = json_decode($response);
        //     $value = $data->rows[0]->elements[0]->duration->text;
        // } catch (\Throwable $th) {
        //     $value = null;
        // }

        // // $value = null;

        // return $value;
    }

    public static function calculateDistance($url) {
        // try {
        //     $c = curl_init();
        //     curl_setopt($c, CURLOPT_URL, $url);
        //     curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        //     $response = curl_exec($c);
        //     curl_close($c);
        //     $data = json_decode($response);
        //     $value = $data->rows[0]->elements[0]->distance->text;
        // } catch (\Throwable $th) {
        //     $value = null;
        // }

        // // $value = null;

        // return $value;
    }
}
