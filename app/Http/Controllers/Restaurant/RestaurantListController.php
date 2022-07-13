<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Auth;
use App\Models\Amenities;
use App\Models\RestaurantMenu;
use App\Models\RestaurantPhoto;
use App\Models\RestaurantStory;
use App\Models\RestaurantVideo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use File;
use Illuminate\Support\Facades\Storage;
use App\Models\Location;
use App\Models\PropertyTypeVilla;
use App\Models\RestaurantType;
use App\Models\RestaurantPrice;
use App\Models\RestaurantFacilities;
use App\Models\RestaurantMeal;
use App\Models\RestaurantCuisine;
use App\Models\RestaurantDishes;
use App\Models\RestaurantDietaryFood;
use App\Models\RestaurantGoodfor;
use App\Models\RestaurantHasCuisine;
use App\Models\RestaurantHasDietaryfood;
use App\Models\RestaurantHasDishes;
use App\Models\RestaurantHasFacilities;
use App\Models\RestaurantHasGoodfor;
use App\Models\RestaurantHasMeal;
use App\Services\FileCompressionService as FileCompression;
use App\Models\Villa;
use App\Services\DeviceCheckService;
use App\Models\Activity;
use App\Models\Hotel;
use Illuminate\Validation\Rule;
use App\Models\RestaurantHasSubCategory;
use App\Models\RestaurantSubCategory;
use Illuminate\Database\Eloquent\Collection;

class RestaurantListController extends Controller
{
    public function restaurant_list(Request $request)
    {
        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        if ($request->location == '') {
            $restaurant = Restaurant::where('status', 1)->get();
        } else {
            $restaurant = Restaurant::whereHas('location', function (Builder $query) use ($request) {
                $query->where('name', 'like', '%' . $request->location . '%');
            })->where('status', 1)->get();
        }

        // dd($restaurant);

        $amenities = Amenities::all();
        $locations = Location::all();
        $types = RestaurantType::all();
        $facilities = RestaurantFacilities::all();
        $meals = RestaurantMeal::all();
        $prices = RestaurantPrice::all();
        $cuisines = RestaurantCuisine::all();
        $dishes = RestaurantDishes::all();
        $dietaryfoods = RestaurantDietaryFood::all();
        $goodfors = RestaurantGoodfor::all();
        $property_type = PropertyTypeVilla::all();
        $categories = RestaurantCuisine::all();
        $subcategories = RestaurantSubCategory::all();

        $restaurantIds = collect($restaurant->modelKeys());
        $restaurant = Restaurant::with([
            'location',
            'cuisine',
            'detailReview',
            'menu'
        ])->whereIn('id_restaurant', $restaurantIds)->orderByRaw("FIELD(grade, \"A\", \"B\", \"C\", \"D\")")->paginate(env('CONTENT_PER_PAGE_LIST_RESTAURANT'));

        $restaurant->each(function ($item, $key) {
            $item->setAppends(['villa_nearby', 'activity_nearby', 'hotel_nearby']);
        });

        // if (DeviceCheckService::isMobile()) {
        //     return view('user.m-list_restaurant', compact(
        //         'restaurant',
        //         'amenities',
        //         'locations',
        //         'types',
        //         'facilities',
        //         'meals',
        //         'prices',
        //         'cuisines',
        //         'dishes',
        //         'dietaryfoods',
        //         'goodfors',
        //         'property_type',
        //         'categories',
        //         'subcategories'
        //     ));
        // }
        // if (DeviceCheckService::isDesktop()) {
        //     return view('user.list_restaurant', compact(
        //         'restaurant',
        //         'amenities',
        //         'locations',
        //         'types',
        //         'facilities',
        //         'meals',
        //         'prices',
        //         'cuisines',
        //         'dishes',
        //         'dietaryfoods',
        //         'goodfors',
        //         'property_type',
        //         'categories',
        //         'subcategories'
        //     ));
        // }
        return view('user.list_restaurant', compact(
            'restaurant',
            'amenities',
            'locations',
            'types',
            'facilities',
            'meals',
            'prices',
            'cuisines',
            'dishes',
            'dietaryfoods',
            'goodfors',
            'property_type',
            'categories',
            'subcategories'
        ));
    }

    public function restaurant_update_name(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer'],
            'name' => ['required', 'max:100'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 500);
        }

