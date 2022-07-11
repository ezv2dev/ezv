<?php

namespace App\Http\Controllers\Activity;

use App\Models\Activity;
use App\Models\ActivityHasFacilities;
use App\Models\ActivityHasSubcategory;
use App\Models\ActivitySubcategory;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Amenities;
use App\Models\ActivityFacilities;
use App\Models\ActivityCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ActivityFilterController extends Controller
{
    public function filter(Request $request)
    {
        // dd($request->all());

        $activity = Activity::with([
            'photo',
            'video',
            'detailReview',
            'facilities',
        ])
        ->where('status', 1)->get();
        if($request->category) {
            $category = explode(',', $request->category);

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
        if($request->timeofday) {
            $timeofday = explode(',', $request->timeofday);
            $checkMorning = in_array('morning', $timeofday);
            $checkAfternoon = in_array('afternoon', $timeofday);
            $checkEvening = in_array('evening', $timeofday);
            // dd($timeofday);
            $activityIds = $activity->modelKeys();
            // find morning activity
            $listActivityInMorning = [];
            if($checkMorning) {
                $listActivityInMorning = Activity::with([
                        'photo',
                        'video',
                        'detailReview',
                        'facilities',
                    ])
                    ->whereIn('id_activity', $activityIds)
                    ->whereBetween('open_time', ['06:00:01','12:00:00'])
                    ->where('status', 1)
                    ->get();
            }
            // find afternoon activity
            $listActivityInAfternoon = [];
            if($checkAfternoon) {
                $listActivityInAfternoon = Activity::with([
                        'photo',
                        'video',
                        'detailReview',
                        'facilities',
                    ])
                    ->whereIn('id_activity', $activityIds)
                    ->whereBetween('open_time', ['12:00:01','17:00:00'])
                    ->where('status', 1)
                    ->get();
            }
            // find evening activity
            $listActivityInEvening = [];
            if($checkEvening) {
                $listActivityInEvening = Activity::with([
                        'photo',
                        'video',
                        'detailReview',
                        'facilities',
                    ])
                    ->whereIn('id_activity', $activityIds)
                    ->whereBetween('open_time', ['17:00:01','23:59:59'])
                    ->orWhereBetween('open_time', ['00:00:00','06:00:00'])
                    ->where('status', 1)
                    ->get();
            }
            // collect all data into 1 collection activity
            $activity = new Collection();
            $activity = $activity->merge($listActivityInMorning)->merge($listActivityInAfternoon)->merge($listActivityInEvening);

            // dd($activity);
        }
        if($request->facilities) {
            $facilities = explode(',', $request->facilities);
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

        $amenities = Amenities::all();
        $locations = Location::all();
        $facilities = ActivityFacilities::all();
        $categories = ActivityCategory::all();

        // randomize activity array order
        $activity = $activity->shuffle()->all();
        // dd($activity);

        return view('user.list_activity', compact('activity', 'amenities', 'locations', 'categories', 'facilities'));
    }

    public function getCategorySubcategory(Request $request)
    {
        // $id = json_decode($id);
        // $subcategory = ActivitySubcategory::whereIn('id_category', $id)->get();
        if($request->category) {
            $subcategory = ActivitySubcategory::where('id_category', $request->category)->get();
            return $subcategory;
        }
        abort(404);
    }
}
