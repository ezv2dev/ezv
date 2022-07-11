<?php

namespace App\Http\Controllers\Translate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TranslateService;

class TranslateController extends Controller
{
    public function translate(Request $request)
    {
        $data = collect(json_decode($request->data));
        $listAfterTranslate = [];
        for ($i=0; $i < $data->count(); $i++) {
            $subData = [
                'index' => $data[$i]->index,
                'text' => TranslateService::translate($data[$i]->text),
            ];
            array_push($listAfterTranslate, $subData);
        }

        if($request) {
            return response()->json($listAfterTranslate, 200);
        } else {
            return response()->json([
                'message' => 'Opsss'
            ], 500);
        }
    }

    public function translatePerGroup(Request $request)
    {
        $data = $request->data;
        if($request) {
            return response()->json([
                0 => TranslateService::translate($data)
            ], 200);
        } else {
            return response()->json([
                'message' => 'Opsss'
            ], 500);
        }
    }
}
