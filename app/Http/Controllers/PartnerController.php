<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Villa;
use App\Models\Restaurant;
use App\Models\Activity;
use App\Models\Hotel;
use App\Models\NotificationOwner;
use App\Models\User;
use DB;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villa = Villa::where('created_by', Auth::user()->id)->count();
        $restaurant = Restaurant::where('created_by', Auth::user()->id)->count();
        $activity = Activity::where('created_by', Auth::user()->id)->count();
        $hotel = Hotel::where('created_by', Auth::user()->id)->count();

        $today = Villa::where('status', '=', 0)->where('created_by', Auth::id())->limit(3)->get();

        $count = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            ->where('villa_booking.created_by', Auth::user()->id)
            ->where('villa_booking.status', 0)->count();

        $arrivingSoon = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //today or tomorrow
            ->where('villa_booking.check_in', '=', Carbon::now()->format('Y-m-d'))
            ->orWhere('villa_booking.check_in', '=', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.created_by', Auth::user()->id)
            ->where('villa_booking.status', 0)->count();

        $upcoming = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //after tomorrow or upcoming
            // ->where('villa_booking.check_in','=', Carbon::now()->format('Y-m-d'))
            ->where('villa_booking.check_in', '>', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.status', 0)
            ->where('villa_booking.created_by', Auth::user()->id)
            ->count();

        $checkout = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //after tomorrow or upcoming
            ->where('villa_booking.check_out', '=', Carbon::now()->format('Y-m-d'))
            ->orWhere('villa_booking.check_out', '=', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.status', 0)
            ->where('villa_booking.created_by', Auth::user()->id)
            ->count();


        if ($villa > 0 || $restaurant > 0 || $activity > 0 || $hotel > 0 || Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            return view('new-admin.partner.dashboard_partner', compact('today', 'count', 'arrivingSoon', 'upcoming', 'checkout'));
        }
        if (Auth::user()->role_id == 5) {
            return view('new-admin.collaborator.dashboard_collaborator', compact('today', 'count', 'arrivingSoon', 'upcoming', 'checkout'));
        } else {
            return redirect()->route('admin_add_listing');
        }
    }

    public function index2()
    {
        $villa = Villa::where('created_by', Auth::user()->id)->count();
        $restaurant = Restaurant::where('created_by', Auth::user()->id)->count();
        $activity = Activity::where('created_by', Auth::user()->id)->count();
        $hotel = Hotel::where('created_by', Auth::user()->id)->count();

        $today = Villa::where('status', '=', 0)->where('created_by', Auth::id())->limit(3)->get();

        $count = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            ->where('villa_booking.created_by', Auth::user()->id)
            ->where('villa_booking.status', 0)->count();

        $arrivingSoon = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //today or tomorrow
            ->where('villa_booking.check_in', '=', Carbon::now()->format('Y-m-d'))
            ->orWhere('villa_booking.check_in', '=', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.created_by', Auth::user()->id)
            ->where('villa_booking.status', 0)->count();

        $upcoming = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //after tomorrow or upcoming
            // ->where('villa_booking.check_in','=', Carbon::now()->format('Y-m-d'))
            ->where('villa_booking.check_in', '>', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.status', 0)
            ->where('villa_booking.created_by', Auth::user()->id)
            ->count();

        $checkout = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //after tomorrow or upcoming
            ->where('villa_booking.check_out', '=', Carbon::now()->format('Y-m-d'))
            ->orWhere('villa_booking.check_out', '=', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.status', 0)
            ->where('villa_booking.created_by', Auth::user()->id)
            ->count();

        if ($villa > 0 || $restaurant > 0 || $activity > 0 || $hotel > 0 || Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            // dd($count);
            return view('new-admin.partner.dashboard_partner_arriving_soon', compact('today', 'count', 'arrivingSoon', 'upcoming', 'checkout'));
        } else {
            return redirect()->route('admin_add_listing');
        }
    }

    public function index3()
    {
        $villa = Villa::where('created_by', Auth::user()->id)->count();
        $restaurant = Restaurant::where('created_by', Auth::user()->id)->count();
        $activity = Activity::where('created_by', Auth::user()->id)->count();
        $hotel = Hotel::where('created_by', Auth::user()->id)->count();

        $today = Villa::where('status', '=', 0)->where('created_by', Auth::id())->limit(3)->get();

        $count = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            ->where('villa_booking.created_by', Auth::user()->id)
            ->where('villa_booking.status', 0)->count();

        $arrivingSoon = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //today or tomorrow
            ->where('villa_booking.check_in', '=', Carbon::now()->format('Y-m-d'))
            ->orWhere('villa_booking.check_in', '=', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.status', 0)
            ->where('villa_booking.created_by', Auth::user()->id)->count();

        $upcoming = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //after tomorrow or upcoming
            // ->where('villa_booking.check_in','=', Carbon::now()->format('Y-m-d'))
            ->where('villa_booking.check_in', '>', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.status', 0)
            ->where('villa_booking.created_by', Auth::user()->id)
            ->count();

        $checkout = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //after tomorrow or upcoming
            ->where('villa_booking.check_out', '=', Carbon::now()->format('Y-m-d'))
            ->orWhere('villa_booking.check_out', '=', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.created_by', Auth::user()->id)
            ->where('villa_booking.status', 0)
            ->count();

        if ($villa > 0 || $restaurant > 0 || $activity > 0 || $hotel > 0 || Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            // dd($count);
            return view('new-admin.partner.dashboard_partner_checkout', compact('today', 'count', 'arrivingSoon', 'upcoming', 'checkout'));
        } else {
            return redirect()->route('admin_add_listing');
        }
    }

    public function index4()
    {
        $villa = Villa::where('created_by', Auth::user()->id)->count();
        $restaurant = Restaurant::where('created_by', Auth::user()->id)->count();
        $activity = Activity::where('created_by', Auth::user()->id)->count();
        $hotel = Hotel::where('created_by', Auth::user()->id)->count();

        $today = Villa::where('status', '=', 0)->where('created_by', Auth::id())->limit(3)->get();

        $count = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            ->where('villa_booking.created_by', Auth::user()->id)
            ->where('villa_booking.status', 0)->count();

        $arrivingSoon = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //today or tomorrow
            ->where('villa_booking.check_in', '=', Carbon::now()->format('Y-m-d'))
            ->orWhere('villa_booking.check_in', '=', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.created_by', Auth::user()->id)
            ->where('villa_booking.status', 0)->count();

        $upcoming = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //after tomorrow or upcoming
            // ->where('villa_booking.check_in','=', Carbon::now()->format('Y-m-d'))
            ->where('villa_booking.check_in', '>', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.status', 0)
            ->where('villa_booking.created_by', Auth::user()->id)
            ->count();

        $checkout = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //after tomorrow or upcoming
            ->where('villa_booking.check_out', '=', Carbon::now()->format('Y-m-d'))
            ->orWhere('villa_booking.check_out', '=', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.status', 0)
            ->where('villa_booking.created_by', Auth::user()->id)
            ->count();

        if ($villa > 0 || $restaurant > 0 || $activity > 0 || $hotel > 0 || Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            // dd($count);
            return view('new-admin.partner.dashboard_partner_upcoming', compact('today', 'count', 'arrivingSoon', 'upcoming', 'checkout'));
        } else {
            return redirect()->route('admin_add_listing');
        }
    }

    public function switch()
    {
        $findUser = User::where('id', Auth::user()->id)->first();
        $findUser->update(array('role_id' => 3));

        $today = Villa::where('status', '=', 0)->where('created_by', Auth::id())->limit(3)->get();

        $count = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            ->where('villa_booking.created_by', Auth::user()->id)
            ->where('villa_booking.status', 0)->count();

        $arrivingSoon = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //today or tomorrow
            ->where('villa_booking.check_in', '=', Carbon::now()->format('Y-m-d'))
            ->orWhere('villa_booking.check_in', '=', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.created_by', Auth::user()->id)
            ->where('villa_booking.status', 0)->count();

        $upcoming = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //after tomorrow or upcoming
            // ->where('villa_booking.check_in','=', Carbon::now()->format('Y-m-d'))
            ->where('villa_booking.check_in', '>', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.status', 0)
            ->where('villa_booking.created_by', Auth::user()->id)
            ->count();

        $checkout = DB::table('villa_booking')
            ->select('villa_booking.*', 'villa.name as name_villa')
            ->join('villa', 'villa_booking.id_villa', '=', 'villa.id_villa', 'left')
            //after tomorrow or upcoming
            ->where('villa_booking.check_out', '=', Carbon::now()->format('Y-m-d'))
            ->orWhere('villa_booking.check_out', '=', Carbon::tomorrow()->format('Y-m-d'))
            ->where('villa_booking.status', 0)
            ->where('villa_booking.created_by', Auth::user()->id)
            ->count();

        return view('new-admin.partner.dashboard_partner', compact('today', 'count', 'arrivingSoon', 'upcoming', 'checkout'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
