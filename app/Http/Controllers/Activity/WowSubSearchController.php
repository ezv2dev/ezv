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

class WowSubSearchController extends Controller
{
    public function index(Request $request)
    {
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

        $fSubCategory = $request->fSubCategory;

        if ($fSubCategory) {
            $activity = $this->filter($activity, $request);
        }

        $activityIds = $activity->modelKeys();
        $activity = Activity::with([
            'video',
            'photo',
            'detailReview',
            'facilities'
        ])->whereIn('id_activity', $activityIds)->orderBy('grade')->paginate(env('CONTENT_PER_PAGE_LIST_ACTIVITY'));

        $getIdCategory = ActivitySubcategory::where('id_subcategory', $fSubCategory)->get('id_category');
        $subCategory = ActivitySubcategory::where('id_category', $getIdCategory[0]->id_category)->inRandomOrder()->get();
        $subTitle = ActivityCategory::where('id_category', $fSubCategory)->first();

        if (DeviceCheckService::isMobile()) {
            return view('user.m-list_activity', compact('activity', 'amenities', 'facilities', 'categories', 'subCategory', 'subTitle', 'property_type'));
        }
        if (DeviceCheckService::isDesktop()) {
            return view('user.list_activity_search', compact('activity', 'amenities', 'facilities', 'categories', 'subCategory', 'subTitle', 'property_type'));
        }
        return view('user.list_activity_search', compact('activity', 'amenities', 'facilities', 'categories', 'subCategory', 'subTitle', 'property_type'));
    }

    private function filter($activities, $request)
    {
        $activity = $activities;

        if ($request->fSubCategory) {
            $category = explode(',', $request->fSubCategory);

            $activityIds = $activity->modelKeys();
            $activityIdsFilter = ActivityHasSubcategory::whereIn('id_subcategory', $category)->select('id_activity')->get();

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
