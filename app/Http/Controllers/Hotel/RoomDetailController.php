<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Activity;
use App\Models\Amenities;
use App\Models\BathRoom;
use App\Models\BedRoom;
use App\Models\Hotel;
use App\Models\HotelRoomDetailPrice;

use App\Models\HotelRoomAvailability;

use App\Models\HotelTypeDetailAmenities;
use App\Models\HotelRoomBathroom;
use App\Models\HotelRoomBedroom;
use App\Models\HotelRoomKitchen;
use App\Models\HotelRoomSafety;
use App\Models\HotelRoomService;

use App\Models\Bed;
use App\Models\HotelAmenities;
use App\Models\HotelBathroom;
use App\Models\HotelBedroom;
use App\Models\HotelDetailReview;
use App\Models\HotelKitchen;
use App\Models\HotelRoomPhoto;
use App\Models\HotelRoomStory;

use App\Models\HotelService;
use App\Models\HotelStory;
use App\Models\HotelTypeDetail;

use App\Models\HotelRoomVideo;
use App\Models\Kitchen;
use App\Models\Location;
use App\Models\NotificationOwner;
use App\Models\PropertyTypeVilla;
use App\Models\Restaurant;
use App\Models\Safety;
use App\Models\Service;
use App\Services\DeviceCheckService;
use Auth;

use Illuminate\Support\Facades\Validator;
use File;
use App\Services\FileCompressionService as FileCompression;


class RoomDetailController extends Controller
{
    public static  function amenities($id)
    {
        $amenities = HotelTypeDetailAmenities::with('amenities')->where('id_hotel_room', $id)->get();

        return $amenities;
    }

    public static  function bathroom($id)
    {
        $bathroom = HotelRoomBathroom::with('bathroom')->where('id_hotel_room', $id)->get();

        return $bathroom;
    }

    public static  function bedroom($id)
    {
        $bedroom = HotelRoomBedroom::with('bedroom')->where('id_hotel_room', $id)->get();

        return $bedroom;
    }

    public static  function kitchen($id)
    {
        $kitchen = HotelRoomKitchen::with('kitchen')->where('id_hotel_room', $id)->get();

        return $kitchen;
    }

    public static  function safety($id)
    {
        $safety = HotelRoomSafety::with('safety')->where('id_hotel_room', $id)->get();

        return $safety;
    }

    public static  function service($id)
    {
        $service = HotelRoomService::with('service')->where('id_hotel_room', $id)->get();

        return $service;
    }

