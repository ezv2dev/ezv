<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use Auth;
use App\Models\ActivityCategory;
use App\Models\ActivityFacilities;
use App\Models\ActivityHasFacilities;
use App\Models\ActivityHasSubcategory;
use App\Models\Amenities;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Services\FileCompressionService as FileCompression;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ActivityPhoto;
use App\Models\ActivityPrice;
use App\Models\ActivitySave;
use App\Models\ActivityStory;
use App\Models\ActivitySubcategory;
use App\Models\ActivityVideo;
use App\Models\Location;
use App\Models\PropertyTypeVilla;
use App\Models\Villa;
use File;
use App\Models\Restaurant;
use App\Services\DeviceCheckService;
use App\Models\Hotel;

class ActivityListController extends Controller
{
    public function activity_list(Request $request)
    {
        $categories = ActivityCategory::all();
        $subCategory = ActivitySubcategory::all();

        $activity = Activity::with([
            'video',
            'photo',
            'detailReview',
            'facilities'
        ])->where('status', 1)->inRandomOrder()->orderBy('grade')->paginate(env('CONTENT_PER_PAGE_LIST_ACTIVITY'));

        // $activity->each(function ($item, $key) {
        //     $item->setAppends(['villa_nearby', 'restaurant_nearby', 'hotel_nearby']);
        // });

        return view('user.list_activity', compact('activity', 'categories', 'subCategory', 'subCategory'));
    }

