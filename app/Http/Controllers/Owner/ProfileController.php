<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Auth;
use App\Models\Profile;
use App\Models\ProfileLanguage;
use App\Models\User;
use App\Models\HostLanguage;
use App\Models\Villa;

class ProfileController extends Controller
{
    public function showProfile($id)
    {
        $user = User::where('id', $id)->first();
        $infoOwner = Profile::where('user_id', $id)->first();

        $villaOwner = Villa::where('created_by', $id)->where('status', 1)->get();
        return view('user.owner.profile', compact('user', 'infoOwner', 'villaOwner'));
    }
}
