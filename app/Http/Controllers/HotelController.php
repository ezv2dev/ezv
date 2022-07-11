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
        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        $hotel = Hotel::with([
            'propertyType', 'favorit', 'location', 'photo', 'video', 'detailReview',
        ])->where('status', 1)->paginate(env('CONTENT_PER_PAGE_LIST_HOTEL'));

        $amenities = Amenities::all();

        $property_type = HotelType::all();
        $hotelCategory = HotelCategory::all();
        $hotelFilter = HotelFilter::all();

        return view('user.hotel.list_hotel', compact('hotel', 'req', 'amenities', 'property_type', 'hotelCategory', 'hotelFilter'));
    }

    public function store_gallery(Request $request)
    {
        $this->authorize('listvilla_create');

        // validation
        $validator = Validator::make($request->all(), [
            'id_hotel' => ['required', 'integer'],
            'file' => ['required', 'mimes:jpeg,png,jpg,webp,mp4']
        ]);
        if ($validator->fails()) {
            abort(500);
        }

        $status = 500;

        try {
            $berkas = $request->file;
            if (empty($berkas)) {
                //
            } else {
                //cek the directori first
                $hotel = Hotel::where('id_hotel', $request->id_hotel)->first();
                // $folder = strtolower($find[0]->name);
                // $path = public_path() . '/foto/gallery/' . $folder;
                $folder = strtolower($hotel->uid);
                $path = env("HOTEL_FILE_PATH") . $folder;

                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $ext = strtolower($berkas->getClientOriginalExtension());

                if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
                    request()->validate([
                        'id_hotel' => ['required', 'integer'],
                        'file' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960']
                    ]);

                    $original_name = $berkas->getClientOriginalName();

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
                    $data = HotelPhoto::create([
                        'name' => $name_file,
                        'id_hotel' => $request->id_hotel,
                        'order' => $lastOrder,
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id
                    ]);
                } elseif ($ext == 'mp4') {
                    $original_name = $berkas->getClientOriginalName();

                    $name_file = time() . "_" . $original_name;

                    // isi dengan nama folder tempat kemana file diupload
                    $berkas->move($path, $name_file);

                    $lastOrder = HotelVideo::where('id_hotel', $request->id_hotel)->orderBy('order', 'desc')->select('order')->first();
                    if ($lastOrder) {
                        $lastOrder = $lastOrder->order + 1;
                    } else {
                        $lastOrder = 1;
                        $lastOrder;
                    }

                    //insert into database
                    $data = HotelVideo::create([
                        'name' => $name_file,
                        'id_hotel' => $request->id_hotel,
                        'order' => $lastOrder,
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id
                    ]);
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
        // $path = public_path() . '/foto/gallery/' . $villa->name;
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
        // $path = public_path() . '/foto/gallery/' . $villa->name;
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