        // restaurant data
        $restaurant = Restaurant::find($request->id);

        // check if restaurant does not exist, abort 404
        if (!$restaurant)
        {
            return response()->json([
                'message' => 'Restaurant Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $updatedRestaurant = $restaurant->update([
            'name' => $request->name,
            'updated_by' => auth()->user()->id,
        ]);

        $restaurantData = Restaurant::where('id_restaurant', $request->id)->select('name')->first();

        // check if update is success or not
        if ($updatedRestaurant) {
            return response()->json([
                'message' => 'Updated Name Restaurant',
                'data' => $restaurantData
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Updated Name Restaurant',
            ], 500);
        }
    }

    public function restaurant_update_contact(Request $request)
    {
        // check if editor not authenticated
        if(!auth()->check())
        {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $rules = [
            'id_restaurant' => ['required', 'integer'],
            'phone' => ['numeric'],
            'email' => ['email']
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 500);
        }

        // restaurant data
        $restaurant = Restaurant::find($request->id_restaurant);

        // check if restaurant does not exist, abort 404
        if(!$restaurant){
            return response()->json([
                'message' => 'Food Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        if ($request->email) {
            $updatedRestaurant = $restaurant->update([
                'email' => $request->email,
                'updated_by' => auth()->user()->id,
            ]);
        }
        if ($request->phone) {
            $updatedRestaurant = $restaurant->update([
                'phone' => $request->phone,
                'updated_by' => auth()->user()->id,
            ]);
        }

        $data = Restaurant::where('id_restaurant', $request->id_restaurant)->select('email', 'phone')->first();

        // check if update is success or not
        if ($updatedRestaurant) {
            return response()->json([
                'message' => 'Updated Email or Phone Restaurant',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Updated Email or Phone Restaurant',
            ], 500);
        }
    }

    public function restaurant_update_type(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'id_restaurant' => ['required', 'integer'],
            'id_type' => ['required', Rule::in(RestaurantType::all()->modelKeys())],
            'id_price' => ['required', Rule::in(RestaurantPrice::all()->modelKeys())]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There is something error',
            ], 500);
        }

        // restaurant data
        $restaurant = Restaurant::find($request->id_restaurant);

        // check if restaurant does not exist, abort 404
        if (!$restaurant)
        {
            return response()->json([
                'message' => 'Restaurant Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        if ($request->id_type) {
            $updatedRestaurant = $restaurant->update([
                'id_type' => $request->id_type,
                'updated_by' => auth()->user()->id,
            ]);
        }

        if ($request->id_price) {
            $updatedRestaurant = $restaurant->update([
                'id_price' => $request->id_price,
                'updated_by' => auth()->user()->id,
            ]);
        }

        $getType = RestaurantType::where('id_type', $request->id_type)->first();
        $getPrice = RestaurantPrice::where('id_price', $request->id_price)->first();

        $data = [
            'id_price' => $request->id_price,
            'id_type' => $request->id_type,
            'type' => $getType->name,
            'price' => $getPrice->name,
        ];

        // check if update is success or not
        if ($updatedRestaurant) {
            return response()->json([
                'message' => 'Updated Type or Price Restaurant',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Updated Type or Price Restaurant',
            ], 500);
        }
    }

    public function restaurant_update_description(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'id_restaurant' => ['required', 'integer'],
            'description' => ['string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There is something error',
            ], 500);
        }

        // restaurant data
        $restaurant = Restaurant::find($request->id_restaurant);

        // check if restaurant does not exist, abort 404
        if (!$restaurant)
        {
            return response()->json([
                'message' => 'Restaurant Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $updatedRestaurant = $restaurant->update([
            'description' => str_replace(array("\n", "\r"), ' ', $request->description),
            'updated_by' => auth()->user()->id,
        ]);

        $data = Restaurant::where('id_restaurant', $request->id_restaurant)->select('description')->first();

        // check if update is success or not
        if ($updatedRestaurant) {
            return response()->json([
                'message' => 'Updated Description Restaurant',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Updated Description Restaurant',
            ], 500);
        }
    }

