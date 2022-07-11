<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Activity;
use App\Models\ActivityPrice;
use Auth;

use App\Models\ActivitySubcategory;
use App\Models\ActivityFacilities;
use App\Models\ActivityRules;

use App\Models\ActivityPricePhoto;
use App\Models\ActivityPriceVideo;
use App\Models\ActivityPriceStory;

use App\Models\Location;
use App\Models\NotificationOwner;
use App\Models\Restaurant;
use App\Models\Villa;
use App\Models\VillaAmenities;
use App\Services\DeviceCheckService;
use Illuminate\Support\Facades\Validator;
use File;
use App\Services\FileCompressionService as FileCompression;

class ActivityPriceController extends Controller
{
    public function index(Request $request, $id)
    {
        // $activityPrice = ActivityPrice::where('id_price', $id)-->first();

        $photo = ActivityPricePhoto::where('id_price', $id)->get();
        $video = ActivityPriceVideo::where('id_price', $id)->get();
        $stories = ActivityPriceStory::where('id_price', $id)->get();
        $activityPrice = ActivityPrice::where('id_price', $id)->with(['photo'])->first();

        abort_if(!$activityPrice, 404);

        $activity = Activity::with([
            'favorit',
            'photo',
            'video',
            'story',
            // 'detailReview',
            'facilities',
            'price',
            'createdByDetails'
        ])
            ->where([
                ['id_activity', $activityPrice->id_activity],
                ['status', 1],
            ])->first();

        $subCategory = ActivitySubcategory::all();

        // check if the editor does not have authorization
        if (auth()->check()) {
            $find = Activity::find($activityPrice->id_activity);
            abort_if(!$find, 404);
            if (in_array(auth()->user()->role->name, ['admin', 'superadmin']) || auth()->user()->id == $find->created_by) {
                $activity = Activity::with([
                    'favorit',
                    'photo',
                    'video',
                    'story',
                    // 'detailReview',
                    'facilities',
                    'price'
                ])
                    ->where([
                        ['id_activity', $activityPrice->id_activity],
                    ])->first();
            }
        }

        // check if activity exist
        abort_if(!$activity, 404);

        $locations = Location::all();
        $facilities = ActivityFacilities::all();
        $villas_advertise = Villa::where('id_villa', '14')->first();
        $villa_amenities = VillaAmenities::select('amenities.icon as icon', 'amenities.name as name')->join('amenities', 'villa_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')->where('id_villa', '14')->get();
        $thingstodo_location = Activity::with(['location'])->select('id_location')->first();
        $activity_rules = ActivityRules::where('id_activity', $id)->with('activity')->first();


        $get_activity = Activity::where('id_activity', $activityPrice->id_activity)->first();
        $point = array('lat' => $get_activity->latitude, 'long' => $get_activity->longitude, 'id_location' => $get_activity->id_location);
        // ? Start Villa Slider
        $compare_villa = Villa::all();

        $kilometers = array();
        $i = 0;
        foreach ($compare_villa as $item) {
            $lat1 = $point['lat'];
            $lon1 = $point['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;
            $id_villa = $item->id_villa;
            $name = $item->name;
            $theta = $lon1 - $lon2;

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $kilometers[$i][] = number_format((float)$miles * 1.609344, 1, '.', '');
            $kilometers[$i][] = $id_villa;
            $kilometers[$i][] = $name;
            $i++;
        }

        $unsorted_data = collect($kilometers);
        $sorted_data1 = $unsorted_data->sortBy('0');
        $last = $sorted_data1;

        $locArray = array();
        foreach ($last as $item1) {
            array_push($locArray, $item1[1]);
        }
        // ? End Villa Slider

        // ? Start Restaurant Slider
        $compare_restaurant = Restaurant::all();

        $kilometers2 = array();
        $j = 0;
        foreach ($compare_restaurant as $item) {
            $lat3 = $point['lat'];
            $lon3 = $point['long'];
            $lat4 = $item->latitude;
            $lon4 = $item->longitude;
            $id_restaurant = $item->id_restaurant;
            $name2 = $item->name;
            $theta2 = $lon3 - $lon4;

            $miles2 = (sin(deg2rad($lat3)) * sin(deg2rad($lat4))) + (cos(deg2rad($lat3)) * cos(deg2rad($lat4)) * cos(deg2rad($theta2)));
            $miles2 = acos($miles2);
            $miles2 = rad2deg($miles2);
            $miles2 = $miles2 * 60 * 1.1515;
            $kilometers2[$j][] = number_format((float)$miles2 * 1.609344, 1, '.', '');
            $kilometers2[$j][] = $id_restaurant;
            $kilometers2[$j][] = $name2;
            $j++;
        }

        $unsorted_data2 = collect($kilometers2);
        $sorted_data2 = $unsorted_data2->sortBy('0');
        $last2 = $sorted_data2;

        $locArray2 = array();
        foreach ($last2 as $item2) {
            array_push($locArray2, $item2[1]);
        }
        // ? End Restaurant Slider

        $ids_ordered = implode(',', $locArray);
        $ids_ordered2 = implode(',', $locArray2);

        $nearby_villas = Villa::whereIn('id_location', $locArray)
            ->where('status', '1')
            ->orderByRaw("FIELD(id_location, $ids_ordered)")
            ->get();

        $nearby_restaurant = Restaurant::whereIn('id_location', $locArray2)
            ->where('status', '1')
            ->orderByRaw("FIELD(id_location, $ids_ordered2)")
            ->get();

        if (DeviceCheckService::isMobile()) {
            return view('user.activity.prices.m-prices_index', compact('stories', 'activityPrice', 'photo', 'video', 'activity', 'nearby_villas', 'nearby_restaurant', 'locations', 'facilities', 'subCategory', 'villas_advertise', 'villa_amenities', 'activity_rules'));
        }
        if (DeviceCheckService::isDesktop()) {
            return view('user.activity.prices.prices_index', compact('stories', 'activityPrice', 'photo', 'video', 'activity', 'nearby_villas', 'nearby_restaurant', 'locations', 'facilities', 'subCategory', 'villas_advertise', 'villa_amenities', 'activity_rules'));
        }
        return view('user.activity.prices.prices_index', compact('stories', 'activityPrice', 'photo', 'video', 'activity', 'nearby_villas', 'nearby_restaurant', 'locations', 'facilities', 'subCategory', 'villas_advertise', 'villa_amenities', 'activity_rules'));
    }

    public function update_price(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        $validator = Validator::make($request->all(), [
            'id_price' => ['required', 'integer'],
            'price' => ['required',],
        ]);
        if ($validator->fails()) {
            abort(500);
        }

        // activity data
        $activityPrice = ActivityPrice::where('id_price', $request->id_price)->first();

        // check if activity does not exist, abort 404
        abort_if(!$activityPrice, 404);

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activityPrice->created_by) {
            abort(403);
        }

        // update
        $updatedActivity = $activityPrice->update([
            'price' => $request->price,
            'updated_by' => auth()->user()->id,
        ]);

        // check if update is success or not
        if ($updatedActivity) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function activity_update_name(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        $validator = Validator::make($request->all(), [
            'id_price' => ['required', 'integer'],
            'name' => ['required', 'max:100'],
        ]);
        if ($validator->fails()) {
            abort(500);
        }

        // activity data
        $activity = ActivityPrice::where('id_price', $request->id_price)->first();

        // check if activity does not exist, abort 404
        abort_if(!$activity, 404);

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            abort(403);
        }

        // update
        $updatedActivity = $activity->update([
            'name' => $request->name,
            'updated_by' => auth()->user()->id,
        ]);

        // check if update is success or not
        if ($updatedActivity) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function activity_update_short_description(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        $validator = Validator::make($request->all(), [
            'id_price' => ['required', 'integer'],
            'short_description' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            abort(500);
        }

        // dd($request->short_description);

        // activity data
        $activity = ActivityPrice::where('id_price', $request->id_price)->first();

        // check if activity does not exist, abort 404
        abort_if(!$activity, 404);

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            abort(403);
        }

        // update
        $updatedActivity = $activity->update([
            'short_description' => str_replace(array("\n", "\r"), ' ', $request->short_description),
            'updated_by' => auth()->user()->id,
        ]);
        // check if update is success or not
        if ($updatedActivity) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function activity_update_description(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        $validator = Validator::make($request->all(), [
            'id_price' => ['required', 'integer'],
            'description' => ['string']
        ]);
        if ($validator->fails()) {
            abort(500);
        }

        // activity data
        $activity = ActivityPrice::where('id_price', $request->id_price)->first();

        // check if activity does not exist, abort 404
        abort_if(!$activity, 404);

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            abort(403);
        }

        // update
        $updatedActivity = $activity->update([
            'description' => str_replace(array("\n", "\r"), ' ', $request->description),
            'updated_by' => auth()->user()->id,
        ]);

        // check if update is success or not
        if ($updatedActivity) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function activity_store_photo(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        $validator = Validator::make($request->all(), [
            'id_price' => ['required', 'integer'],
            'file' => ['required', 'mimes:jpeg,png,jpg,webp,mp4']
        ]);
        if ($validator->fails()) {
            abort(500);
        }

        // activity data
        $activity = ActivityPrice::with('activity')->where('id_price', $request->id_price)->first();

        // check if activity does not exist, abort 404
        abort_if(!$activity, 404);

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            abort(403);
        }

        // store process
        // $path = public_path() . '/foto/activity/' . $activity->name;
        $folder = $activity->activity->uid;
        $path = env("ACTIVITY_FILE_PATH") . $folder;

        if (!File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->file->getClientOriginalExtension());

        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
            request()->validate([
                'id_price' => ['required', 'integer'],
                'file' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960']
            ]);

            $original_name = $request->file->getClientOriginalName();
            // dd($original_name);
            $name_file = time() . "_" . $original_name;
            if ($ext != 'webp') {
                $name_file = FileCompression::compressImageToCustomExt($request->file, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');
            }
            // check last order
            $lastOrder = ActivityPricePhoto::where('id_price', $request->id_price)->orderBy('order', 'desc')->select('order')->first();

            if ($lastOrder) {
                $lastOrder = $lastOrder->order + 1;
            } else {
                $lastOrder = 1;
                $lastOrder;
            }

            //insert into database
            $createdActivity = ActivityPricePhoto::create([
                'id_price' => $request->id_price,
                'id_activity' => $activity->activity->id_activity,
                'name' => $name_file,
                'order' => $lastOrder,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);
        }

        if ($ext == 'mp4') {
            $original_name = $request->file->getClientOriginalName();
            // dd($original_name);
            $name_file = time() . "_" . $original_name;
            // isi dengan nama folder tempat kemana file diupload
            $request->file->move($path, $name_file);

            // check last order
            $lastOrder = ActivityPriceVideo::where('id_price', $request->id_price)->orderBy('order', 'desc')->select('order')->first();

            if ($lastOrder) {
                $lastOrder = $lastOrder->order + 1;
            } else {
                $lastOrder = 1;
                $lastOrder;
            }

            //insert into database
            $createdActivity = ActivityPriceVideo::create([
                'id_price' => $request->id_price,
                'id_activity' => $activity->activity->id_activity,
                'name' => $name_file,
                'order' => $lastOrder,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);
        }

        // check if update is success or not
        if ($createdActivity) {
            return back()
                ->with('success', 'Your data has been created');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function activity_delete_photo_photo(Request $request)
    {
        abort_if(!auth()->check(), 401);

        abort_if(!$request->id_photo || !$request->id, 500);

        $activity = ActivityPrice::where('id_price', $request->id)->first();
        $activityPhoto = ActivityPricePhoto::where('id_photo', $request->id_photo)->first();
        abort_if(!$activity, 404);
        abort_if(!$activityPhoto, 404);

        $this->authorize('activity_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by;
        abort_if($condition, 403);

        // delete photo
        // $path = public_path() . '/foto/gallery/' . $activity->name;
        $folder = strtolower($activity->activity->uid);
        $path = env("ACTIVITY_FILE_PATH") . $folder;

        // remove old photo
        if (File::exists($path . '/' . $activityPhoto->name)) {
            File::delete($path . '/' . $activityPhoto->name);
        }

        $deletedActivityPhoto = $activityPhoto->delete();
        // check if delete is success or not
        if ($deletedActivityPhoto) {
            return response()->json([
                'message' => 'Delete Data Successfuly',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Delete Data',
                'status' => 500,
            ], 500);
        }
    }

    public function activity_delete_photo_video(Request $request)
    {
        abort_if(!auth()->check(), 401);

        abort_if(!$request->id_video || !$request->id, 500);

        $activity = ActivityPrice::where('id_price', $request->id)->first();
        $activityVideo = ActivityPriceVideo::where('id_video', $request->id_video)->first();
        abort_if(!$activity, 404);
        abort_if(!$activityVideo, 404);

        $this->authorize('activity_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by;
        abort_if($condition, 403);

        // delete photo
        // $path = public_path() . '/foto/gallery/' . $activity->name;
        $folder = strtolower($activity->activity->uid);
        $path = env("ACTIVITY_FILE_PATH") . $folder;

        // remove old photo
        if (File::exists($path . '/' . $activityVideo->name)) {
            File::delete($path . '/' . $activityVideo->name);
        }

        $deletedActivityVideo = $activityVideo->delete();
        // check if delete is success or not
        if ($deletedActivityVideo) {
            return response()->json([
                'message' => 'Delete Data Successfuly',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Delete Data',
                'status' => 500,
            ], 500);
        }
    }

    public function activity_delete_image(Request $request)
    {
        abort_if(!auth()->check(), 401);

        abort_if(!$request->id, 500);

        $activity = ActivityPrice::with('activity')->where('id_price', $request->id)->first();
        abort_if(!$activity, 404);

        $this->authorize('activity_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $activity->name;
        // $folder = strtolower($activity->name);
        $folder = strtolower($activity->activity->uid);
        $path = env("ACTIVITY_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $activity->foto)) {
            File::delete($path . '/' . $activity->foto);
        }

        $deletedActivityImage = $activity->update([
            'foto' => NULL,
            'updated_by' => auth()->user()->id
        ]);

        // check if delete is success or not
        if ($deletedActivityImage) {
            return response()->json([
                'message' => 'Delete Data Successfuly',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Delete Data',
                'status' => 500,
            ], 500);
        }
    }

    public function activity_update_image(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // dd($request);

        // validation
        request()->validate([
            'id_price' => ['required', 'integer'],
            'image' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960']
        ]);

        // activity data
        $activity = ActivityPrice::with('activity')->where('id_price', $request->id_price)->first();

        // check if activity does not exist, abort 404
        abort_if(!$activity, 404);

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            abort(403);
        }

        // image path
        $folder = strtolower($activity->activity->uid);
        $path = env("ACTIVITY_FILE_PATH") . $folder;
        // $path = strtolower($activity->uid);

        // remove old image
        if (File::exists($path . '/' . $activity->foto)) {
            File::delete($path . '/' . $activity->foto);
        }

        // store process
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->image->getClientOriginalExtension());

        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
            $original_name = $request->image->getClientOriginalName();
            // dd($original_name);
            $name_file = time() . "_" . $original_name;
            $name_file = FileCompression::compressImageToCustomExt($request->image, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

            //insert into database
            $updatedActivity = $activity->update([
                'foto' => $name_file,
                'updated_by' => auth()->user()->id
            ]);
        }

        // check if update is success or not
        if ($updatedActivity) {
            return back()
                ->with('success', 'Your data has been created');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function activity_store_story(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:100'],
            'file' => ['required', 'mimes:mp4']
        ]);

        if ($validator->fails()) {
            abort(500);
        }

        // activity data
        $activity = ActivityPrice::with('activity')->where('id_price', $request->id_price)->first();

        // check if activity does not exist, abort 404
        abort_if(!$activity, 404);

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            abort(403);
        }

        // store process
        $folder = strtolower($activity->activity->uid);
        $path = env("ACTIVITY_FILE_PATH") . $folder;

        if (!File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->file->getClientOriginalExtension());

        if ($ext == 'mp4') {
            $original_name = $request->file->getClientOriginalName();
            // dd($original_name);
            $name_file = time() . "_" . $original_name;
            // isi dengan nama folder tempat kemana file diupload
            $request->file->move($path, $name_file);

            // dd($name_file);

            //insert into database
            $createdStory = ActivityPriceStory::create([
                'id_activity' => $activity->id_activity,
                'id_price' => $request->id_price,
                'name' => $name_file,
                'title' => $request->title,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);
        }

        // check if update is success or not
        if ($createdStory) {
            return back()
                ->with('success', 'Your data has been created');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function activity_delete_story(Request $request)
    {
        abort_if(!auth()->check(), 401);

        abort_if(!$request->id_story || !$request->id, 500);

        $activity = ActivityPrice::with('activity')->where('id_price', $request->id)->first();
        $activityStory = ActivityPriceStory::find($request->id_story);
        abort_if(!$activity, 404);
        abort_if(!$activityStory, 404);

        $this->authorize('activity_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $activity->name;
        $folder = strtolower($activity->activity->uid);
        $path = env("ACTIVITY_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $activityStory->name)) {
            File::delete($path . '/' . $activityStory->name);
        }

        $deletedActivityStory = $activityStory->delete();
        // check if delete is success or not
        if ($deletedActivityStory) {
            return response()->json([
                'message' => 'Delete Data Successfuly',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed Delete Data',
                'status' => 500,
            ], 500);
        }
    }

    public function activity_story(Request $request)
    {
        // validation
        // $validator = Validator::make($request->all(), [
        //     'id' => ['required', 'integer'],
        //     'id_story' => ['required', 'integer'],
        // ]);
        // if($validator->fails()) {
        //     abort(500);
        // }

        $data = ActivityPriceStory::with('activity')->where('id_story', $request->id)->get();

        echo json_encode($data);
    }

    public function things_to_do_price_request_video($id, $name)
    {
        NotificationOwner::create(array(
            'id_user' => $id,
            'message' => 'Someone request a video in ' . $name,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8)
        ));

        return response()->json([
            'message' => 'Success sent a message to Owner',
            'status' => 200,
        ], 200);
    }
}