    public function activity_update_name(Request $request)
    {
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'authenticated',
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_activity' => ['required', 'integer'],
            'name' => ['required', 'max:100'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // activity data
        $activity = Activity::find($request->id_activity);

        // check if activity does not exist, abort 404
        if (!$activity) {
            return response()->json([
                'message' => 'WoW Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $updatedActivity = $activity->update([
            'name' => $request->name,
            'updated_by' => auth()->user()->id,
        ]);

        $activityData = Activity::where('id_activity', $request->id_activity)->select('name')->first();

        // check if update is success or not
        if ($updatedActivity) {
            return response()->json([
                'message' => 'Successfuly Updated Name WoW',
                'status' => 200,
                'data' => $activityData
            ]);
        } else {
            return response()->json([
                'message' => 'Error Updated Name WoW',
            ], 500);
        }
    }

    public function activity_update_description(Request $request)
    {
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Access Denied, Please Login!'
            ], 500);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_activity' => ['required', 'integer'],
            'description' => ['string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // activity data
        $activity = Activity::find($request->id_activity);

        // check if activity does not exist, abort 404
        if (!$activity) {
            return response()->json([
                'message' => 'Wow Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $updatedActivity = $activity->update([
            'description' => str_replace(array("\n", "\r"), ' ', $request->description),
            'updated_by' => auth()->user()->id,
        ]);

        //return to json
        $wowData = Activity::where('id_activity', $request->id_activity)->select('description')->first();

        // check if update is success or not
        if ($updatedActivity) {
            return response()->json([
                'message' => 'Successfuly Updated Wow Description',
                'data' => $wowData
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Updated Wow Description',
            ], 500);
        }
    }

    public function activity_update_short_description(Request $request)
    {
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Access Denied, Please Login!'
            ], 500);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_activity' => ['required', 'integer'],
            'short_description' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // activity data
        $activity = Activity::find($request->id_activity);

        // check if activity does not exist, abort 404
        if (!$activity) {
            return response()->json([
                'message' => 'Wow Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $updatedActivity = $activity->update([
            'short_description' => str_replace(array("\n", "\r"), ' ', $request->short_description),
            'updated_by' => auth()->user()->id,
        ]);

        $wowData = Activity::where('id_activity', $request->id_activity)->select('short_description')->first();

        // check if update is success or not
        if ($updatedActivity) {
            return response()->json([
                'message' => 'Successfuly Updated Wow Short Description',
                'data' => $wowData
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Updated Wow Short Description',
            ], 500);
        }
    }

    public function activity_update_location(Request $request)
    {
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_activity' => ['required', 'integer'],
            'id_location' => ['required', 'integer'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // activity data
        $activity = Activity::find($request->id_activity);

        // check if activity does not exist, abort 404
        if (!$activity) {
            return response()->json([
                'message' => 'WoW Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $updatedActivity = $activity->update([
            'id_activity' => $request->id_activity,
            'id_location' => $request->id_location,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'updated_by' => auth()->user()->id,
        ]);

        $activityData = Activity::where('id_activity', $request->id_activity)->select('latitude', 'longitude')->first();

        // check if update is success or not
        if ($updatedActivity) {
            return response()->json([
                'message' => 'Successfuly Updated WoW Location',
                'data' => $activityData
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Updated WoW Location',
            ], 500);
        }
    }

    public function activity_get_time(Request $request)
    {
        $activity = Activity::find($request->id_activity);

        $openTime = date('H:i', strtotime($activity->open_time));
        $closedTime = date('H:i', strtotime($activity->closed_time));

        $data = [
            'open_time' => $openTime,
            'closed_time' => $closedTime,
        ];
        return response()->json([
            'data' => $data,
            'message' => 'Get Detail WoW Time',
        ]);
    }

    public function Activity_update_time(Request $request)
    {
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'authenticated',
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_activity' => ['required', 'integer'],
            'open_time' => ['required'],
            'closed_time' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // activity data
        $activity = Activity::find($request->id_activity);

        // check if activity does not exist, abort 404
        if (!$activity) {
            return response()->json([
                'message' => 'WoW Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $updatedActivity = $activity->update([
            'open_time' => $request->open_time,
            'closed_time' => $request->closed_time,
            'updated_by' => auth()->user()->id,
        ]);

        $openTime = date('H:i', strtotime($request->open_time));
        $closedTime = date('H:i', strtotime($request->closed_time));

        $data = [
            'open_time' => $openTime,
            'closed_time' => $closedTime,
        ];

        // check if update is success or not
        if ($updatedActivity) {
            return response()->json([
                'message' => 'Successfuly Updated WoW Time',
                'status' => 200,
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'message' => 'Error Updated WoW Time',
            ], 500);
        }
    }

    public function activity_update_contact(Request $request)
    {
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'authenticated',
            ], 401);
        }

        // validation
        $rules = [
            'id_activity' => ['required', 'integer'],
            'phone' => ['string', 'nullable'],
            'email' => ['email', 'nullable']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // activity data
        $activity = Activity::find($request->id_activity);

        // check if activity does not exist, abort 404
        if (!$activity) {
            return response()->json([
                'message' => 'WoW Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $updatedActivity = $activity->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_by' => auth()->user()->id,
        ]);

        // check if update is success or not
        if ($updatedActivity) {
            return response()->json([
                'message' => 'Successfuly Updated WoW Contact',
                'status' => 200,
                'data' => $activity,
            ]);
        } else {
            return response()->json([
                'message' => 'Error Updated WoW Contact',
            ], 500);
        }
    }

    public function activity_update_image(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'id_activity' => ['required', 'integer'],
            'image' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // activity data
        $activity = Activity::find($request->id_activity);

        // check if activity does not exist, abort 404
        if (!$activity) {
            return response()->json([
                'message' => 'WoW Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // image path
        $folder = strtolower($activity->uid);
        $path = env("ACTIVITY_FILE_PATH") . $folder;
        // $path = strtolower($activity->uid);

        // remove old image
        if (File::exists($path . '/' . $activity->image)) {
            File::delete($path . '/' . $activity->image);
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
                'image' => $name_file,
                'updated_by' => auth()->user()->id
            ]);
        }

        $activityData = Activity::where('id_activity', $request->id_activity)->select('image')->first();

        // check if update is success or not
        if ($updatedActivity) {
            return response()->json([
                'message' => 'Successfuly Updated WoW Profile',
                'status' => 200,
                'data' => $activityData
            ]);
        } else {
            return response()->json([
                'message' => 'Error Updated WoW Short Description',
            ], 500);
        }
    }

    public function activity_delete_image(Request $request)
    {
        abort_if(!auth()->check(), 401);

        abort_if(!$request->id, 500);

        $activity = Activity::find($request->id);
        abort_if(!$activity, 404);

        $this->authorize('activity_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $activity->name;
        $folder = strtolower($activity->uid);
        $path = env("ACTIVITY_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $activity->image)) {
            File::delete($path . '/' . $activity->image);
        }

        $deletedActivityImage = $activity->update([
            'image' => NULL,
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
            ], 500);
        }
    }

    public function activity_store_price(Request $request)
    {
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'authenticated',
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_activity' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:100'],
            // 'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'image' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // activity data
        $activity = Activity::find($request->id_activity);

        // check if activity does not exist, abort 404
        if (!$activity) {
            return response()->json([
                'message' => 'WoW Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // store process
        $folder = strtolower($activity->uid);
        $path = env("ACTIVITY_FILE_PATH") . $folder;

        if (!File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->image->getClientOriginalExtension());

        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
            $original_name = $request->image->getClientOriginalName();
            // dd($original_name);
            $name_file = time() . "_" . $original_name;
            $name_file = FileCompression::compressImageToCustomExt($request->image, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

            // dd($name_file);

            //insert into database
            $createdActivity = ActivityPrice::create([
                'id_activity' => $request->id_activity,
                'name' => $request->name,
                'description' => $request->description,
                'short_description' => null,
                'price' => $request->price,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'foto' => $name_file,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);
        }

        $activityPrice = ActivityPrice::where('id_price', $createdActivity->id_price)->first();
        $uid = Activity::where('id_activity', $request->id_activity)->first('uid');

        // check if update is success or not
        if (isset($createdActivity) == true) {
            return response()->json([
                'message' => 'Successfuly Updated WoW Contact',
                'data' => $activityPrice,
                'uid' => $uid,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Updated WoW Contact',
            ], 500);
        }
    }

    public function activity_delete_price(Request $request)
    {
        abort_if(!auth()->check(), 401);

        abort_if(!$request->id_price || !$request->id, 500);

        $activity = Activity::find($request->id);
        $activityPrice = ActivityPrice::find($request->id_price);
        abort_if(!$activity, 404);
        abort_if(!$activityPrice, 404);

        $this->authorize('activity_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $activity->name;
        $folder = strtolower($activity->name);
        $path = env("ACTIVITY_FILE_PATH") . $folder . '/price';

        // remove old video
        if (File::exists($path . '/' . $activityPrice->foto)) {
            File::delete($path . '/' . $activityPrice->foto);
        }

        $deletedActivityPrice = $activityPrice->delete();
        // check if delete is success or not
        if ($deletedActivityPrice) {
            return back()
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function activity_store_photo(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'id_activity' => ['required', 'integer'],
            'file' => ['required', 'mimes:jpeg,png,jpg,webp,mp4,mov']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 500);
        }

        $status = 500;

        try {
            // activity data
            $activity = Activity::find($request->id_activity);

            // check if activity does not exist, abort 404
            if (!$activity) {
                return response()->json([
                    'message' => 'WoW Not Found'
                ], 404);
            }

            // check if the editor does not have authorization
            $this->authorize('activity_update');
            if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
                return response()->json([
                    'message' => 'This action is unauthorized'
                ], 403);
            }

            // store process
            $folder = strtolower($activity->uid);
            $path = env("ACTIVITY_FILE_PATH") . $folder;
            // $path = public_path() . '/foto/activity/' . $activity->name;
            if (!File::isDirectory($path)) {

                File::makeDirectory($path, 0777, true, true);
            }

            $ext = strtolower($request->file->getClientOriginalExtension());

            $photo = [];
            $video = [];

            if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
                $validator2 = Validator::make($request->all(), [
                    'id_activity' => ['required', 'integer'],
                    'file' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960']
                ]);

                if ($validator2->fails()) {
                    return response()->json([
                        'message' => $validator2->errors()->all(),
                    ], 500);
                }

                $original_name = $request->file->getClientOriginalName();
                // dd($original_name);
                $name_file = time() . "_" . $original_name;
                $name_file = FileCompression::compressImageToCustomExt($request->file, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

                // check last order
                $lastOrder = ActivityPhoto::where('id_activity', $request->id_activity)->orderBy('order', 'desc')->select('order')->first();
                if ($lastOrder) {
                    $lastOrder = $lastOrder->order + 1;
                } else {
                    $lastOrder = 1;
                    $lastOrder;
                }

                //insert into database
                $createdActivity = ActivityPhoto::create([
                    'id_activity' => $request->id_activity,
                    'name' => $name_file,
                    'order' => $lastOrder,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id
                ]);

                array_push($photo, $createdActivity->id_photo);
            }

            if ($ext == 'mp4' || $ext == 'mov') {
                $original_name = $request->file->getClientOriginalName();
                // dd($original_name);
                $name_file = time() . "_" . $original_name;
                // isi dengan nama folder tempat kemana file diupload
                $request->file->move($path, $name_file);

                // check last order
                $lastOrder = ActivityVideo::where('id_activity', $request->id_activity)->orderBy('order', 'desc')->select('order')->first();
                if ($lastOrder) {
                    $lastOrder = $lastOrder->order + 1;
                } else {
                    $lastOrder = 1;
                    $lastOrder;
                }

                //insert into database
                $createdActivity = ActivityVideo::create([
                    'id_activity' => $request->id_activity,
                    'name' => $name_file,
                    'order' => $lastOrder,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id
                ]);

                array_push($video, $createdActivity->id_video);
            }

            if ($createdActivity) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        $data = [
            'photo' => ActivityPhoto::whereIn('id_photo', $photo)->get(),
            'video' => ActivityVideo::whereIn('id_video', $video)->get(),
            'uid' => Activity::where('id_activity', $request->id_activity)->select('uid')->first(),
        ];

        // check if update is success or not
        if ($createdActivity) {
            return response()->json([
                'message' => 'Update Gallery Wow',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Update Gallery Wow',
            ], 500);
        }
    }

    public function activity_update_position_photo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'imageids' => ['required', 'array'],
            'id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 500);
        }

        $imageids_arr = $request->imageids;

        $activity = Activity::find($request->id);

        if (!$activity) {
            return response()->json([
                'message' => 'Wow Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        if (count($imageids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($imageids_arr as $id) {
                $find = ActivityPhoto::where('id_photo', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            $data = [
                'photo' => ActivityPhoto::where('id_activity', $request->id)->orderBy('order', 'asc')->get(),
                'video' => ActivityVideo::where('id_activity', $request->id)->orderBy('order', 'asc')->get(),
                'uid' => Activity::where('id_activity', $request->id)->select('uid')->first(),
            ];

            return response()->json([
                'data' => $data,
                'message' => 'Updated Position Photo'
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function activity_update_position_video(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'videoids' => ['required', 'array'],
            'id' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 500);
        }

        $videoids_arr = $request->videoids;

        $activity = Activity::find($request->id);

        if (!$activity) {
            return response()->json([
                'message' => 'Wow Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        if (count($videoids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($videoids_arr as $id) {
                $find = ActivityVideo::where('id_video', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            $data = [
                'photo' => ActivityPhoto::where('id_activity', $request->id)->orderBy('order', 'asc')->get(),
                'video' => ActivityVideo::where('id_activity', $request->id)->orderBy('order', 'asc')->get(),
                'uid' => Activity::where('id_activity', $request->id)->select('uid')->first(),
            ];

            return response()->json([
                'data' => $data,
                'message' => 'Updated Position Video'
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function activity_delete_photo_video(Request $request)
    {
        abort_if(!auth()->check(), 401);

        abort_if(!$request->id_video || !$request->id, 500);

        $activity = Activity::find($request->id);
        $activityVideo = ActivityVideo::find($request->id_video);
        abort_if(!$activity, 404);
        abort_if(!$activityVideo, 404);

        $this->authorize('activity_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $activity->name;
        $folder = strtolower($activity->uid);
        $path = env("ACTIVITY_FILE_PATH") . $folder;

        // remove old video
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
            ], 500);
        }
    }

    public function activity_delete_photo_photo(Request $request)
    {
        abort_if(!auth()->check(), 401);

        abort_if(!$request->id_photo || !$request->id, 500);

        $activity = Activity::find($request->id);
        $activityPhoto = ActivityPhoto::find($request->id_photo);
        abort_if(!$activity, 404);
        abort_if(!$activityPhoto, 404);

        $this->authorize('activity_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by;
        abort_if($condition, 403);

        // delete photo
        // $path = public_path() . '/foto/gallery/' . $activity->name;
        $folder = strtolower($activity->uid);
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
            ], 500);
        }
    }

    public function activity_store_facilities(Request $request)
    {
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'authenticated',
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_activity' => ['required', 'integer'],
            'facilities' => ['array']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // activity data
        $activity = Activity::find($request->id_activity);

        // check if activity does not exist, abort 404
        if (!$activity) {
            return response()->json([
                'message' => 'WoW Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update activity has facilities
        if ($request->facilities) {
            $activity->facilities()->detach();
            foreach ($request->facilities as $id_facilities) {
                ActivityHasFacilities::create([
                    'id_activity' => $request->id_activity,
                    'id_facilities' => $id_facilities,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id
                ]);
            }
            $updatedActivity = true;
        } else {
            $updatedActivity = $activity->facilities()->detach();
        }

        // check if update is success or not
        if ($updatedActivity) {
            return response()->json([
                'message' => 'Updated WoW Facilities',
                'status' => 200,
                'data' => $activity->facilities,
            ]);
        } else {
            return response()->json([
                'message' => 'Updated WoW Facilities',
            ], 500);
        }
    }

    public function activity_store_subcategory(Request $request)
    {
        // dd($request->all());
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'authenticated',
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_activity' => ['required', 'integer'],
            'subcategory' => ['array']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // activity data
        $activity = Activity::find($request->id_activity);

        // check if activity does not exist, abort 404
        if (!$activity) {
            return response()->json([
                'message' => 'WoW Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update activity has subcategory
        if ($request->subcategory) {
            $activity->subCategory()->detach();
            foreach ($request->subcategory as $id_subcategory) {
                ActivityHasSubcategory::create([
                    'id_activity' => $request->id_activity,
                    'id_subcategory' => $id_subcategory,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id
                ]);
            }
            $updatedActivity = true;
        } else {
            $updatedActivity = $activity->subCategory()->detach();
        }
        // dd($updatedActivity);

        $activity = Activity::find($request->id_activity);

        // check if update is success or not
        if ($updatedActivity) {
            return response()->json([
                'message' => 'Successfuly Updated WoW Category',
                'status' => 200,
                'data' => $activity->subCategory,
            ]);
        } else {
            return response()->json([
                'message' => 'Error Updated WoW Category',
            ], 500);
        }
    }

    public function activity_store_story(Request $request)
    {
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'authenticated',
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_activity' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:100'],
            'file' => ['required', 'mimes:mp4,mov']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // activity data
        $activity = Activity::find($request->id_activity);

        // check if activity does not exist, abort 404
        if (!$activity) {
            return response()->json([
                'message' => 'WoW Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('activity_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // store process
        $folder = strtolower($activity->uid);
        $path = env("ACTIVITY_FILE_PATH") . $folder;

        if (!File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->file->getClientOriginalExtension());

        if ($ext == 'mp4' || $ext == 'mov') {
            $original_name = $request->file->getClientOriginalName();
            // dd($original_name);
            $name_file = time() . "_" . $original_name;
            // isi dengan nama folder tempat kemana file diupload
            $request->file->move($path, $name_file);

            // dd($name_file);

            //insert into database
            $createdStory = ActivityStory::create([
                'id_activity' => $request->id_activity,
                'name' => $name_file,
                'title' => $request->title,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);
        }

        $getStory = ActivityStory::where('id_activity', $request->id_activity)->select('name', 'id_story')->latest()->get();
        $getUID = Activity::where('id_activity', $request->id_activity)->select('uid')->first();
        $activityVideo = ActivityVideo::where('id_activity', $request->id_activity)->select('id_video', 'name')->orderBy('order', 'asc')->get();

        $data = [];

        $i = 0;

        foreach ($getStory as $item) {
            $data[$i]['id_story'] = $item->id_story;
            $data[$i]['name'] = $item->name;
            $i++;
        }

        // check if update is success or not
        if ($createdStory) {
            return response()->json([
                'message' => 'Updated WoW Story',
                'data' => $data,
                'uid' => $getUID->uid,
                'video' => $activityVideo,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Updated WoW Story',
            ], 500);
        }
    }

    public function activity_delete_story(Request $request)
    {
        abort_if(!auth()->check(), 401);

        abort_if(!$request->id_story || !$request->id, 500);

        $activity = Activity::find($request->id);
        $activityStory = ActivityStory::find($request->id_story);
        abort_if(!$activity, 404);
        abort_if(!$activityStory, 404);

        $this->authorize('activity_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $activity->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $activity->name;
        $folder = strtolower($activity->uid);
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
            ], 500);
        }
    }

    public function activity_video(Request $request)
    {
        $id = $request->id;
        $video = ActivityVideo::where('id_video', $id)->orderBy('order', 'desc')->first();
        if ($video) {
            return response()->json($video, 200);
        }
        return response()->json([]);
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

        $data = ActivityStory::where('id_story', $request->id)->get();

        echo json_encode($data);
    }

    public function activity_map(Request $request)
    {
        if ($request->id) {
            $data = Activity::with([
                'video', 'photo', 'location', 'detailReview', 'facilities'
            ])->where('id_activity', $request->id)->first();

            if (!$data) {
                return response()->json([
                    'message' => 'data not found'
                ], 404);
            }
            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => 'something was wrong'
            ], 500);
        }
    }

    public function activity_price(Request $request)
    {
        if ($request->id) {
            $data = ActivityPrice::where('id_price', $request->id)->first();
            if (!$data) {
                return response()->json([
                    'message' => 'data not found'
                ], 404);
            }
            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => 'something was wrong'
            ], 500);
        }
    }

    public function activity_update_caption_photo(Request $request)
    {
        $this->authorize('activity_update');

        $status = 500;

        try {
            $activity = ActivityPhoto::where('id_photo', $request->id_photo)->first();

            $update = $activity->update([
                'caption' => $request->caption,
                'updated_by' => Auth::user()->id,
            ]);

            if ($update) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function like_things_to_do(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect(route('login'));
        }

        // check if there same favorit content
        $checkSameFavorit = ActivitySave::where([
            ['id_activity', '=', $request->activity],
            ['id_user', '=', $request->user],
        ])->first();

        if ($checkSameFavorit != null) {
            $checkSameFavorit->delete();
            $data = 0;
            return $data;
        } else {
            // otherwise, create favorit
            $data = ActivitySave::create([
                'id_activity' => $request->activity,
                'id_user' => $request->user,
                'created_by' => $request->user,
                'updated_by' => $request->user
            ]);

            $data = 1;
            return $data;
        };
    }
}
