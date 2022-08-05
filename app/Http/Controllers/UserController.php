<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('user_index');
        // return view('admin.user.index');
        return view('new-admin.user.index');
    }

    public function datatable()
    {
        $this->authorize('user_index');
        return User::datatables();
    }

    public function trash()
    {
        $this->authorize('user_index');
        // return view('admin.user.index');
        return view('new-admin.user.trash');
    }

    public function datatableTrash()
    {
        $this->authorize('user_index');
        return User::datatablestrash();
    }

    public function getLoginInfo()
    {
        $info = Auth::check();
        return response()->json($info, 200);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $callback = Socialite::driver('google')->stateless()->user();
        // dd($callback['id']);

        $data = [
            'google_id' => $callback['id'],
            'first_name' => $callback['given_name'],
            'last_name' => $callback['family_name'],
            'email_google' => $callback->getEmail(),
            'avatar' => $callback->getAvatar(),
            'email_verified_at' => date('Y-m-d H:i:s', time()),
            'role_id' => 4,
            'user_code' => rand(0000000001, 9999999999)
        ];

        if (Auth::check()) {
            $connectGoogle = User::where('email', Auth::user()->email)->first();
            if ($connectGoogle) {
                $connectGoogle->update(array(
                    'email_google' => $data['email_google'],
                    'google_id' => $data['google_id'],
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'avatar' => $data['avatar'],
                ));

                Auth::login($connectGoogle, true);
                return redirect(route('login_security'))->with('successCC', 'You have been connected your Google Account.');
            }
        }

        $googleLogin = User::where('email_google', $data['email_google'])->first();
        if ($googleLogin) {
            $googleLogin->update(array(
                'google_id' => $data['google_id'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'avatar' => $data['avatar'],
            ));

            Auth::login($googleLogin, true);
            return redirect(route('index'));
        }

        $checkEmail = User::where('email', '=', $data['email_google'])->first();

        if ($checkEmail === null) {
            // email user doesn't exist
            $user = User::firstOrCreate(['email' => $data['email_google']], $data);
            Auth::login($user, true);
            return redirect(route('index'));
        } else if ($checkEmail) {
            // email exist
            $checkEmail->update(array(
                'google_id' => $data['google_id'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'avatar' => $data['avatar'],
            ));

            Auth::login($checkEmail, true);
            return redirect(route('index'));
        }
    }

    public function handleProviderCallbackFacebook()
    {
        $callback = Socialite::driver('facebook')->stateless()->user();
        // dd($callback);
        $name = $callback['name'];
        $explode = explode(" ", $name);
        $first_name_facebook = $explode[0];
        $last_name_facebook = $explode[1];

        $data = [
            'facebook_id' => $callback['id'],
            'first_name' => $first_name_facebook,
            'last_name' => $last_name_facebook,
            'email_facebook' => $callback->getEmail(),
            'avatar' => $callback->getAvatar(),
            'email_verified_at' => date('Y-m-d H:i:s', time()),
            'role_id' => 4,
            'user_code' => rand(0000000001, 9999999999)
        ];

        if (Auth::check()) {
            $connectFacebook = User::where('email', Auth::user()->email)->first();
            if ($connectFacebook) {
                $connectFacebook->update(array(
                    'email_facebook' => $data['email_facebook'],
                    'facebook_id' => $data['facebook_id'],
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'avatar' => $data['avatar'],
                ));

                Auth::login($connectFacebook, true);
                return redirect(route('login_security'))->with('successCC', 'You have been connected your Google Account.');
            }
        }

        $facebookLogin = User::where('email_facebook', $data['email_facebook'])->first();
        if ($facebookLogin) {
            $facebookLogin->update(array(
                'facebook_id' => $data['facebook_id'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'avatar' => $data['avatar'],
            ));

            Auth::login($facebookLogin, true);
            return redirect(route('index'));
        }

        $checkEmail = User::where('email', '=', $data['email_facebook'])->first();

        if ($checkEmail === null) {
            // email user doesn't exist
            $user = User::firstOrCreate(['email' => $data['email_facebook']], $data);
            Auth::login($user, true);
            return redirect(route('index'));
        } else if ($checkEmail) {
            // email exist
            $checkEmail->update(array(
                'facebook_id' => $data['facebook_id'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'avatar' => $data['avatar'],
            ));

            Auth::login($checkEmail, true);
            return redirect(route('index'));
        }
    }

    public function create()
    {
        $this->authorize('user_create');
        // return view('admin.user.create');
        $roles = Role::all();
        return view('new-admin.user.create')->with(compact('roles'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->authorize('user_create');

        $status = 500;

        try {
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role_id' => ['required', 'integer'],
            ]);

            $data = User::insert(array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'user_code' => rand(0000000001, 9999999999),
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));

            if ($data) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('admin_user')
                ->with('success', 'Your data has been submited');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function show($id)
    {
        $this->authorize('user_update');
        // $find = User::where('id', $id)->get();
        $find = User::where('id', $id)->first();
        $roles = Role::all();
        // return view('admin.user.edit', compact('find'));
        return view('new-admin.user.edit', compact('find', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('user_update');

        $status = 500;

        try {
            $find = User::where('id', $id)->first();
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['string', 'email', 'max:255'],
                'role_id' => ['required', 'integer'],
            ]);
            if ($request->email && $request->email != $find->email) {
                $find->update(array(
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'email_verify_at' => NULL,
                    'role_id' => $request->role_id,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                ));
            } else {
                $find->update(array(
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'role_id' => $request->role_id,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                ));
            }

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('admin_user')
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function softDestroy($id)
    {
        $this->authorize('user_delete');
        $status = 500;

        try {
            $find = User::where('id', $id)->first();
            $find->delete();

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('admin_user')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function restoreDestroy($id)
    {
        $this->authorize('user_delete');

        $find = User::withTrashed()->where('id', $id)->first();
        abort_if(!$find, 404);

        $restoreDeletedUser = $find->restore();

        if ($restoreDeletedUser) {
            return redirect()->route('admin_user')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('user_delete');
        $find = User::withTrashed()->where('id', $id)->first();
        abort_if(!$find, 404);

        $deletedUser = $find->forceDelete();

        if ($deletedUser) {
            return response()->json([
                'message' => 'Delete Data Successfuly',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Deleted Data',

            ], 500);
        }
    }
}