    public function room_hotel($id)
    {
        // check if hotel exist
        $get_id_hotel = HotelTypeDetail::where('id_hotel_room', $id)->select('id_hotel')->first();
        $id_hotel = $get_id_hotel->id_hotel;

        $hotel = Hotel::find($id_hotel);

        abort_if(!$hotel, 404);

        $hotel = Hotel::select('hotel.*', 'location.name as location')
            ->join('location', 'hotel.id_location', '=', 'location.id_location', 'left')->where('id_hotel', $id_hotel)->get();

        $photo = HotelRoomPhoto::where('id_hotel_room', $id)->orderBy('order', 'asc')->get();
        $video = HotelRoomVideo::where('id_hotel_room', $id)->orderBy('order', 'asc')->get();
        $amenities = HotelAmenities::select('hotel_amenities.id_hotel', 'amenities.icon as icon', 'amenities.name as name')
            ->join('amenities', 'hotel_amenities.id_amenities', '=', 'amenities.id_amenities', 'left')
            ->where('hotel_amenities.id_hotel', $id_hotel)->limit(5)->get();
        $ratting = HotelDetailReview::where('id_hotel', $id_hotel)->get();
        $stories = HotelRoomStory::where('id_hotel_room', $id)->orderBy('created_at', 'desc')->get();
        $location = Location::get();
        $propertyType = PropertyTypeVilla::all();
        $amenities_m = Amenities::get();
        $bathroom_m = BathRoom::get();
        $bedroom_m = BedRoom::get();
        $kitchen_m = Kitchen::get();
        $safety_m = Safety::get();
        $service_m = Service::get();
        $hotel_amenities = HotelTypeDetailAmenities::with('amenities')->where('id_hotel_room', $id)->get();

        // dd($hotel_amenities);

        $beds = Bed::get();
        $bathroom = HotelRoomBathroom::with('bathroom')->where('id_hotel_room', $id)->get();
        $bedroom = HotelRoomBedroom::with('bedroom')->where('id_hotel_room', $id)->get();
        $kitchen = HotelRoomKitchen::with('kitchen')->where('id_hotel_room', $id)->get();
        $safety = HotelRoomSafety::with('safety')->where('id_hotel_room', $id)->get();
        $service = HotelRoomService::with('service')->where('id_hotel_room', $id)->get();

        // dd($bathroom);

        $detail = HotelDetailReview::where('id_hotel', $id_hotel)->get();

        $createdby = Hotel::where('id_hotel', $id_hotel)
            ->join('users', 'hotel.created_by', '=', 'users.id')
            ->select('users.first_name')
            ->get();

        $hotel_location = Location::join('hotel', 'location.id_location', '=', 'hotel.id_location')
            ->where('hotel.id_hotel', $id_hotel)
            ->select('location.id_location')
            ->get();

        $hotels = HotelTypeDetail::where('id_hotel_room', $id)->first();
        $get_hotel = Hotel::where('id_hotel', $hotels->id_hotel)->first();
        $point = array('lat' => $get_hotel->latitude, 'long' => $get_hotel->longitude, 'id_location' => $get_hotel->id_location);
        // ? Start Activity Slider
        $compare_activity = Activity::all();

        $kilometers = array();
        $i = 0;
        foreach ($compare_activity as $item) {
            $lat1 = $point['lat'];
            $lon1 = $point['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;
            $id_activity = $item->id_activity;
            $name = $item->name;
            $theta = $lon1 - $lon2;

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $kilometers[$i][] = number_format((float)$miles * 1.609344, 1, '.', '');
            $kilometers[$i][] = $id_activity;
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
        // ? End Activity Slider

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

        $nearby_activities = Activity::whereIn('id_activity', $locArray)
            ->where('status', '1')
            ->orderByRaw("FIELD(id_activity, $ids_ordered)")
            ->get();

        $nearby_restaurant = Restaurant::whereIn('id_restaurant', $locArray2)
            ->where('status', '1')
            ->orderByRaw("FIELD(id_restaurant, $ids_ordered2)")
            ->get();

        $hotelRoom = HotelTypeDetail::with('bed', 'hotel', 'hotelType', 'typeAmenities')->where('id_hotel_room', $id)->first();

        // if (DeviceCheckService::isMobile()) {
        //     return view('user.hotel.m-hotel_room', compact('video', 'detail', 'hotel_amenities', 'bathroom', 'bedroom', 'kitchen', 'safety', 'service', 'hotel', 'photo', 'amenities', 'ratting', 'stories', 'location', 'amenities_m', 'bathroom_m', 'bedroom_m', 'kitchen_m', 'safety_m', 'service_m', 'createdby', 'nearby_restaurant', 'nearby_activities', 'createdby', 'nearby_restaurant', 'nearby_activities', 'propertyType', 'hotelRoom', 'beds'));
        // }
        // if (DeviceCheckService::isDesktop()) {
        //     return view('user.hotel.hotel_room', compact('video', 'detail', 'hotel_amenities', 'bathroom', 'bedroom', 'kitchen', 'safety', 'service', 'hotel', 'photo', 'amenities', 'ratting', 'stories', 'location', 'amenities_m', 'bathroom_m', 'bedroom_m', 'kitchen_m', 'safety_m', 'service_m', 'createdby', 'nearby_restaurant', 'nearby_activities', 'createdby', 'nearby_restaurant', 'nearby_activities', 'propertyType', 'hotelRoom', 'beds'));
        // }
        return view('user.hotel.hotel_room', compact('video', 'detail', 'hotel_amenities', 'bathroom', 'bedroom', 'kitchen', 'safety', 'service', 'hotel', 'photo', 'amenities', 'ratting', 'stories', 'location', 'amenities_m', 'bathroom_m', 'bedroom_m', 'kitchen_m', 'safety_m', 'service_m', 'createdby', 'nearby_restaurant', 'nearby_activities', 'createdby', 'nearby_restaurant', 'nearby_activities', 'propertyType', 'hotelRoom', 'beds'));
    }

    public function room_update_image(Request $request)
    {
        // dd($request->all());
        $this->authorize('listvilla_update');
        // validation
        request()->validate([
            'id_hotel_room' => ['required', 'integer'],
            'image' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960']
        ]);

        $status = 500;

        try {
            // $hotelRoom = HotelTypeDetail::where('id_hotel_room', $request->id_hotel_room)->first();
            $hotel = HotelTypeDetail::with('hotel')->where('id_hotel_room', $request->id_hotel_room)->first();
            $folder = strtolower($hotel->hotel->uid);

            // dd($folder);

            // $path = public_path() . '/foto/gallery/' . $folder;
            // $folder = $villa->uid;
            $path = env("HOTEL_FILE_PATH") . $folder;

            if (!File::isDirectory($path)) {

                File::makeDirectory($path, 0777, true, true);
            }

            $ext = strtolower($request->image->getClientOriginalExtension());
            // dd($ext);

            if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
                $original_name = $request->image->getClientOriginalName();
                // dd($original_name);
                $find = HotelTypeDetail::where('id_hotel_room', $request->id_hotel_room)->first();

                $name_file = time() . "_" . $original_name;

                $name_file = FileCompression::compressImageToCustomExt($request->image, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

                $find->update(array(
                    'image' => $name_file,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_by' => Auth::user()->id,
                ));
            }

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            // return back()
            //     ->with('success', 'Your data has been updated');
            return response()->json(['success' => true, 'message' => 'Succesfully Updated Hotel Profile']);
        } else {
            // return back()
            //     ->with('error', 'Please check the form below for errors');
            return response()->json(['errors' => true, 'message' => 'Fail Updated Hotel Profile']);
        }
    }

    public function room_delete_image(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id, 500);
        abort_if(!auth()->check(), 401);

        $hotelRoom = HotelTypeDetail::with('hotel')->where('id_hotel_room', $request->id)->first();
        abort_if(!$hotelRoom, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotelRoom->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $villa->name;
        $folder = strtolower($hotelRoom->hotel->uid);
        $path = env("HOTEL_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $hotelRoom->image)) {
            File::delete($path . '/' . $hotelRoom->image);
        }

        $deleted = $hotelRoom->update([
            'image' => NULL,
            'updated_by' => auth()->user()->id
        ]);

        // check if delete is success or not
        if ($deleted) {
            // return back()
            //     ->with('success', 'Your data has been deleted');
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

    public function room_update_short_description(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = HotelTypeDetail::where('id_hotel_room', $request->id_hotel_room)->firstOrFail();

            $find->update(array(
                'short_description' => str_replace(array("\n", "\r"), ' ', $request->short_description),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
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

    public function room_update_description(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = HotelTypeDetail::where('id_hotel_room', $request->id_hotel_room)->first();

            $find->update(array(
                'room_description' => str_replace(array("\n", "\r"), ' ', $request->description),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
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

    public function store_gallery(Request $request)
    {
        // dd($request->all());
        $this->authorize('listvilla_create');
        // validation
        $validator = Validator::make($request->all(), [
            'id_hotel_room' => ['required', 'integer'],
            'file' => ['required', 'mimes:jpeg,png,jpg,webp,mp4']
        ]);
        if ($validator->fails()) {
            abort(500);
        }
        $berkas = $request->file;

        try {
            if (empty($berkas)) {
            } else {
                //cek the directori first
                $find = HotelTypeDetail::with('hotel')->where('id_hotel_room', $request->id_hotel_room)->first();
                // $folder = $find[0]->uid;
                $folder = strtolower($find->hotel->uid);
                $path = env("HOTEL_FILE_PATH") . $folder;
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $ext = strtolower($berkas->getClientOriginalExtension());

                if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
                    request()->validate([
                        'id_hotel_room' => ['required', 'integer'],
                        'file' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960']
                    ]);

                    $original_name = $berkas->getClientOriginalName();

                    $name_file = time() . "_" . $original_name;

                    $name_file = FileCompression::compressImageToCustomExt($request->file, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

                    // check last order
                    $lastOrder = HotelRoomPhoto::where('id_hotel_room', $request->id_hotel_room)->orderBy('order', 'desc')->select('order')->first();
                    if ($lastOrder) {
                        $lastOrder = $lastOrder->order + 1;
                    } else {
                        $lastOrder = 1;
                        $lastOrder;
                    }

                    //insert into database
                    $data = HotelRoomPhoto::insert(array(
                        'name' => $name_file,
                        'id_hotel' => $find->id_hotel,
                        'id_hotel_room' => $request->id_hotel_room,
                        'order' => $lastOrder,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                } elseif ($ext == 'mp4') {
                    $original_name = $berkas->getClientOriginalName();

                    $name_file = time() . "_" . $original_name;

                    // isi dengan nama folder tempat kemana file diupload
                    $berkas->move($path, $name_file);

                    $lastOrder = HotelRoomVideo::where('id_hotel_room', $request->id_hotel_room)->orderBy('order', 'desc')->select('order')->first();
                    if ($lastOrder) {
                        $lastOrder = $lastOrder->order + 1;
                    } else {
                        $lastOrder = 1;
                        $lastOrder;
                    }

                    //insert into database
                    $data = HotelRoomVideo::insert(array(
                        'name' => $name_file,
                        'id_hotel_room' => $request->id_hotel_room,
                        'id_hotel' => $find->id_hotel,
                        'order' => $lastOrder,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }
            if ($data) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been created');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }

    }

    public function room_delete_photo_photo(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id_photo || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $hotelRoom = HotelTypeDetail::with('hotel')->where('id_hotel_room', $request->id)->first();
        $hotelPhoto = HotelRoomPhoto::find($request->id_photo);
        abort_if(!$hotelRoom, 404);
        abort_if(!$hotelPhoto, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotelPhoto->created_by;
        abort_if($condition, 403);

        // delete photo
        // $path = public_path() . '/foto/gallery/' . $villa->name;
        $folder = strtolower($hotelRoom->hotel->uid);
        $path = env("HOTEL_FILE_PATH") . $folder;

        // remove old photo
        if (File::exists($path . '/' . $hotelPhoto->name)) {
            File::delete($path . '/' . $hotelPhoto->name);
        }

        $deletedHotelPhoto = $hotelPhoto->delete();
        // check if delete is success or not
        if ($deletedHotelPhoto) {
            // return back()
            //     ->with('success', 'Your data has been deleted');
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

    public function room_delete_photo_video(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id_video || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $hotelRoom = HotelTypeDetail::with('hotel')->where('id_hotel_room', $request->id)->first();
        $hotelVideo = HotelRoomVideo::find($request->id_video);
        abort_if(!$hotelRoom, 404);
        abort_if(!$hotelVideo, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotelVideo->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $villa->name;
        $folder = strtolower($hotelRoom->hotel->uid);
        $path = env("HOTEL_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $hotelVideo->name)) {
            File::delete($path . '/' . $hotelVideo->name);
        }

        $deletedHotelVideo = $hotelVideo->delete();
        // check if delete is success or not
        if ($deletedHotelVideo) {
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

    public function room_update_story(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $berkas = $request->file;
            if (empty($berkas)) {
                $status = 500;
            } else {
                $find = HotelTypeDetail::with('hotel')->where('id_hotel_room', $request->id_hotel_room)->get();
                // $folder = strtolower($find[0]->name);
                // $path = public_path() . '/foto/gallery/' . $folder;
                $folder = strtolower($find[0]->hotel->uid);
                $path = env("HOTEL_FILE_PATH") . $folder;
                if (!File::isDirectory($path)) {

                    File::makeDirectory($path, 0777, true, true);
                }

                $ext = strtolower($berkas->getClientOriginalExtension());

                if ($ext == 'mp4') {
                    $original_name = $berkas->getClientOriginalName();

                    $name_file = time() . "_" . $original_name;
                    // isi dengan nama folder tempat kemana file diupload
                    $berkas->move($path, $name_file);

                    $data = HotelRoomStory::insert(array(
                        'title' => $request->title,
                        'name' => $name_file,
                        'id_hotel_room' => $request->id_hotel_room,
                        'id_hotel' => $find[0]->id_hotel,
                        // 'thumbnail' => $find[0]->image,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            if ($data) {
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

    public function story($id)
    {
        // $data = VillaStory::where('id_story', $id)->get();
        $data = HotelRoomStory::with('hotel')->where('id_story', $id)->first();

        if ($data) {
            return response()->json([
                'id_story' => $data->id_story,
                'title' => $data->title,
                'name' => $data->name,
                'hotel' => (object)[
                    'id_hotel' => $data->hotel->id_hotel,
                    'name_hotel' => $data->hotel->name,
                    'uid' => $data->hotel->uid,
                ] ?? null,
                'thumbnail' => $data->thumbnail,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
                'created_by' => $data->created_by,
                'updated_by' => $data->updated_by
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function room_delete_story(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id_story || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $hotelRoom = HotelTypeDetail::with('hotel')->where('id_hotel_room', $request->id)->first();
        $hotelStory = HotelRoomStory::find($request->id_story);
        abort_if(!$hotelRoom, 404);
        abort_if(!$hotelStory, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotelStory->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $villa->name;
        $folder = strtolower($hotelRoom->hotel->uid);
        $path = env("HOTEL_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $hotelStory->name)) {
            File::delete($path . '/' . $hotelStory->name);
        }

        $deletedHotelStory = $hotelStory->delete();

        // check if delete is success or not
        if ($deletedHotelStory) {
            // return back()
            //     ->with('success', 'Your data has been deleted');
            return response()->json([
                'message' => 'Delete Data Successfuly',
                'status' => 200,
            ], 200);
        } else {
            // return back()
            //     ->with('error', 'Please check the form below for errors');
            return response()->json([
                'message' => 'Failed Deleted Data',
                'status' => 500,
            ], 500);
        }
    }

    public function room_update_price(Request $request)
    {
        // dd($request->all());
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = HotelTypeDetail::where('id_hotel_room', $request->id_hotel_room)->first();

            $find->update(array(
                'price' => $request->price,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            // dd($find);

            if ($request->disc == '') {
                $disc = 0;
            } else {
                $disc = $request->disc;
            }

            //special price
            $data = HotelRoomDetailPrice::insertGetId(array(
                'id_hotel' => $find->id_hotel,
                'id_hotel_room' => $request->id_hotel_room,
                'start' => $request->start,
                'end' => $request->end,
                'price' => $request->special_price,
                'disc' => $disc,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
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

    public function special_price_fullcalendar($id)
    {
        // $event = VillaDetailPrice::get();
        $data = HotelRoomDetailPrice::select(
            'id_special_price',
            'id_hotel',
            'id_hotel_room',
            'start',
            'end',
            'price as title',
        )
            ->where('id_hotel_room', '=', $id)
            ->get();

        $event = array(['start' => 0, 'end' => 0, 'title' => 0]);

        $i = 0;

        foreach ($data as $item) {
            $event[$i]['start'] = $item->start;
            $event[$i]['end'] = date('Y-m-d', strtotime($item->end . " +1 days"));
            $event[$i]['title'] = 'IDR ' . $item->title;
            $i++;
        }

        // dd($event);

        return response()->json($event, 200);
    }

    public function fullcalendar_notavailable($id)
    {

        $event = HotelRoomAvailability::select(
            'date',
            'text as title',
            'color',
        )
            ->where('id_hotel_room', '=', $id)
            ->orderBy('date')
            ->get();

        $result = array(['start' => 0, 'end' => 0, 'title' => $event[0]->title, 'color' => $event[0]->color]);

        $i = 0;

        foreach ($event as $data) {
            $date = $data->date;

            if ($result[$i]['start'] == 0) {
                $result[$i]['start'] = $date;
            } else {
                if ($result[$i]['start'] < $date && $result[$i]['end'] == 0) {
                    $result[$i]['end'] = $date;
                }
                if ($result[$i]['end'] != 0 && $result[$i]['end'] < $date) {
                    $startTimeStamp = strtotime($result[$i]['end']);

                    $endTimeStamp = strtotime($date);

                    $timeDiff = abs($endTimeStamp - $startTimeStamp);

                    $numberDays = $timeDiff / 86400;  // 86400 seconds in one day

                    // and you might want to convert to integer
                    $numberDays = intval($numberDays);

                    if ($numberDays == 1) {
                        $result[$i]['end'] = date('Y-m-d', strtotime($date . " +1 days"));
                    } else {
                        $i++;
                        $result[$i]['start'] = $date;
                        $result[$i]['end'] = 0;
                        $result[$i]['title'] = $event[0]->title;
                        $result[$i]['color'] = $event[0]->color;
                    }
                }
                // if ($result[$i]['end'] != 0 && $result[$i]['end'] > $date) {
                //     $i++;
                //     $result[$i]['start'] = $date;
                //     $result[$i]['end'] = 0;
                //     $result[$i]['title'] = $event[0]->title;
                //     $result[$i]['color'] = $event[0]->color;
                // }
            }
        }

        // dd($result);

        return response()->json($result, 200);
    }


    public function room_not_available(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        $hotel = HotelTypeDetail::where('id_hotel_room', $request->id_hotel_room)->first();

        // $dateDb = [];

        // foreach ($villavailability as $v)
        // {
        //     array_push($dateDb, $v->date);
        // }

        $date = [];

        for ($i = $request->start; $i <= $request->end; $i++) {
            array_push($date, $i);
        }
        // $result = !array_diff($date, $dateDb);

        foreach ($date as $key => $value) {
            $data[] = [
                'id_hotel_room' => $request->id_hotel_room,
                'id_hotel' => $hotel->id_hotel,
                'date' => $value,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ];
        }

        // dd($data);

        $store = HotelRoomAvailability::insert($data);

        if ($store) {
            $status = 200;
        }

        // try {
        //     $store = VillaAvailability::create([
        //         'id_villa' => $request->id_villa,
        //         'start_date' => $request->start,
        //         'end_date' => $request->end,
        //         'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
        //         'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
        //         'created_by' => Auth::user()->id,
        //         'updated_by' => Auth::user()->id,
        //     ]);

        //     if ($store) {
        //         $status = 200;
        //     }
        // } catch (\Illuminate\Database\QueryException $e) {
        //     $status = 500;
        // }

        if ($status == 200) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }


    public function video_open($id)
    {
        // $data = VillaVideo::select('villa_video.name as video', 'villa.name as name', 'villa.price as price')
        //     ->join('villa', 'villa_video.id_villa', '=', 'villa.id_villa', 'left')
        //     ->where('villa_video.id_video', $id)->get();

        $data = HotelRoomVideo::with('hotel')->where('id_video', $id)->first();

        if ($data) {
            return response()->json([
                'video' => $data->name,
                'hotel' => (object)[
                    'name' => $data->hotel->name,
                    'uid' => $data->hotel->uid
                ] ?? null
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        echo json_encode($data);
    }

    public function update_room_size(Request $request)
    {
        $this->authorize('listvilla_update');

        $validator = Validator::make($request->all(), [
            'room_size' => ['required', 'integer'],
            'capacity' => ['required', 'integer'],
            'number_of_room' => ['required', 'integer'],
            'id_bed' => ['required']
        ]);

        if ($validator->fails()) {
            abort(500);
        }

        // dd($request);

        $status = 500;

        try {
            $find = HotelTypeDetail::where('id_hotel_room', $request->id_hotel_room)->first();

            $find->update(array(
                'room_size' => $request->room_size,
                'capacity' => $request->capacity,
                'number_of_room' => $request->number_of_room,
                'id_bed' => $request->id_bed,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));

            if ($find) {
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

    public function room_update_amenities(Request $request)
    {
        $this->authorize('listvilla_update');
        $status = 500;

        $hotel = HotelTypeDetail::where('id_hotel_room', $request->id_hotel_room)->first();

        try {
            //insert into database
            HotelTypeDetailAmenities::where('id_hotel_room', $request->id_hotel_room)->delete();
            if (!empty($request->amenities)) {
                foreach ($request->amenities as $row) {
                    HotelTypeDetailAmenities::insert(array(
                        'id_hotel' => $hotel->id_hotel,
                        'id_hotel_room' => $request->id_hotel_room,
                        'id_amenities' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            HotelRoomBathroom::where('id_hotel_room', $request->id_hotel_room)->delete();
            if (!empty($request->bathroom)) {
                foreach ($request->bathroom as $row) {
                    $data = HotelRoomBathroom::insert(array(
                        'id_hotel' => $hotel->id_hotel,
                        'id_hotel_room' => $request->id_hotel_room,
                        'id_bathroom' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
                // foreach ($request->bathroom as $row) {
                //     $find = VillaBathroom::where('id_villa', $request->id_villa)->where('id_bathroom', $row)->first();
                //     if ($find) {
                //         $find->update(array(
                //             'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                //             'updated_by' => Auth::user()->id,
                //         ));
                //     } else {
                //         $data = VillaBathroom::insert(array(
                //             'id_villa' => $request->id_villa,
                //             'id_bathroom' => $row,
                //             'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                //             'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                //             'created_by' => Auth::user()->id,
                //             'updated_by' => Auth::user()->id,
                //         ));
                //     }
                // }
            }

            HotelRoomBedroom::where('id_hotel_room', $request->id_hotel_room)->delete();
            if (!empty($request->bedroom)) {
                foreach ($request->bedroom as $row) {
                    HotelRoomBedroom::insert(array(
                        'id_hotel' => $hotel->id_hotel,
                        'id_hotel_room' => $request->id_hotel_room,
                        'id_bedroom' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            HotelRoomKitchen::where('id_hotel_room', $request->id_hotel_room)->delete();
            if (!empty($request->kitchen)) {
                foreach ($request->kitchen as $row) {
                    HotelRoomKitchen::insert(array(
                        'id_hotel' => $hotel->id_hotel,
                        'id_hotel_room' => $request->id_hotel_room,
                        'id_kitchen' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            HotelRoomSafety::where('id_hotel_room', $request->id_hotel_room)->delete();
            if (!empty($request->safety)) {
                foreach ($request->safety as $row) {
                    HotelRoomSafety::insert(array(
                        'id_hotel' => $hotel->id_hotel,
                        'id_hotel_room' => $request->id_hotel_room,
                        'id_safety' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            HotelRoomService::where('id_hotel_room', $request->id_hotel_room)->delete();
            if (!empty($request->service)) {
                foreach ($request->service as $row) {
                    HotelRoomService::insert(array(
                        'id_hotel' => $hotel->id_hotel,
                        'id_hotel_room' => $request->id_hotel_room,
                        'id_service' => $row,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            $status = 200;
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

    public function update_position_photo(Request $request)
    {
        abort_if(!auth()->check(), 401);
        $validator = Validator::make($request->all(), [
            'imageids' => ['required', 'array'],
            'id' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            abort(500);
        }

        $imageids_arr = $request->imageids;

        $hotelRoom = HotelTypeDetail::where('id_hotel_room', $request->id)->first();

        abort_if(!$hotelRoom, 404);

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotelRoom->created_by) {
            abort(403);
        }

        if (count($imageids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($imageids_arr as $id) {
                $find = HotelRoomPhoto::where('id_photo', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            return response()->json([
                'message' => 'data has been updated'
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function update_position_video(Request $request)
    {
        abort_if(!auth()->check(), 401);
        $validator = Validator::make($request->all(), [
            'videoids' => ['required', 'array'],
            'id' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            abort(500);
        }

        $videoids_arr = $request->videoids;

        $hotelRoom = HotelTypeDetail::where('id_hotel_room', $request->id)->first();

        abort_if(!$hotelRoom, 404);

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotelRoom->created_by) {
            abort(403);
        }

        if (count($videoids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($videoids_arr as $id) {
                $find = HotelRoomVideo::where('id_video', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            return response()->json([
                'message' => 'data has been updated'
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function room_update_name(Request $request)
    {
        // dd($request->all());
        $this->authorize('listvilla_update');
        $status = 500;

        try {
            $find = HotelTypeDetail::where('id_hotel_room', $request->id_hotel_room)->first();

            if (Auth::user()->id == 1 || Auth::user()->id == 2) {
                $find->update(array(
                    'name' => $request->hotel_room_name,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_by' => Auth::user()->id,
                ));
            } else {
                $find->update(array(
                    'name' => $request->hotel_room_name,
                    'original_name' => $request->hotel_room_name,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_by' => Auth::user()->id,
                ));
            }

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            // return back()
            //     ->with('success', 'Your data has been updated');
            return response()->json(['success' => true, 'message' => 'Succesfully Updated Villa Name',  'data' => $request->hotel_room_name]);
        } else {
            // return back()
            //     ->with('error', 'Please check the form below for errors');
            return response()->json(['errors' => true, 'message' => 'Succesfully Updated Villa Name',  'data' => $request->hotel_room_name]);
        }
    }

    public function room_update_caption_photo(Request $request)
    {
        $this->authorize('listvilla_update');

        $status = 500;

        try {
            $hotel = HotelRoomPhoto::where('id_photo', $request->id_photo)->first();

            $update = $hotel->update([
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

    public function hotel_room_request_video($id, $name)
    {
        NotificationOwner::create(array(
            'id_user' => $id,
            'message' => 'Someone request a video in room ' . $name,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8)
        ));

        return response()->json([
            'message' => 'Success sent a message to Owner',
            'status' => 200,
        ], 200);
    }
}
