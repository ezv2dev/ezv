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

class WowSearchController extends Controller
{
    public function index(Request $request)
    {
        $activity = Activity::with([
            'photo',
            'video',
            'detailReview',
            'facilities',
        ])->where('status', 1)->get();

        $categories = ActivityCategory::all();

        $sLocation = $request->sLocation;
        $sKeyword = $request->sKeyword;
        $sStart = $request->sStart;
        $sEnd = $request->sEnd;
        $fCategory = $request->fCategory;
        $fSubCategory = $request->fSubCategory;

        if ($sLocation || $sKeyword || $sStart || $sEnd) {
            $activity = $this->search($activity, $request);
        }

        if ($fCategory || $fSubCategory) {
            $activity = $this->filter($activity, $request);
        }

        $activityIds = $activity->modelKeys();

        $activity = Activity::with([
            'video',
            'photo',
            'detailReview',
            'facilities'
        ])->whereIn('id_activity', $activityIds)->orderBy('grade')->paginate(env('CONTENT_PER_PAGE_LIST_ACTIVITY'));

        $subCategory = ActivitySubcategory::where('id_category', $fCategory)->get();
        $subCategoryAll = ActivitySubcategory::all();

        return view('user.list_activity', compact('activity', 'categories', 'subCategory', 'subCategoryAll'));
    }

    private function search($activities, $request)
    {
        $activity = $activities;

        $sLocation = $request->sLocation;
        $sKeyword = $request->sKeyword;
        $sStart = $request->sStart;
        $sEnd = $request->sEnd;

        if ($sLocation) {
            $location = $sLocation;
            // * get latitude & longitude dari nama yang diinput user
            $latitude = Location::select('latitude', 'id_location')->where('name', 'like', '%' . $location . '%')->first();
            $longitude = Location::select('longitude', 'id_location')->where('name', 'like', '%' . $location . '%')->first();

            // *if latitude & longitude is null
            if (!$latitude || !$longitude) {
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
                $activity = collect([]);
                return $activity;
            };

            $get_lat_long_others = DB::table('location')
                ->whereNotIn('latitude', [$get_latitude])
                ->whereNotIn('longitude', [$get_longitude])
                ->select('latitude', 'longitude', 'id_location')
                ->get();

            $point1 = array('lat' => $get_latitude, 'long' => $get_longitude, 'id_location');
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

        if ($sStart && $sEnd) {
            $activityIds = $activity->modelKeys();
            $activity = Activity::where('status', 1)
                ->whereIn('activity.id_activity', $activityIds)
                ->join('activity_price', 'activity.id_activity', '=', 'activity_price.id_activity', 'left')
                ->whereIn('activity.id_activity', function ($query) use ($sStart, $sEnd) {
                    $query->from('activity_price')->select('id_activity')
                        ->where('start_date', '>=', $sStart)
                        ->where('end_date', '<=', $sEnd);
                })
                ->get();
        }

        return $activity;
    }

    private function filter($activities, $request)
    {
        $activity = $activities;

        if ($request->fCategory) {
            $category = explode(',', $request->fCategory);
            $activityIds = $activity->modelKeys();

            $categoryInSub = ActivitySubcategory::whereIn('id_category', $category)->select('id_subcategory')->get();
            $activityIdsFilter = ActivityHasSubcategory::whereIn('id_subcategory', $categoryInSub)->select('id_activity')->get();

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

        if ($request->fSubCategory) {
            $subCategory = explode(',', $request->fSubCategory);

            $activityIds = $activity->modelKeys();
            $activityIdsFilter = ActivityHasSubcategory::whereIn('id_subcategory', $subCategory)->select('id_activity')->get();

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

        return $activity;
    }
}
