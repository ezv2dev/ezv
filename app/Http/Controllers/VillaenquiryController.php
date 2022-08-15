<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Villa;
use App\Models\VillaEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VillaenquiryController extends Controller
{
    public function store(Request $request)
    {
        $email = "tangkas@ezvillasbali.com";
        if(Auth::user())
        {
            $user = User::where('id', $request->id_user)->first();
        }else{
            $user = User::where('email', $request->email)->first();
            if(!$user)
            {
                $user = User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'role_id' => 4,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                ]);
            }
        }

        $enquiry = VillaEnquiry::create([
            'id_villa' => $request->id_villa,
            'adult' => $request->adult,
            'child' => $request->child,
            'infant' => $request->infant,
            'pet' => $request->pet,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'id_user' => $user->id,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
        ]);

        $villa = Villa::where('id_villa', $request->id_villa)->first();

        $details = [
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'adult' => $request->adult,
            'child' => $request->child,
            'infant' => $request->infant,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'villa_name' => $villa->original_name,
        ];

        \Mail::to($email)->send(new \App\Mail\VillaEnquiry($details));

        if ($enquiry) {
            return response()->json([
                'message' => 'Enquiry Successfully, We will contact you soon.',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Enquiry Failed',
                'status' => 500,
            ], 500);
        }

    }
}