    public function restaurant_update_short_description(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer'],
            'short_desc' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 500);
        }

        // restaurant data
        $restaurant = Restaurant::find($request->id);

        // check if restaurant does not exist, abort 404
        if (!$restaurant)
        {
            return response()->json([
                'message' => 'Restaurant Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $updatedRestaurant = Restaurant::where('id_restaurant', $request->id)->update([
            'short_description' => str_replace(array("\n", "\r"), ' ', $request->short_desc),
            'updated_by' => auth()->user()->id,
        ]);

        $restaurantData = Restaurant::where('id_restaurant', $request->id)->select('short_description')->first();

        // check if update is success or not
        if ($updatedRestaurant) {
            return response()->json([
                'message' => 'Updated Restaurant Short Description',
                'data' => $restaurantData
            ], 200);
        } else {
            return response()->json([
                'message' => 'Updated Restaurant Short Description',
            ], 500);
        }
    }

    public function restaurant_update_location(Request $request)
    {
        // dd($request->all());
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        $validator = Validator::make($request->all(), [
            'id_restaurant' => ['required', 'integer'],
            'id_location' => ['required', 'integer'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);
        if ($validator->fails()) {
            abort(500);
        }

        // restaurant data
        $restaurant = Restaurant::find($request->id_restaurant);

        // check if restaurant does not exist, abort 404
        abort_if(!$restaurant, 404);

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            abort(403);
        }

        // update
        $updatedRestaurant = $restaurant->update([
            'id_restaurant' => $request->id_restaurant,
            'id_location' => $request->id_location,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'updated_by' => auth()->user()->id,
        ]);
        // check if update is success or not
        if ($updatedRestaurant) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function restaurant_get_time(Request $request)
    {
        $restaurant = Restaurant::where('id_restaurant', $request->id_restaurant)->select('open_time','closed_time')->first();

        $openTime = date('H:i', strtotime($restaurant->open_time));
        $closedTime = date('H:i', strtotime($restaurant->closed_time));

        $data = [
            'open_time' => $openTime,
            'closed_time' => $closedTime,
        ];

        return response()->json([
            'data' => $data,
            'message' => 'Get Detail Restaurant Time',
        ]);
    }

    public function restaurant_update_time(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'id_restaurant' => ['required', 'integer'],
            'open_time' => ['required'],
            'closed_time' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There is something error',
            ], 500);
        }

        // restaurant data
        $restaurant = Restaurant::find($request->id_restaurant);

        // check if restaurant does not exist, abort 404
        if (!$restaurant)
        {
            return response()->json([
                'message' => 'Restaurant Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $updatedRestaurant = $restaurant->update([
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
        if ($updatedRestaurant) {
            return response()->json([
                'message' => 'Updated Restaurant Time',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Updated Restaurant Time',
            ], 500);
        }
    }

    public function restaurant_store_menu(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        request()->validate([
            'id_restaurant' => ['required', 'integer'],
            'image' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960']
        ]);

        // restaurant data
        $restaurant = Restaurant::find($request->id_restaurant);

        // check if restaurant does not exist, abort 404
        abort_if(!$restaurant, 404);

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            abort(403);
        }

        // store process
        $folder = strtolower($restaurant->uid);
        $path = env("RESTAURANT_FILE_PATH") . $folder . '/menu';
        // $path = public_path() . '/foto/restaurant/' . $restaurant->name . '/menu';
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
            $createdRestaurant = RestaurantMenu::create([
                'id_restaurant' => $request->id_restaurant,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'foto' => $name_file,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);
        }

        // check if update is success or not
        if ($createdRestaurant) {
            return back()
                ->with('success', 'Your data has been created');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function restaurant_store_menu_multi(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        request()->validate([
            'id_restaurant' => ['required', 'integer'],
            'file' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960']
        ]);

        // restaurant data
        $restaurant = Restaurant::find($request->id_restaurant);

        // check if restaurant does not exist, abort 404
        abort_if(!$restaurant, 404);

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            abort(403);
        }

        // store process
        $folder = strtolower($restaurant->uid);
        $path = env("RESTAURANT_FILE_PATH") . $folder . '/menu';
        // $path = public_path() . '/foto/restaurant/' . $restaurant->name . '/menu';
        if (!File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->file->getClientOriginalExtension());

        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
            $original_name = $request->file->getClientOriginalName();
            // dd($original_name);
            $name_file = time() . "_" . $original_name;
            $name_file = FileCompression::compressImageToCustomExt($request->file, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

            //insert into database
            $createdRestaurant = RestaurantMenu::create([
                'id_restaurant' => $request->id_restaurant,
                'foto' => $name_file,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);
        }

        // check if update is success or not
        if ($createdRestaurant) {
            return back()
                ->with('success', 'Your data has been created');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function restaurant_delete_menu(Request $request)
    {
        abort_if(!auth()->check(), 401);
        abort_if(!$request->id_menu || !$request->id, 500);

        $restaurant = Restaurant::find($request->id);
        $restaurantMenu = RestaurantMenu::find($request->id_menu);
        abort_if(!$restaurant, 404);
        abort_if(!$restaurantMenu, 404);

        $this->authorize('restaurant_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $restaurant->name;
        $folder = strtolower($restaurant->uid);
        $path = env("RESTAURANT_FILE_PATH") . $folder . '/menu';

        // remove old video
        if (File::exists($path . '/' . $restaurantMenu->foto)) {
            File::delete($path . '/' . $restaurantMenu->foto);
        }

        $deletedRestaurantMenu = $restaurantMenu->delete();
        // check if delete is success or not
        if ($deletedRestaurantMenu) {
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

    public function restaurant_update_image(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'id_restaurant' => ['required', 'integer'],
            'image' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 500);
        }
        // restaurant data
        $restaurant = Restaurant::find($request->id_restaurant);

        // check if restaurant does not exist, abort 404
        if (!$restaurant)
        {
            return response()->json([
                'message' => 'Food Not Found',
                'status' => 404,
            ]);
        }

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
                'status' => 403,
            ]);
        }

        // image path
        // $path = public_path() . '/foto/restaurant/' . $restaurant->name;
        $folder = strtolower($restaurant->uid);
        $path = env("RESTAURANT_FILE_PATH") . $folder;

        // remove old image
        if (File::exists($path . '/' . $restaurant->image)) {
            File::delete($path . '/' . $restaurant->image);
        }

        // store process
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->image->getClientOriginalExtension());

        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
            $original_name = $request->image->getClientOriginalName();

            $name_file = time() . "_" . $original_name;
            $name_file = FileCompression::compressImageToCustomExt($request->image, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

            //insert into database
            $updatedRestaurant = $restaurant->update([
                'image' => $name_file,
                'updated_by' => auth()->user()->id
            ]);
        }

        $restaurantData = Restaurant::where('id_restaurant', $request->id_restaurant)->select('image')->first();

        // check if update is success or not
        if ($updatedRestaurant) {
            return response()->json([
                'message' => 'Updated Restaurant Profile',
                'data' => $restaurantData
            ], 200);
        } else {
            return response()->json([
                'message' => 'Updated Restaurant Short Description',
            ], 500);
        }
    }

    public function restaurant_delete_image(Request $request)
    {
        abort_if(!auth()->check(), 401);
        abort_if(!$request->id, 500);

        $restaurant = Restaurant::find($request->id);
        abort_if(!$restaurant, 404);

        $this->authorize('restaurant_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $restaurant->name;
        $folder = strtolower($restaurant->uid);
        $path = env("RESTAURANT_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $restaurant->image)) {
            File::delete($path . '/' . $restaurant->image);
        }

        $deletedRestaurantImage = $restaurant->update([
            'image' => NULL,
            'updated_by' => auth()->user()->id
        ]);

        // check if delete is success or not
        if ($deletedRestaurantImage) {
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

    public function restaurant_store_photo(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        $validator = Validator::make($request->all(), [
            'id_restaurant' => ['required', 'integer'],
            'file' => ['required', 'mimes:jpeg,png,jpg,webp,mp4,mov']
        ]);
        if ($validator->fails()) {
            abort(500);
        }

        // restaurant data
        $restaurant = Restaurant::find($request->id_restaurant);

        // check if restaurant does not exist, abort 404
        abort_if(!$restaurant, 404);

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            abort(403);
        }

        // store process
        // $path = public_path() . '/foto/restaurant/' . $restaurant->name;
        $folder = strtolower($restaurant->uid);
        $path = env("RESTAURANT_FILE_PATH") . $folder;

        if (!File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->file->getClientOriginalExtension());

        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
            request()->validate([
                'id_restaurant' => ['required', 'integer'],
                'file' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960']
            ]);

            $original_name = $request->file->getClientOriginalName();

            $name_file = time() . "_" . $original_name;

            $name_file = FileCompression::compressImageToCustomExt($request->file, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

            // check last order
            $lastOrder = RestaurantPhoto::where('id_restaurant', $request->id_restaurant)->orderBy('order', 'desc')->select('order')->first();
            if ($lastOrder) {
                $lastOrder = $lastOrder->order + 1;
            } else {
                $lastOrder = 1;
                $lastOrder;
            }

            //insert into database
            $createdRestaurant = RestaurantPhoto::create([
                'id_restaurant' => $request->id_restaurant,
                'name' => $name_file,
                'order' => $lastOrder,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);
        }

        if ($ext == 'mp4' || $ext == 'mov') {
            $original_name = $request->file->getClientOriginalName();
            // dd($original_name);
            $name_file = time() . "_" . $original_name;
            // isi dengan nama folder tempat kemana file diupload
            $request->file->move($path, $name_file);

            // check last order
            $lastOrder = RestaurantVideo::where('id_restaurant', $request->id_restaurant)->orderBy('order', 'desc')->select('order')->first();
            if ($lastOrder) {
                $lastOrder = $lastOrder->order + 1;
            } else {
                $lastOrder = 1;
                $lastOrder;
            }

            //insert into database
            $createdRestaurant = RestaurantVideo::create([
                'id_restaurant' => $request->id_restaurant,
                'name' => $name_file,
                'order' => $lastOrder,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);
        }

        // check if update is success or not
        if ($createdRestaurant) {
            return back()
                ->with('success', 'Your data has been created');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function restaurant_delete_photo_video(Request $request)
    {
        abort_if(!auth()->check(), 401);
        abort_if(!$request->id_video || !$request->id, 500);

        $restaurant = Restaurant::find($request->id);
        $restaurantVideo = RestaurantVideo::find($request->id_video);
        abort_if(!$restaurant, 404);
        abort_if(!$restaurantVideo, 404);

        $this->authorize('restaurant_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $restaurant->name;
        $folder = strtolower($restaurant->uid);
        $path = env("RESTAURANT_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $restaurantVideo->name)) {
            File::delete($path . '/' . $restaurantVideo->name);
        }

        $deletedRestaurantVideo = $restaurantVideo->delete();
        // check if delete is success or not
        if ($deletedRestaurantVideo) {
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

    public function restaurant_delete_photo_photo(Request $request)
    {
        abort_if(!auth()->check(), 401);
        abort_if(!$request->id_photo || !$request->id, 500);

        $restaurant = Restaurant::find($request->id);
        $restaurantPhoto = RestaurantPhoto::find($request->id_photo);
        abort_if(!$restaurant, 404);
        abort_if(!$restaurantPhoto, 404);

        $this->authorize('restaurant_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by;
        abort_if($condition, 403);

        // delete photo
        // $path = public_path() . '/foto/gallery/' . $restaurant->name;
        $folder = strtolower($restaurant->uid);
        $path = env("RESTAURANT_FILE_PATH") . $folder;

        // remove old photo
        if (File::exists($path . '/' . $restaurantPhoto->name)) {
            File::delete($path . '/' . $restaurantPhoto->name);
        }

        $deletedRestaurantPhoto = $restaurantPhoto->delete();
        // check if delete is success or not
        if ($deletedRestaurantPhoto) {
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

    public function restaurant_store_facilities(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'id_restaurant' => ['required', 'integer'],
            'facilities' => ['array']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }
        // $request->validate([
        //     'id_restaurant' => ['required', 'integer'],
        //     'facilities' => ['required', 'array']
        // ]);

        // restaurant data
        $restaurant = Restaurant::find($request->id_restaurant);

        // check if restaurant does not exist, abort 404
        if (!$restaurant)
        {
            return response()->json([
                'message' => 'Restaurant Not Found',
                'status' => 404,
            ]);
        }

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
                'status' => 403,
            ]);
        }

        // update restaurant has facilities
        if ($request->facilities) {
            $restaurant->facilities()->detach();
            foreach ($request->facilities as $id_facilities) {
                RestaurantHasFacilities::create([
                    'id_restaurant' => $request->id_restaurant,
                    'id_facilities' => $id_facilities,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id
                ]);
            }
            $updatedRestaurant = true;
        } else {
            $updatedRestaurant = $restaurant->facilities()->detach();
        }

        $facilities = $restaurant->facilities;

        // check if update is success or not
        if ($updatedRestaurant) {
            return response()->json([
                'message' => 'Updated Restaurant Facilities',
                'status' => 200,
                'data' => $facilities,
            ]);
        } else {
            return response()->json([
                'message' => 'Updated Restaurant Facilities',
                'status' => 500,
            ]);
        }
    }

    public function restaurant_store_story(Request $request)
    {
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        $validator = Validator::make($request->all(), [
            'id_restaurant' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:100'],
            'file' => ['required', 'mimes:mp4']
        ]);
        if ($validator->fails()) {
            abort(500);
        }

        // restaurant data
        $restaurant = Restaurant::find($request->id_restaurant);

        // check if restaurant does not exist, abort 404
        abort_if(!$restaurant, 404);

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            abort(403);
        }

        // store process
        // $path = public_path() . '/foto/restaurant/' . $restaurant->name;
        $folder = strtolower($restaurant->uid);
        // dd($folder);
        $path = env("RESTAURANT_FILE_PATH") . $folder;
        // dd($path);

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
            $createdStory = RestaurantStory::create([
                'id_restaurant' => $request->id_restaurant,
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

    public function restaurant_delete_story(Request $request)
    {
        abort_if(!auth()->check(), 401);
        abort_if(!$request->id_story || !$request->id, 500);

        $restaurant = Restaurant::find($request->id);
        $restaurantStory = RestaurantStory::find($request->id_story);
        abort_if(!$restaurant, 404);
        abort_if(!$restaurantStory, 404);

        $this->authorize('restaurant_update');
        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $restaurant->name;
        $folder = strtolower($restaurant->uid);
        $path = env("RESTAURANT_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $restaurantStory->name)) {
            File::delete($path . '/' . $restaurantStory->name);
        }

        $deletedRestaurantStory = $restaurantStory->delete();
        // check if delete is success or not
        if ($deletedRestaurantStory) {
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

    public function restaurant_store_tag(Request $request)
    {
        // check if editor not authenticated
        // abort_if(!auth()->check(), 401);

        // validation
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer'],
            'cuisine' => ['array'],
            'dietaryfood' => ['array'],
            'dishes' => ['array'],
            'goodfor' => ['array'],
            'meal' => ['array'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There is something error',
            ], 500);
        }

        // restaurant data
        $restaurant = Restaurant::find($request->id);

        // check if restaurant does not exist, abort 404
        if (!$restaurant)
        {
            return response()->json([
                'message' => 'Restaurant Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('restaurant_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $restaurant->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        try {
            $restaurant->cuisine()->detach();
            if ($request->cuisine) {
                foreach ($request->cuisine as $id_cuisine) {
                    RestaurantHasCuisine::create([
                        'id_restaurant' => $request->id,
                        'id_cuisine' => $id_cuisine,
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id
                    ]);
                }
            }

            $restaurant->dietaryfood()->detach();
            if ($request->dietaryfood) {
                foreach ($request->dietaryfood as $id_dietaryfood) {
                    RestaurantHasDietaryfood::create([
                        'id_restaurant' => $request->id,
                        'id_dietaryfood' => $id_dietaryfood,
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id
                    ]);
                }
            }

            $restaurant->dishes()->detach();
            if ($request->dishes) {
                foreach ($request->dishes as $id_dishes) {
                    RestaurantHasDishes::create([
                        'id_restaurant' => $request->id,
                        'id_dishes' => $id_dishes,
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id
                    ]);
                }
            }

            $restaurant->goodfor()->detach();
            if ($request->goodfor) {
                foreach ($request->goodfor as $id_goodfor) {
                    RestaurantHasGoodfor::create([
                        'id_restaurant' => $request->id,
                        'id_goodfor' => $id_goodfor,
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id
                    ]);
                }
            }

            $restaurant->meal()->detach();
            if ($request->meal) {
                foreach ($request->meal as $id_meal) {
                    RestaurantHasMeal::create([
                        'id_restaurant' => $request->id,
                        'id_meal' => $id_meal,
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id
                    ]);
                }
            }

            $status = 200;
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        $tags = new Collection();
        $tags = $tags->concat($restaurant->cuisine)
            ->concat($restaurant->dietaryfood)
            ->concat($restaurant->dishes)
            ->concat($restaurant->goodfor)
            ->concat($restaurant->meal);

        $cuisines = $restaurant->cuisine;
        $dietaryfoods = $restaurant->dietaryfood;
        $dishes = $restaurant->dishes;
        $goodfors = $restaurant->goodfor;
        $meals = $restaurant->meal;

        if ($status == 200) {
            return response()->json([
                'message' => 'Updated Restaurant Category',
                'data' => [
                    'tags' => $tags,
                    'cuisine' => $cuisines,
                    'dishes' => $dishes,
                    'dietaryfood' => $dietaryfoods,
                    'goodfor' => $goodfors,
                    'meal' => $meals,
                ],
            ], 200);
        } else {
            return response()->json([
                'message' => 'Updated Restaurant Category',
            ], 500);
        }
    }

    public function restaurant_video(Request $request)
    {
        $id = $request->id;
        $video = RestaurantVideo::where('id_video', $id)->orderBy('order', 'desc')->first();
        if ($video) {
            return response()->json($video, 200);
        }
        return response()->json([]);
    }

    public function restaurant_story(Request $request)
    {
        // validation
        // $validator = Validator::make($request->all(), [
        //     'id' => ['required', 'integer'],
        //     'id_story' => ['required', 'integer'],
        // ]);
        // if($validator->fails()) {
        //     abort(500);
        // }

        $data = RestaurantStory::where('id_story', $request->id)->get();
        echo json_encode($data);
    }


    public function restaurant_menu(Request $request)
    {
        if ($request->id) {
            $data = RestaurantMenu::where('id_menu', $request->id)->first();
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

    public function restaurant_map(Request $request)
    {
        if ($request->id) {
            $data = Restaurant::with([
                'video', 'photo', 'type', 'cuisine', 'location', 'detailReview'
            ])->where('id_restaurant', $request->id)->first();
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

    public function villa_nearby_restaurant(Request $request)
    {
        // * Get latitude Longitude Restaurant
        $get_restaurant = Restaurant::where('id_restaurant', $request->id)->first();
        $latitude1_restaurant = $get_restaurant->latitude;
        $longitude1_restaurant = $get_restaurant->longitude;
        // dd($latitude1_restaurant, $longitude1_restaurant);

        // * Get Latitude Longitude Nearby Villas
        $get_lat_long_villas = Villa::with([
            'photo', 'video', 'detailReview', 'propertyType', 'location'
        ])->where('status', '1')->get();
        // dd($get_lat_long_villas);

        // * Compare distance restaurant and villas
        $point1 = array('lat' => $latitude1_restaurant, 'long' => $longitude1_restaurant, 'id_location');
        $kilometers = [];
        $i = 0;

        foreach ($get_lat_long_villas as $item) {
            $lat1 = $point1['lat'];
            $lon1 = $point1['long'];
            $lat2 = $item->latitude;
            $lon2 = $item->longitude;
            $theta = $lon1 - $lon2;
            // dd($lat1, $lon1, $lat2, $lon2, $get_lat_long_villas, $theta);

            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;

            $kilometers[$i] = (object)[
                'kilometer' => number_format((float)$miles * 1.609344, 1, '.', ''),
                'detail' => $item
            ];
            $i++;
        }

        // filter data
        $filtered_data = array();
        foreach ($kilometers as $data) {
            // if($data->kilometer <= 3) {
            //     array_push($filtered_data, $data);
            // }
            if (true) {
                array_push($filtered_data, $data);
            }
        }

        // return data
        $convertJson = response()->json($filtered_data, 200);
        return $convertJson ?? null;
    }

    public function activity_nearby_restaurant(Request $request)
    {
        // * Get latitude Longitude Restaurant
        $get_restaurant = Restaurant::where('id_restaurant', $request->id)->first();
        $latitude1_restaurant = $get_restaurant->latitude;
        $longitude1_restaurant = $get_restaurant->longitude;
        // dd($latitude1_restaurant, $longitude1_restaurant);

        // * Get Latitude Longitude To Do Things
        $get_lat_long_todo = Activity::with([
            'video', 'photo', 'facilities', 'location', 'detailReview'
        ])->where('status', '1')->get();
        // dd($get_lat_long_todo);

        $point1 = array('lat' => $latitude1_restaurant, 'long' => $longitude1_restaurant, 'id_location');
        $kilometers2 = [];
        $j = 0;
        foreach ($get_lat_long_todo as $item) {
            $lat3 = $point1['lat'];
            $lon3 = $point1['long'];
            $lat4 = $item->latitude;
            $lon4 = $item->longitude;
            // $todo_detail = $item;
            $theta2 = $lon3 - $lon4;
            // dd($lat3, $lon3, $lat4, $lon4, $get_lat_long_todo, $theta2);

            $miles2 = (sin(deg2rad($lat3)) * sin(deg2rad($lat4))) + (cos(deg2rad($lat3)) * cos(deg2rad($lat4)) * cos(deg2rad($theta2)));
            $miles2 = acos($miles2);
            $miles2 = rad2deg($miles2);
            $miles2 = $miles2 * 60 * 1.1515;

            $kilometers2[$j] = (object)[
                'kilometer' => number_format((float)$miles2 * 1.609344, 1, '.', ''),
                'detail' => $item
            ];
            $j++;
        }

        // filter data
        $filtered_data = array();
        foreach ($kilometers2 as $data) {
            // if($data->kilometer <= 3) {
            //     array_push($filtered_data, $data);
            // }
            if (true) {
                array_push($filtered_data, $data);
            }
        }

        // return data
        $convertJson = response()->json($filtered_data, 200);
        return $convertJson ?? null;
    }

    public function hotel_nearby_restaurant(Request $request)
    {
        // * Get latitude Longitude Restaurant
        $get_restaurant = Restaurant::where('id_restaurant', $request->id)->first();
        $latitude1_restaurant = $get_restaurant->latitude;
        $longitude1_restaurant = $get_restaurant->longitude;
        // dd($get_restaurant, $latitude1_restaurant, $longitude1_restaurant);

        $get_lat_long_hotel = Hotel::where('status', '1')->get();
        // dd($get_lat_long_hotel);

        $point1 = array('lat' => $latitude1_restaurant, 'long' => $longitude1_restaurant, 'id_location');
        $kilometers3 = array();
        $k = 0;
        foreach ($get_lat_long_hotel as $item) {
            $lat5 = $point1['lat'];
            $lon5 = $point1['long'];
            $lat6 = $item->latitude;
            $lon6 = $item->longitude;
            $theta3 = $lon5 - $lon6;

            $miles3 = (sin(deg2rad($lat5)) * sin(deg2rad($lat6))) + (cos(deg2rad($lat5)) * cos(deg2rad($lat6)) * cos(deg2rad($theta3)));
            $miles3 = acos($miles3);
            $miles3 = rad2deg($miles3);
            $miles3 = $miles3 * 60 * 1.1515;
            $kilometers3[$k] = (object)[
                'kilometer' => number_format((float)$miles3 * 1.609344, 1, '.', ''),
                'detail' => $item
            ];
            $k++;
        }
        // filter data
        $filtered_data = array();
        foreach ($kilometers3 as $data) {
            // if($data->kilometer <= 3) {
            //     array_push($filtered_data, $data);
            // }
            if (true) {
                array_push($filtered_data, $data);
            }
        }
        // dd('hit');
        // return data
        $convertJson = response()->json($filtered_data, 200);
        return $convertJson ?? null;
    }

    public function restaurant_update_caption_photo(Request $request)
    {
        $this->authorize('restaurant_update');

        $status = 500;

        try {
            $restaurant = RestaurantPhoto::where('id_photo', $request->id_photo)->first();

            $update = $restaurant->update([
                'caption' => $request->caption,
                'updated_by' => auth()->user()->id,
            ]);

            if ($update)
            {
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

    public function restaurant_update_tag_photo(Request $request)
    {
        $this->authorize('restaurant_update');

        $status = 500;

        try {
            // dd($request->all());

            $data = RestaurantHasSubCategory::updateOrCreate([
                'id_restaurant' => $request->id_restaurant,
                'id_photo' => $request->id_photo
            ],
            [
                'id_subcategory' => $request->tag,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);

            if ($data)
            {
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
}
