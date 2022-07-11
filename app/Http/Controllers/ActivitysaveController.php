<?php

namespace App\Http\Controllers;

use App\Models\ActivitySave;
use Illuminate\Http\Request;

class ActivitysaveController extends Controller
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
        $checkSameFavorit = ActivitySave::where([
            ['id_activity', '=', $request->id],
            ['id_user', '=', $user->id],
        ])->first();

        if($checkSameFavorit != null) {
            $checkSameFavorit->delete();
            return redirect()->back();
        };

        // otherwise, create favorit
        ActivitySave::create([
            'id_activity' => $request->id,
            'id_user' => $user->id,
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);

        return redirect()->back();
    }
}
