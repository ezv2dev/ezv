<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FileCompressionService as FileCompression;
use File;
use Auth;
use App\Models\Profile;
use App\Models\ProfileLanguage;
use App\Models\User;
use App\Models\HostLanguage;

class ProfileController extends Controller
{
    public function profile_index()
    {
        $languages = HostLanguage::all();

        $profile = Profile::where('user_id', Auth::user()->id)->first();

        $owner_language = ProfileLanguage::where('user_id', Auth::user()->id)
        ->select('owner_profile_language.language', 'host_language.name')
        ->join('host_language', 'host_language.id_host_language', '=', 'owner_profile_language.language')
        ->get();

        return view('new-admin.partner.account.profile.profile',compact('languages','owner_language', 'profile'));
    }

    public function upload_foto()
    {
        return view('new-admin.partner.account.profile.upload_foto');
    }

    public function store_foto(Request $request)
    {
        if ($request->ajax())
        {
            $foto_profile = $request->file('file');

            if (Auth::user()->foto_profile != NULL)
            {
                File::delete('foto_profile/'. Auth::user()->foto_profile);
            }

            $filename = time() . '.' . $foto_profile->getClientOriginalExtension();
            $foto_profile->move(public_path('foto_profile'),$filename);

            //insert into database
            $data = User::where('id', Auth::user()->id)->update([
                'foto_profile' => $filename,
            ]);

            return response()->json([
                'message' => 'data has been updated'
            ], 200);
        }

        else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function storeProfile(Request $request)
    {
        $language = $request->language;

        if(Profile::where('user_id', Auth::user()->id)->first())
        {
            Profile::where('user_id', Auth::user()->id)->update(
                [
                    'user_id' => Auth::user()->id,
                    'about' => $request->about,
                    'work' => $request->work,
                    'location' => $request->location,
                ]
            );
        }
        else
        {
            Profile::create(
                [
                    'user_id' => Auth::user()->id,
                    'about' => $request->about,
                    'work' => $request->work,
                    'location' => $request->location,
                ]
            );
        }

        if ($language)//cek jika sudah ada language
        {
            $cek = ProfileLanguage::where('user_id',Auth::user()->id)->delete();
        }

        //store ulang
        foreach ($language as $key => $value) {
            $data[] = [
                'user_id' => Auth::user()->id,
                'language' => $value
            ];
        }

        ProfileLanguage::insert($data);

        return redirect()->back()->with('success', 'Your profile updated');

    }
}
