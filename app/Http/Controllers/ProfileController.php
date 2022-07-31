<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivitySave;
use App\Models\Hotel;
use App\Models\HotelSave;
use App\Models\Location;
use App\Models\Restaurant;
use App\Models\RestaurantSave;
use App\Models\User;
use App\Models\UserRewardBalance;
use App\Models\Villa;
use App\Models\VillaPhoto;
use App\Models\VillaSave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::get();
        $villa = Villa::where('status', 1)->get();

        $location = VillaSave::select('location.name', 'location.id_location as id_cek')->join('villa', 'villa_save.id_villa', '=', 'villa.id_villa')
            ->join('location', 'villa.id_location', '=', 'location.id_location')->where('id_user', Auth::user()->id)->groupBy('id_cek')->get();

        // $location = VillaSave::with(['villa.location'])->where('id_user', Auth::user()->id)->get();

        // dd($location, $location2);

        $save = VillaSave::join('villa', 'villa_save.id_villa', '=', 'villa.id_villa')
            ->where('id_user', Auth::user()->id)->get();

        $balance = UserRewardBalance::join('user_reward', 'user_reward_balance.id_user_reward', '=', 'user_reward.id_user_reward')
            ->where('user_reward.id_user', Auth::user()->id)
            ->get();

        $sumArray = 0;

        foreach ($balance as $item) {
            $sumArray += $item->balance;
        }

        return view('user.profile.user-profile', compact('user', 'save', 'location', 'villa', 'balance', 'sumArray'));
    }

    public function hotels()
    {
        $user = User::get();
        $hotel = Hotel::where('status', 1)->get();

        $location = HotelSave::select('location.name', 'location.id_location as id_cek')->join('hotel', 'hotel_save.id_hotel', '=', 'hotel.id_hotel')
            ->join('location', 'hotel.id_location', '=', 'location.id_location')->where('id_user', Auth::user()->id)->groupBy('id_cek')->get();

        $save = HotelSave::join('hotel', 'hotel_save.id_hotel', '=', 'hotel.id_hotel')
            ->where('id_user', Auth::user()->id)->get();

        $balance = UserRewardBalance::join('user_reward', 'user_reward_balance.id_user_reward', '=', 'user_reward.id_user_reward')
            ->where('user_reward.id_user', Auth::user()->id)
            ->get();

        $sumArray = 0;

        foreach ($balance as $item) {
            $sumArray += $item->balance;
        }

        return view('user.profile.user-profile-hotels', compact('user', 'save', 'location', 'hotel', 'balance', 'sumArray'));
    }

    public function restaurants()
    {
        $user = User::get();
        $restaurant = Restaurant::where('status', 1)->get();

        $location = RestaurantSave::select('location.name', 'location.id_location as id_cek')->join('restaurant', 'restaurant_save.id_restaurant', '=', 'restaurant.id_restaurant')
            ->join('location', 'restaurant.id_location', '=', 'location.id_location')->where('id_user', Auth::user()->id)->groupBy('id_cek')->get();

        $save = RestaurantSave::join('restaurant', 'restaurant_save.id_restaurant', '=', 'restaurant.id_restaurant')
            ->where('id_user', Auth::user()->id)->get();

        $balance = UserRewardBalance::join('user_reward', 'user_reward_balance.id_user_reward', '=', 'user_reward.id_user_reward')
            ->where('user_reward.id_user', Auth::user()->id)
            ->get();

        $sumArray = 0;

        foreach ($balance as $item) {
            $sumArray += $item->balance;
        }

        return view('user.profile.user-profile-restaurants', compact('user', 'save', 'location', 'restaurant', 'balance', 'sumArray'));
    }

    public function activities()
    {
        $user = User::get();
        $activity = Activity::where('status', 1)->get();

        $location = ActivitySave::select('location.name', 'location.id_location as id_cek')->join('activity', 'activity_save.id_activity', '=', 'activity.id_activity')
            ->join('location', 'activity.id_location', '=', 'location.id_location')->where('id_user', Auth::user()->id)->groupBy('id_cek')->get();

        $save = ActivitySave::join('activity', 'activity_save.id_activity', '=', 'activity.id_activity')
            ->where('id_user', Auth::user()->id)->get();

        $balance = UserRewardBalance::join('user_reward', 'user_reward_balance.id_user_reward', '=', 'user_reward.id_user_reward')
            ->where('user_reward.id_user', Auth::user()->id)
            ->get();

        $sumArray = 0;

        foreach ($balance as $item) {
            $sumArray += $item->balance;
        }

        return view('user.profile.user-profile-things-to-do', compact('user', 'save', 'location', 'activity', 'balance', 'sumArray'));
    }

    public function index_backup()
    {
        $user = User::get();
        $villa = Villa::get();
        $save = VillaSave::get();
        $location = Villa::select('location.name', 'location.id_location')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
            ->join('villa_save', 'villa.id_villa', '=', 'villa_save.id_villa', 'left')
            ->where('id_user', Auth::user()->id)->get();


        return view('user.profile.user-profile-backup-fix', compact('user', 'save', 'location', 'villa'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $user->update();
        return redirect()->back();
    }

    public function reward_program()
    {
        $balance = UserRewardBalance::join('user_reward', 'user_reward_balance.id_user_reward', '=', 'user_reward.id_user_reward')
            ->where('user_reward.id_user', Auth::user()->id)
            ->get();

        return view('user.profile.reward-profile', compact('balance'));
    }
}
