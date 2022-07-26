<?php

namespace App\Http\Controllers\Map;

use App\Models\Activity;
use App\Models\Hotel;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Villa;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class LocationByCoordinateAreaController extends Controller
{
    public function restaurant(Request $request)
    {
        $restaurant = Restaurant::with([
                'location','cuisine','detailReview','menu','photo','video'
            ])
            ->whereBetween('latitude', [$request->latitude_h, $request->latitude_j])
            ->whereBetween('longitude', [$request->longitude_h, $request->longitude_j])
            ->where('status', 1)
            ->orderBy('id_restaurant')
            ->orderBy('grade')
            ->limit(env('LIMIT_MARKER_MAP_RESTAURANT') ?? 5)
            ->get();
        if($restaurant) {
            $restaurant->each(function ($item, $key) {
                $item->setAppends(['is_favorit']);
            });
            return $restaurant->makeHidden(['created_by', 'created_at', 'updated_by', 'updated_by', 'deleted_at']);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
    public function villa(Request $request)
    {
        $villa = Villa::with([
                'photo', 'video', 'detailReview', 'propertyType', 'location'
            ])
            ->whereBetween('latitude', [$request->latitude_h, $request->latitude_j])
            ->whereBetween('longitude', [$request->longitude_h, $request->longitude_j])
            ->where('status', 1)
            ->orderBy('id_villa')
            ->orderBy('grade')
            ->limit(env('LIMIT_MARKER_MAP_VILLA') ?? 5)
            ->get();
        if($villa) {
            $villa->each(function ($item, $key) {
                $item->setAppends(['price_with_exchange_unit', 'is_favorit']);
            });
            return $villa->makeHidden(['created_by', 'created_at', 'updated_by', 'updated_by', 'deleted_at']);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
    public function hotel(Request $request)
    {
        $hotel = Hotel::with([
                'photo','video'
            ])
            ->whereBetween('latitude', [$request->latitude_h, $request->latitude_j])
            ->whereBetween('longitude', [$request->longitude_h, $request->longitude_j])
            ->where('status', 1)
            ->orderBy('id_hotel')
            ->limit(env('LIMIT_MARKER_MAP_HOTEL') ?? 5)
            ->get();
        if($hotel) {
            $hotel->each(function ($item, $key) {
                $item->setAppends(['is_favorit']);
            });
            return $hotel->makeHidden(['created_by', 'created_at', 'updated_by', 'updated_by', 'deleted_at']);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
    public function activity(Request $request)
    {
        $activity = Activity::with([
                'video', 'photo', 'facilities', 'location', 'detailReview'
            ])
            ->whereBetween('latitude', [$request->latitude_h, $request->latitude_j])
            ->whereBetween('longitude', [$request->longitude_h, $request->longitude_j])
            ->where('status', 1)
            ->orderBy('id_activity')
            ->orderBy('grade')
            ->limit(env('LIMIT_MARKER_MAP_ACTIVITY') ?? 5)
            ->get();
        if($activity) {
            $activity->each(function ($item, $key) {
                $item->setAppends(['is_favorit']);
            });
            return $activity->makeHidden(['created_by', 'created_at', 'updated_by', 'updated_by', 'deleted_at']);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function search_restaurant(Request $request)
    {
        $restaurant = Restaurant::with([
            'location','cuisine','detailReview','menu','photo','video'
        ])->where('id_restaurant', $request->id)->first();

        if(auth()->check()){
            if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->id == $restaurant->created_by)
            {
                $restaurant = Restaurant::with([
                    'location','cuisine','detailReview','menu','photo','video'
                ])->where('id_restaurant', $request->id)->first();
            }else{
                $restaurant = Restaurant::with([
                    'location','cuisine','detailReview','menu','photo','video'
                ])->where('id_restaurant', $request->id)->where('status', 1)->first();
            }
        }else{
            $restaurant = Restaurant::with([
                'location','cuisine','detailReview','menu','photo','video'
            ])->where('id_restaurant', $request->id)->where('status', 1)->first();
        }

        if($restaurant) {
            $restaurant->setAppends(['is_favorit']);
            return $restaurant->makeHidden(['created_by', 'created_at', 'updated_by', 'updated_by', 'deleted_at']);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
    public function search_villa(Request $request)
    {
        $villa = Villa::with([
            'photo', 'video', 'detailReview', 'propertyType', 'location'
        ])->where('id_villa', $request->id)->first();

        if(auth()->check()) {
            if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 ||  Auth::user()->id == $villa->created_by)
            {
                $villa = Villa::with([
                    'photo', 'video', 'detailReview', 'propertyType', 'location'
                ])->where('id_villa', $request->id)->first();
            }else{
                $villa = Villa::with([
                    'photo', 'video', 'detailReview', 'propertyType', 'location'
                ])->where('id_villa', $request->id)->where('status', 1)->first();
            }
        }else{
            $villa = Villa::with([
                'photo', 'video', 'detailReview', 'propertyType', 'location'
            ])->where('id_villa', $request->id)->where('status', 1)->first();
        }

        if($villa) {
            $villa->setAppends(['price_with_exchange_unit', 'is_favorit']);
            return $villa->makeHidden(['created_by', 'created_at', 'updated_by', 'updated_by', 'deleted_at']);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
    public function search_hotel(Request $request)
    {
        $hotel = hotel::with([
            'photo', 'video', 'detailReview', 'location'
        ])->where('id_hotel', $request->id)->first();

        if(auth()->check()){
            if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->id == $hotel->created_by)
            {
                $hotel = hotel::with([
                    'photo', 'video', 'detailReview', 'location'
                ])->where('id_hotel', $request->id)->first();
            }else{
                $hotel = hotel::with([
                    'photo', 'video', 'detailReview', 'location'
                ])->where('id_hotel', $request->id)->where('status', 1)->first();
            }
        }else{
            $hotel = hotel::with([
                'photo', 'video', 'detailReview', 'location'
            ])->where('id_hotel', $request->id)->where('status', 1)->first();
        }

        if($hotel) {
            $hotel->setAppends(['is_favorit']);
            return $hotel->makeHidden(['created_by', 'created_at', 'updated_by', 'updated_by', 'deleted_at']);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
    public function search_activity(Request $request)
    {
        $activity = Activity::with([
            'video', 'photo', 'facilities', 'location', 'detailReview'
        ])->where('id_activity', $request->id)->first();

        if(auth()->check()){
            if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->id == $activity->created_by)
            {
                $activity = Activity::with([
                    'video', 'photo', 'facilities', 'location', 'detailReview'
                ])->where('id_activity', $request->id)->first();
            }else{
                $activity = Activity::with([
                    'video', 'photo', 'facilities', 'location', 'detailReview'
                ])->where('id_activity', $request->id)->where('status', 1)->first();
            }
        }else{
            $activity = Activity::with([
                'video', 'photo', 'facilities', 'location', 'detailReview'
            ])->where('id_activity', $request->id)->where('status', 1)->first();
        }

        if($activity) {
            $activity->setAppends(['is_favorit']);
            return $activity->makeHidden(['created_by', 'created_at', 'updated_by', 'updated_by', 'deleted_at']);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}
