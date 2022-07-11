<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VillaSave;

class VillasaveController extends Controller
{
    public function favorit(Request $request)
    {
        // if user not logged, redirect to login form
        if(!auth()->check()) {
            return redirect(route('login'));
        }

        // declare logged user data
        $user = auth()->user();

        // check if there same favorit content
        $checkSameFavorit = VillaSave::where([
            ['id_villa', '=', $request->id],
            ['id_user', '=', $user->id],
        ])->first();

        if($checkSameFavorit != null) {
            $checkSameFavorit->delete();
            return redirect()->back();
        };

        // otherwise, create favorit
        VillaSave::create([
            'id_villa' => $request->id,
            'id_user' => $user->id,
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);

        return redirect()->back();
    }
}
