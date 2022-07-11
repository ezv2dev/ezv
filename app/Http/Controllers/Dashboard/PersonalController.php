<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Country;

class PersonalController extends Controller
{
    public function updateName(Request $request)
    {
        // $this->authorize('user_update');

        $status = 500;

        try {
            $find = User::where('id', Auth::user()->id)->first();
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
            ]);

            $find->update(array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('personal_info')
                ->with('success', 'Your data legal name has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function updateGender(Request $request)
    {
        // $this->authorize('user_update');

        $status = 500;

        try {
            $find = User::where('id', Auth::user()->id)->first();
            $request->validate([
                'gender' => ['required', 'string', 'max:30'],
            ]);

            $find->update(array(
                'gender' => $request->gender,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('personal_info')
                ->with('success', 'Your data gender has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function updateBirthday(Request $request)
    {
        // $this->authorize('user_update');

        $status = 500;

        try {
            $find = User::where('id', Auth::user()->id)->first();
            $request->validate([
                'birthday' => ['required', 'date', 'max:30'],
            ]);

            $find->update(array(
                'birthday' => $request->birthday,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('personal_info')
                ->with('success', 'Your data birthday has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function updateEmail(Request $request)
    {
        // $this->authorize('user_update');

        $status = 500;

        try {
            $find = User::where('id', Auth::user()->id)->first();
            $request->validate([
                'email' => ['string', 'email', 'max:255'],
            ]);

            $find->update(array(
                'email' => $request->email,
                'email_verified_at' => NULL,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('personal_info')
                ->with('success', 'Your data email has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function updatePhone(Request $request)
    {
        // $this->authorize('user_update');

        $status = 500;

        try {
            $find = User::where('id', Auth::user()->id)->first();
            $request->validate([
                'phone' => ['numeric', 'max:13'],
            ]);

            $find->update(array(
                'phone' => $request->phone,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('personal_info')
                ->with('success', 'Your data phone number has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function updateAddress(Request $request)
    {
        // $this->authorize('user_update');

        $status = 500;

        try {
            $find = User::where('id', Auth::user()->id)->first();
            $request->validate([
                'address' => ['string', 'max:255'],
            ]);

            $find->update(array(
                'address' => $request->address,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ));

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('personal_info')
                ->with('success', 'Your data address has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
