<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Collaborator;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterCollabController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */


    // protected $redirectTo = '/collaborator-list';

    protected function redirectTo()
    {
        $collab_id = Collaborator::where('created_by', Auth::user()->id)->select('id_collab')->first();
        $link = '/collaborator/' . $collab_id->id_collab;
        return $link;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // roles options
        $roles = [
            5, // partner
        ];

        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'role_id' => 5,
            'user_code' => rand(0000000001, 9999999999),
            'password' => Hash::make($data['password']),
        ]);

        Collaborator::create([
            'uid' => rand(0000000001, 9999999999),
            'status' => 0,
            'email' => $user->email,
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);

        return $user;
    }

    protected function landingpage()
    {
        return view('admin.add_listing.hostpage');
    }

    protected function showRegistrationForm(Request $request)
    {
        return view('auth.register-collabs');
    }
}
