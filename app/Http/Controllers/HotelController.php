<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\Hotel;
use App\Models\HotelAmenities;
use App\Models\HotelBathroom;
use App\Models\HotelBedroom;
use App\Models\HotelCategory;
use App\Models\HotelDetailReview;
use App\Models\HotelFilter;
use App\Models\HotelKitchen;
use App\Models\HotelPhoto;
use App\Models\HotelSafety;
use App\Models\HotelSave;
use App\Models\HotelService;
use App\Models\HotelStory;
use App\Models\HotelVideo;
use App\Models\HotelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Auth;
use Illuminate\Support\Facades\Validator;

use App\Services\FileCompressionService as FileCompression;

class HotelController extends Controller
{
    public static function get_name()
    {
        // $location = Location::inRandomOrder()->limit(5)->get();
        $hotel_name = Hotel::inRandomOrder()->select('name', 'id_hotel')->where('status', 1)->get();
        return $hotel_name;
    }

    public function hotel_list()
    {
        $hotel = Hotel::with([
            'location', 'photo', 'video', 'detailReview'
        ])->where('status', 1)->inRandomOrder()->paginate(env('CONTENT_PER_PAGE_LIST_HOTEL'));

        $amenities = Amenities::all();
        $hotelCategory = HotelCategory::all();
        $hotelFilter = HotelFilter::all();

        // ! Airport
        $i = 0;
        $j = 0;
        $near = array();
        foreach ($hotel as $item) {
            $point1 = array('lat' => $item->latitude, 'long' => $item->longitude, 'name' => $item->name);
            $airportPoint = array('lat2' => -8.7433916, 'long2' => 115.1644194);

            $lat1 = $point1['lat'];
            $lon1 = $point1['long'];
            $lat2 = $airportPoint['lat2'];
            $lon2 = $airportPoint['long2'];
            $name = 'Ngurah Rai Airport';
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
            $hotel[$i]['km'] = $near[0][0];
            $hotel[$i]['airport'] = $near[0][1];

            $i++;
        }
        // ! End Airport

        return view('user.hotel.list_hotel', compact('hotel', 'hotelCategory', 'hotelFilter'));
    }

    public function store_gallery(Request $request)
    {
        //Test baru
        $hotel = Hotel::find($request->id_hotel);

        // check if restaurant does not exist, abort 404
        if (!$hotel) {
            return response()->json([
                'message' => 'Hotel Not Found'
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('listvilla_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotel->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized'
            ], 403);
        }

        // store process
        // $path = public_path() . '/foto/restaurant/' . $restaurant->name;
        $folder = strtolower($hotel->uid);
        $path = env("HOTEL_FILE_PATH") . $folder;

        if (!File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->file->getClientOriginalExtension());

        $photo = [];

        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
            $validator2 = Validator::make($request->all(), [
                'id_hotel' => ['required', 'integer'],
                'file' => ['required', 'dimensions:min_width=960']
            ]);

            if ($validator2->fails()) {
                return response()->json([
                    'message' => $validator2->errors()->all(),
                ], 500);
            }

            $original_name = $request->file->getClientOriginalName();

            $name_file = time() . "_" . $original_name;

            $name_file = FileCompression::compressImageToCustomExt($request->file, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

            // check last order
            $lastOrder = HotelPhoto::where('id_hotel', $request->id_hotel)->orderBy('order', 'desc')->select('order')->first();
            if ($lastOrder) {
                $lastOrder = $lastOrder->order + 1;
            } else {
                $lastOrder = 1;
                $lastOrder;
            }

            //insert into database
            $createdVilla = HotelPhoto::create([
                'id_hotel' => $request->id_hotel,
                'name' => $name_file,
                'order' => $lastOrder,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);

            // $photo['id_photo'] = $createdRestaurant->id_photo;
            array_push($photo, $createdVilla->id_photo);
        }

        $video = [];

        if ($ext == 'mp4' || $ext == 'mov') {
            $original_name = $request->file->getClientOriginalName();
            // dd($original_name);
            $name_file = time() . "_" . $original_name;
            // isi dengan nama folder tempat kemana file diupload
            $request->file->move($path, $name_file);

            // check last order
            $lastOrder = HotelVideo::where('id_hotel', $request->id_hotel)->orderBy('order', 'desc')->select('order')->first();
            if ($lastOrder) {
                $lastOrder = $lastOrder->order + 1;
            } else {
                $lastOrder = 1;
                $lastOrder;
            }

            //insert into database
            $createdVilla = HotelVideo::create([
                'id_hotel' => $request->id_hotel,
                'name' => $name_file,
                'order' => $lastOrder,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);

            array_push($video, $createdVilla->id_video);
        }

        $hotelReturn = [
            'photo' => HotelPhoto::whereIn('id_photo', $photo)->get(),
            'video' => HotelVideo::whereIn('id_video', $video)->get(),
            'uid' => Hotel::where('id_hotel', $request->id_hotel)->select('uid')->first(),
        ];


        if (isset($createdVilla) == true) {
            return response()->json([
                'message' => 'Update Gallery Hotel',
                'data' => $hotelReturn,
            ], 200);
        } else if (isset($createdVilla) == false) {
            $validator = Validator::make($request->all(), [
                'id_hotel' => ['required', 'integer'],
                'file' => ['required', 'mimes:jpeg,png,jpg,webp,mp4,mov']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                ], 500);
            }
        }
    }

    public function hotel_delete_photo_photo(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id_photo || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $hotel = Hotel::find($request->id);
        $hotelPhoto = HotelPhoto::find($request->id_photo);
        abort_if(!$hotel, 404);
        abort_if(!$hotelPhoto, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotelPhoto->created_by;
        abort_if($condition, 403);

        // delete photo
        // $path = public_path() . '/foto/gallery/' . $hotel->name;
        $folder = strtolower($hotel->uid);
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

    public function hotel_delete_photo_video(Request $request)
    {
        $this->authorize('listvilla_delete');
        abort_if(!$request->id_video || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $hotel = Hotel::find($request->id);
        $hotelVideo = HotelVideo::find($request->id_video);
        abort_if(!$hotel, 404);
        abort_if(!$hotelVideo, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $hotelVideo->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $hotel->name;
        $folder = strtolower($hotel->uid);
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

    public function like_hotel(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect(route('login'));
        }

        // check if there same favorit content
        $checkSameFavorit = HotelSave::where([
            ['id_hotel', '=', $request->hotel],
            ['id_user', '=', $request->user],
        ])->first();

        if ($checkSameFavorit != null) {
            $checkSameFavorit->delete();
            $data = 0;
            return $data;
        } else {
            // otherwise, create favorit
            $data = HotelSave::create([
                'id_hotel' => $request->hotel,
                'id_user' => $request->user,
                'created_by' => $request->user,
                'updated_by' => $request->user
            ]);

            $data = 1;
            return $data;
        };
    }
}
