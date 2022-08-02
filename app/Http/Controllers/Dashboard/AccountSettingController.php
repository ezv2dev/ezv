<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Currency;
use App\Models\DeleteReason;
use App\Models\HostLanguage;
use App\Http\Controllers\Controller;
use App\Models\NotificationUser;
use App\Models\Timezone;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\ProfileLanguage;
use Session;

class AccountSettingController extends Controller
{
    public function index()
    {
        return view('new-admin.partner.account.index');
    }

    public function personalInfo()
    {
        // dd(Carbon::format(Auth::user()->birthday));
        return view('new-admin.partner.account.personal-info.index');
    }

    public function login_security()
    {
        $last_modified = Carbon::parse(auth()->user()->updated_at_password)->diffForHumans();
        $last_created = Carbon::parse(auth()->user()->created_at)->diffForHumans();

        return view('new-admin.partner.account.login-security.index', compact('last_modified', 'last_created'));
    }

    public function notification()
    {
        $notifications = NotificationUser::where('id_user', Auth::user()->id)->first();

        return view('new-admin.partner.account.notification.index', compact('notifications'));
    }

    public function preferences()
    {
        $languages = HostLanguage::all();
        $currency = Currency::all();
        $timezones = Timezone::Orderby('offset')->get();

        $user = User::with('language', 'currency', 'timezone')->where('id', Auth::user()->id)->get();
        // dd($user);

        // return $user;

        return view('new-admin.partner.account.global-preferences.index', compact('languages', 'currency', 'timezones', 'user'));
    }

    public function update_password()
    {
        request()->validate([
            'old_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPassword = auth()->user()->password;
        $old_password = request('old_password');

        if (Hash::check($old_password, $currentPassword)) {
            auth()->user()->update([
                'password' => bcrypt(request('password')),
                'updated_at_password' => date('Y-m-d H:i:s', time())
            ]);
            return response()->json(['status' => 'success', 'message' => 'You have successfully changed your password']);
            // return back()->with('success', 'You have successfully changed your password');
        } else {
            return response()->json(['status' => 'error', 'message' => 'Make sure you fill in your current password']);
            // return back()->with('error', 'Make sure you fill in your current password');
        }
    }

    public function formDelete()
    {
        return view('new-admin.partner.account.login-security.form-delete');
    }

    public function storeDelete(Request $request)
    {
        // dd($request->all());

        $storeDelete = new DeleteReason;
        $storeDelete->reason = $request->reasonn;
        $storeDelete->id_user = Auth::user()->id;
        $storeDelete->save();


        $active = User::where('id', Auth::user()->id)->first();
        $active->update(array('active' => 0));

        // dd($active);

        Auth::logout();

        return redirect()->route('index');
    }

    public function disconnectGoogle()
    {
        $dcGoogle = User::where('id', Auth::user()->id)->first();
        // dd("oke");
        $dcGoogle->update(array(
            'google_id' => null,
            'avatar' => null,
            'email_google' => null
        ));

        return back()->with('successDC', 'You have been disconnected your Google Account. You can reconnect again, below.');
    }

    public function disconnectFacebook()
    {
        $dcFacebook =  User::where('id', Auth::user()->id)->first();
        $dcFacebook->update(array(
            'facebook_id' => null,
            'email_facebook' => null,
            'avatar' => null
        ));
        return back()->with('successDC', 'You have been disconnected your Facebook Account. You can reconnect again, below.');
    }

    public function language(Request $request)
    {
        // dd($request->all());
        $user = User::where('id', Auth::user()->id)->first();
        $user->update(array('id_language' => $request->language));
        // dd($user);

        return back()->with('success', 'You have successfully changed your language');
    }

    public function currency(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->update(array('id_currency' => $request->currency));

        return back()->with('success', 'You have successfully changed your currency');
    }

    public function timezone(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->update(array('id_timezone' => $request->timezone));

        return back()->with('success', 'You have successfully changed your time zone');
    }

    public function change_language(Request $request)
    {
        // dd($request->all());

        $checked = $request->languagePartner[0];
        // dd($checked);

        $user = User::where('id', Auth::user()->id)->first();
        $user->update(array('id_language' => $checked));

        return back();
    }

    public function change_currency(Request $request)
    {
        // dd($request->all());

        $checked = $request->currencyPartner[0];
        // dd($checked);

        $user = User::where('id', Auth::user()->id)->first();
        $user->update(array('id_currency' => $checked));

        return back();
    }
}
