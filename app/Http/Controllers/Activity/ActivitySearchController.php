<?php

namespace App\Http\Controllers\Activity;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\ActivityFacilities;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Amenities;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ActivityHasFacilities;
use App\Models\ActivityHasSubcategory;
use App\Models\ActivitySubcategory;
use App\Models\PropertyTypeVilla;
use App\Models\Villa;
use Illuminate\Database\Eloquent\Collection;
use App\Services\DeviceCheckService;

class ActivitySearchController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $activity = Activity::with([
            'photo',
            'video',
            'detailReview',
            'facilities',
        ])->where('status', 1)->get();
        $amenities = Amenities::all();
        $facilities = ActivityFacilities::all();
        $categories = ActivityCategory::all();
        $property_type = PropertyTypeVilla::all();

        $sLocation = $request->sLocation;
        $sKeyword = $request->sKeyword;
        $sDate = $request->sDate;

        if ($sLocation || $sKeyword || $sDate) {
            $activity = $this->search($activity, $request);
        }

        $fCategory = $request->fCategory;
        $fTimeofday = $request->fTimeofday;
        $fFacilities = $request->fFacilities;
        if ($fCategory || $fTimeofday || $fFacilities) {
            $activity = $this->filter($activity, $request);
            // dd($activity);
        }

        $activityIds = $activity->modelKeys();
        $activity = Activity::with([
            'video',
            'photo',
            'detailReview',
            'facilities'
        ])->whereIn('id_activity', $activityIds)->orderBy('grade')->paginate(env('CONTENT_PER_PAGE_LIST_ACTIVITY'));
        $activity->each(function ($item, $key) {
            $item->setAppends(['villa_nearby', 'restaurant_nearby', 'hotel_nearby']);
        });
        $activity->appends(request()->query());

        $i = 0;
        $j = 0;
        $near = array();
        foreach ($activity as $item) {
            $villa = Villa::where('id_location', $item->id_location)->select('name', 'latitude', 'longitude', 'id_location')->get();
            if (count($villa) == 0) {
                $villa = Villa::where('id_villa', 14)->select('name', 'latitude', 'longitude', 'id_location')->get();
            }

            $point1 = array('lat' => $item->latitude, 'long' => $item->longitude, 'name' => $item->name);

            foreach ($villa as $item2) {
                $lat1 = $point1['lat'];
                $lon1 = $point1['long'];
                $lat2 = $item2->latitude;
                $lon2 = $item2->longitude;
                $name = $item2->name;
                $theta = $lon1 - $lon2;

                $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
                $miles = acos($miles);
                $miles = rad2deg($miles);
                $miles = $miles * 60 * 1.1515;
                $kilometers[$i][] = ($miles * 1.609344 / 40) * 60;
                $kilometers[$i][] = $name;

                if ($near == null) {
                    $near[0] = $kilometers[$i];
                } else {
                    if ($kilometers[$i][0] <= $near[0][0]) {
                        $near[0] = $kilometers[$i];
                    }
                }
                $i++;
            }

            $activity[$j]['time'] = $near[0][0];
            $activity[$j]['villa'] = $near[0][1];

            $j++;
            $near = [];
        }

        $subCategory = ActivitySubcategory::where('id_category', $fCategory)->inRandomOrder()->get();
        $categories = ActivityCategory::all();

        return view('user.list_activity_search', compact('activity', 'amenities', 'facilities', 'categories', 'property_type', 'categories', 'subCategory'));
    }

    private function search($activities, $request)
    {
        // dd($request->all());
        $activity = $activities;

        $sLocation = $request->sLocation;
        $sKeyword = $request->sKeyword;
        $sDate = $request->sDate;

        // dd($sLocation, $sKeyword, $sCuisine);
        if ($sLocation) {
            $location = $sLocation;
            // * get latitude & longitude dari nama yang diinput user
            $latitude = Location::select('latitude', 'id_location')->where('name', 'like', '%' . $location . '%')->first();
            $longitude = Location::select('longitude', 'id_location')->where('name', 'like', '%' . $location . '%')->first();
            // dd($longitude, $latitude);
            // *if latitude & longitude is null
            if (!$latitude || !$longitude) {
                // dd('long or lang is null');
                $activity = collect([]);
                return $activity;
            };

            // * get latitude & longitude dari array
            $get_latitude = $latitude->latitude;
            $get_longitude = $longitude->longitude;

            // * get latitude and longitude data lainnya
            $get_latitude_others = DB::table('location')->whereNotIn('latitude', [$get_latitude])->select('latitude', 'id_location')->get();
            $get_longitude_others = DB::table('location')->whereNotIn('longitude', [$get_longitude])->select('longitude', 'id_location')->get();

            // *if latitude & longitude others is null
            if (!$get_latitude_others || !$get_longitude_others) {
                // dd('long or lang is null');
                $activity = collect([]);
                return $activity;
            };

            // dd($get_latitude_others, $get_longitude_others);
            $get_lat_long_others = DB::table('location')
                ->whereNotIn('latitude', [$get_latitude])
                ->whereNotIn('longitude', [$get_longitude])
                ->select('latitude', 'longitude', 'id_location')
                ->get();

            // * get id location
            $id_location = DB::table('location')->where('latitude', $get_latitude)->value('id_location');

            $point1 = array('lat' => $get_latitude, 'long' => $get_longitude, 'id_location');
            // $point2 = array('lat2' => $get_latitude_others, 'long2' => $get_longitude_others);
            // dd($point2);

            $kilometers[] = array();
            $i = 0;
            foreach ($get_lat_long_others as $item) {
                $lat1 = $point1['lat'];
                $lon1 = $point1['long'];
                $lat2 = $item->latitude;
                $lon2 = $item->longitude;
                $id_location_near = $item->id_location;
                $theta = $lon1 - $lon2;

                $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
                $miles = acos($miles);
                $miles = rad2deg($miles);
                $miles = $miles * 60 * 1.1515;
                $kilometers[$i][] = $miles * 1.609344;
                $kilometers[$i][] = $id_location_near;
                $i++;
            }

            $unsorted_data = collect($kilometers);
            $data = $unsorted_data->sortBy('0')->first();

            $activityIds = $activity->modelKeys();

            $activityAround = Activity::where('status', 1)
                ->whereIn('id_activity', $activityIds)
                ->where('id_location', $data[1])
                ->get();

            $activityOther = Activity::where('status', 1)
                ->whereIn('id_activity', $activityIds)
                ->whereHas('location', function (Builder $query) use ($location) {
                    $query->where('name', 'like', '%' . $location . '%');
                })
                ->get();
            // dd($data[1], $activityAround, $activityOther);
            $activity = new Collection();
            $activity = $activity->merge($activityAround)->merge($activityOther);
        }

        if ($sKeyword) {
            $activityIds = $activity->modelKeys();
            $activity = Activity::where('status', 1)
                ->whereIn('id_activity', $activityIds)
                ->where('name', 'like', '%' . $sKeyword . '%')
                ->get();
        }

        if ($sDate) {
            $explodeDate = explode(' to ', $request->sDate);
            $startDate = $explodeDate[0];
            $endDate = $explodeDate[1];
            // dd($startDate, $endDate);

            $activityIds = $activity->modelKeys();
            $activity = Activity::where('status', 1)
                ->whereIn('activity.id_activity', $activityIds)
                ->join('activity_price', 'activity.id_activity', '=', 'activity_price.id_activity', 'left')
                ->whereIn('activity.id_activity', function ($query) use ($startDate, $endDate) {
                    $query->from('activity_price')->select('id_activity')
                        ->where('start_date', '>=', $startDate)
                        ->where('end_date', '<=', $endDate);
                })
                ->get();
        }

        // dd($activity);
        return $activity;
    }

    private function filter($activities, $request)
    {
        // dd($request->all());

        $activity = $activities;
        if ($request->fCategory) {
            $category = explode(',', $request->fCategory);

            $activityIds = $activity->modelKeys();

            $subcategoryOfCategoryIds = ActivitySubcategory::whereIn('id_category', $category)->select('id_subcategory')->get();
            $activityIdsFilter = ActivityHasSubcategory::whereIn('id_subcategory', $subcategoryOfCategoryIds)->select('id_activity')->get();

            $activity = Activity::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_activity', $activityIds)
                ->whereIn('id_activity', $activityIdsFilter)
                ->where('status', 1)
                ->get();
        }
        if ($request->fTimeofday) {
            $timeofday = explode(',', $request->fTimeofday);
            $checkMorning = in_array('morning', $timeofday);
            $checkAfternoon = in_array('afternoon', $timeofday);
            $checkEvening = in_array('evening', $timeofday);
            // dd($timeofday);
            $activityIds = $activity->modelKeys();
            // find morning activity
            $listActivityInMorning = [];
            if ($checkMorning) {
                $listActivityInMorning = Activity::with([
                    'photo',
                    'video',
                    'detailReview',
                    'facilities',
                ])
                    ->whereIn('id_activity', $activityIds)
                    ->whereBetween('open_time', ['06:00:01', '12:00:00'])
                    ->where('status', 1)
                    ->get();
            }
            // find afternoon activity
            $listActivityInAfternoon = [];
            if ($checkAfternoon) {
                $listActivityInAfternoon = Activity::with([
                    'photo',
                    'video',
                    'detailReview',
                    'facilities',
                ])
                    ->whereIn('id_activity', $activityIds)
                    ->whereBetween('open_time', ['12:00:01', '17:00:00'])
                    ->where('status', 1)
                    ->get();
            }
            // find evening activity
            $listActivityInEvening = [];
            if ($checkEvening) {
                $listActivityInEvening = Activity::with([
                    'photo',
                    'video',
                    'detailReview',
                    'facilities',
                ])
                    ->whereIn('id_activity', $activityIds)
                    ->whereBetween('open_time', ['17:00:01', '23:59:59'])
                    ->orWhereBetween('open_time', ['00:00:00', '06:00:00'])
                    ->where('status', 1)
                    ->get();
            }
            // collect all data into 1 collection activity
            $activity = new Collection();
            $activity = $activity->concat($listActivityInMorning)->concat($listActivityInAfternoon)->concat($listActivityInEvening);

            // dd($activity);
        }
        if ($request->fFacilities) {
            $facilities = explode(',', $request->fFacilities);
            $activityIds = $activity->modelKeys();

            $activityIdsFilter = ActivityHasFacilities::whereIn('id_facilities', $facilities)->select('id_activity')->get();
            $activity = Activity::with([
                'photo',
                'video',
                'detailReview',
                'facilities',
            ])
                ->whereIn('id_activity', $activityIds)
                ->whereIn('id_activity', $activityIdsFilter)
                ->where('status', 1)
                ->get();
            // dd($activity);
        }
        // dd($activity);
        return $activity;
    }
}
