<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\User;
use App\Models\Government;
use Auth;

class AddGovernmentController extends Controller
{

    public function add_government()
    {
        // dd(\App\Government::where('user_id',Auth::user()->id)->first());

        if (Government::where('user_id',Auth::user()->id)->first())
        {
            return redirect()->route('personal_info')->with('error','You have been added Government ID');
        }

        return view('new-admin.partner.account.personal-info.add_government');
    }

    public function store_step_one(Request $request)
    {
        $request->validate([
            'chooseHow' => 'required',
        ]);

        return redirect()->route('add_government.step_two');
    }

    public function step_two_index(Request $request)
    {
        $countries = Country::all();

        $government = $request->session()->get('government');

        if (Government::where('user_id',Auth::user()->id)->first())
        {
            return redirect()->route('personal_info')->with('error','You have been added Government ID');
        }

        return view('new-admin.partner.account.personal-info.add_government_step_two')
        ->with([
            'countries' => $countries,
            'government' => $government
        ]);
    }

    public function store_step_two(Request $request)
    {
        $validatedData = $request->validate([
            'chooseGovernmentID' => 'required',
            'country' => 'required',
        ]);

        // dd($validatedData);

        if(empty($request->session()->get('government'))){
            $government = new Government();
            // $government->fill($validatedData);
            $request->session()->put('government', ['chooseGovernmentID' => $request->get('chooseGovernmentID'), 'country' => $request->get('country') ]);
        }else{
            $government = $request->session()->get('government');
            // $government->fill($validatedData);
            $request->session()->put('government', ['chooseGovernmentID' => $request->get('chooseGovernmentID'), 'country' => $request->get('country') ]);
        }

        return redirect()->route('add_government.step_three');
    }

    public function step_three_index(Request $request)
    {
        $government = $request->session()->get('government');

        if (Government::where('user_id',Auth::user()->id)->first() != null)
        {
            return redirect()->route('personal_info')->with('error','You have been added Government ID');
        }

        if ($government['chooseGovernmentID'] == 'driver_license')
        {
            $title = "driver license";
        }
        else if ($government['chooseGovernmentID'] == 'identity_card')
        {
            $title = "identity card";
        }
        else {
            $title = "passport";
        }

        return view('new-admin.partner.account.personal-info.add_government_step_three')
        ->with([
            "government" => $government,
            "title" => $title
        ]);
    }

    public function store_step_three(Request $request)
    {
        $government = $request->session()->get('government');

        $type = $request->session()->get('government')['chooseGovernmentID'];

        $countries = $request->session()->get('government')['country'];

        $request->validate([
            'no_id' => 'required|numeric',
        ]);

        if($request->file('front_picture'))
        {
            $request->validate([
                'front_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            ]);
            $front_picture = $request->file('front_picture');
            $filenameFrontPicture = time() . '.' . $front_picture->getClientOriginalExtension();
            $front_picture->move(public_path('government'),$filenameFrontPicture);
        }

        if($request->file('back_picture'))
        {
            $request->validate([
                'back_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            ]);
            $back_picture = $request->file('back_picture');
            $filenameBackPicture = time() . '.' . $back_picture->getClientOriginalExtension();
            $back_picture->move(public_path('government'),$filenameBackPicture);
        }

        if ($government['chooseGovernmentID'] == 'passport')
        {
            if(!isset($filenameFrontPicture))
            {
                return redirect()->back();
            }

            $storeGovernmentID = Government::create([
                'no_id' => $request->no_id,
                'front_picture' => $filenameFrontPicture,
                // 'back_picture' => $filenameBackPicture,
                'type' => $type,
                'id_countries' => $countries,
                'user_id' => Auth::user()->id,
                'approved_status' => 0,
            ]);
        }
        else
        {
            if(!isset($filenameFrontPicture) && !isset($filenameBackPicture))
            {
                return redirect()->back();
            }

            $storeGovernmentID = Government::create([
                'no_id' => $request->no_id,
                'front_picture' => $filenameFrontPicture,
                'back_picture' => $filenameBackPicture,
                'type' => $type,
                'id_countries' => $countries,
                'user_id' => Auth::user()->id,
                'approved_status' => 0,
            ]);
        }

        $request->session()->forget('government');

        return redirect()->route('personal_info')->with('success','Successfuly Added Government ID');
    }
}
