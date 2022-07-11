<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\RestaurantMenu;
use App\Models\RestaurantPhoto;
use App\Models\RestaurantVideo;
use App\Models\Location;
use File;

class RestaurantController extends Controller
{
    public function index()
    {
        $this->authorize('restaurant_index');
        $data = Restaurant::latest()->get();

        // return view('admin.restaurant.index', compact('data'));
        return view('new-admin.restaurant.index', compact('data'));
    }

    public function datatable()
	{
        $this->authorize('restaurant_index');
		return Restaurant::datatables();
	}

    public function trash()
    {
        $this->authorize('restaurant_index');
        $data = Restaurant::latest()->get();

        // return view('admin.restaurant.index', compact('data'));
        return view('new-admin.restaurant.trash', compact('data'));
    }

    public function datatableTrash()
	{
        $this->authorize('restaurant_index');
		return Restaurant::datatablestrash();
	}

    //==================== add by step ==========================
    public function add_step_continue()
    {
        $this->authorize('restaurant_create');
        $step = Restaurant::where('step', '<>' ,0)->where('created_by', Auth::user()->id)->get();
        if($step[0]->step == 1){
            return redirect()->action('RestaurantController@add_step_two');
        }else if($step[0]->step == 2){
            return redirect()->action('RestaurantController@add_step_three');
        }else if($step[0]->step == 3){
            return redirect()->action('RestaurantController@add_step_four');
        }else if($step[0]->step == 4){
            return redirect()->action('RestaurantController@add_step_five');
        }else if($step[0]->step == 5){
            return redirect()->action('RestaurantController@add_step_six');
        }
    }

    public function add_step_one()
    {
        $this->authorize('restaurant_create');
        $type = DB::table('type_listing')->get();
        return view('admin.villa.add_list.step1', compact('type'));
    }

    public function add_step_one_store()
    {
        $this->authorize('restaurant_create');
        //insert into database
        $data = Restaurant::insert(array(
            'status' => 0,
            'step' => 1,
            'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('RestaurantController@add_step_two');
    }

    public function add_step_two() //name of villa
    {
        $this->authorize('restaurant_create');
        $data = Restaurant::where('created_by', Auth::user()->id)->where('step', '<>', 0)->get();
        return view('admin.restaurant.add_list.step2', compact('data'));
    }

    public function add_step_two_store(Request $request)
    {
        $this->authorize('restaurant_create');
        //insert into database
        $data = Restaurant::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $data->update(array(
            'name' => $request->name,
            'step' => 2,
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('RestaurantController@add_step_three');
    }

    public function add_step_three()
    {
        $this->authorize('restaurant_create');
        $data = Restaurant::where('created_by', Auth::user()->id)->where('step', '<>', 0)->get();
        return view('admin.restaurant.add_list.step3', compact('data'));
    }

    public function add_step_three_store(Request $request)
    {
        $this->authorize('restaurant_create');
        //insert into database
        $data = Restaurant::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $data->update(array(
            'description' => $request->description,
            'step' => 3,
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('RestaurantController@add_step_four');
    }

    public function add_step_four()
    {
        $this->authorize('restaurant_create');
        $location = Location::get();
        $data = Restaurant::where('created_by', Auth::user()->id)->where('step', '<>', 0)->get();
        return view('admin.restaurant.add_list.step4', compact('location', 'data'));
    }

    public function add_step_four_store(Request $request)
    {
        $this->authorize('restaurant_create');
        //insert into database
        $data = Restaurant::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $data->update(array(
            'id_location' => $request->id_location,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'phone' => $request->phone,
            'email' => $request->email,
            'step' => 4,
            'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('RestaurantController@add_step_five');
    }

    public function add_step_five()
    {
        $this->authorize('restaurant_create');
        return view('admin.restaurant.add_list.step5');
    }

    public function add_step_five_store(Request $request)
    {
        $this->authorize('restaurant_create');
        $data = Restaurant::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $berkas = $request->image;
        if(empty($berkas)){
            $data->update(array(
                'step' => 5,
                'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'updated_by' => Auth::user()->id,
            ));
        }else{
            $folder = strtolower($data->name);
            $path = public_path().'/foto/restaurant/'.$folder;
            if(!File::isDirectory($path)){

                File::makeDirectory($path, 0777, true, true);

            }

            $ext = strtolower($berkas->getClientOriginalExtension());

            if($ext == 'jpeg'|| $ext == 'jpg' || $ext =='png')
            {
                $original_name = $berkas->getClientOriginalName();

                $name_file = time()."_".$original_name;
                // isi dengan nama folder tempat kemana file diupload
                $berkas->move($path,$name_file);

                //insert into database
                $data->update(array(
                    'image' => $name_file,
                    'step' => 0,
                    'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'updated_by' => Auth::user()->id,
                ));

            }
        }

        return redirect()->action('RestaurantController@add_step_six');
    }

    public function add_step_six()
    {
        $this->authorize('restaurant_create');
        return view('admin.restaurant.add_list.step6');
    }


    //======================== RESTAURANT MENU ==========================
    public function index_menu($id)
    {
        $this->authorize('restaurant_index');
        $data =Restaurant::where('id_restaurant', $id)->get();
        return view('admin.restaurant.menu.index_menu', compact('data'));
    }

    public function datatable_menu($id)
    {
        $this->authorize('restaurant_index');
        return RestaurantMenu::datatables($id);

    }

    public function create_menu($id)
    {
        $this->authorize('restaurant_create');
        $find = Restaurant::where('id_restaurant', $id)->get();
        return view('admin.restaurant.menu.create_menu', compact('find'));
    }

    public function store_menu(Request $request)
    {
        $this->authorize('restaurant_create');
        $berkas = $request->image;
        if (empty($berkas)) {
            //insert into database
            $data = RestaurantMenu::insert(array(
                'id_restaurant' => $request->id_restaurant,
                'name' => $request->name,
                'description' => $request->description,
                'price' =>$request->price,
                'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }else{
            //cek the directori first
            $find = Restaurant::select('name')->where('id_restaurant', $request->id_restaurant)->get();
            $name_dir = strtolower($find[0]->name);
            $path = public_path().'/foto/restaurant/'.$name_dir.'/menu';
            if(!File::isDirectory($path)){

                File::makeDirectory($path, 0777, true, true);

            }

            $ext = strtolower($berkas->getClientOriginalExtension());

            if($ext == 'jpeg'|| $ext == 'jpg' || $ext =='png')
            {
                $original_name = $berkas->getClientOriginalName();

                $name_file = time()."_".$original_name;

                // isi dengan nama folder tempat kemana file diupload
                $berkas->move($path,$name_file);

            }

            //insert into database
            $data = RestaurantMenu::insert(array(
                'id_restaurant' => $request->id_restaurant,
                'name' => $request->name,
                'description' => $request->description,
                'price' =>$request->price,
                'foto' => $name_file,
                'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

        }

        return redirect()->route('admin_restaurant_index_menu', $request->id_restaurant)
            ->with('success', 'Your data has been submited');
    }

    public function destroy_menu($id)
    {
        $this->authorize('restaurant_delete');
        $find = RestaurantMenu::where('id_menu', $id)->first();
        $id_restaurant = Restaurant::where('id_restaurant', $find->id_restaurant)->first();
        $data = File::delete(public_path('foto/restaurant/'.strtolower($id_restaurant->name).'/menu'.'/'.$find->foto));
        $find->delete();
        return redirect()->back()
            ->with('success', 'Your data has been deleted');
    }


    //========================== RESTAURANT GALLERY =================================

    public function create_gallery($id)
    {
        $this->authorize('restaurant_create');
        $find = Restaurant::where('id_restaurant', $id)->get();
        $gallery = RestaurantPhoto::where('id_restaurant', $id)->get();
        $video = RestaurantVideo::where('id_restaurant', $id)->get();
        return view('admin.restaurant.gallery.create_gallery', compact('find', 'gallery', 'video'));
    }

    public function store_gallery(Request $request)
    {
        $this->authorize('restaurant_create');
        $berkas = $request->file;
        if (empty($berkas)) {

        }else{
            //cek the directori first
            $find = Restaurant::where('id_restaurant', $request->id_restaurant)->get();
            $folder = strtolower($find[0]->name);
            $path = public_path().'/foto/restaurant/'.$folder;
            if(!File::isDirectory($path)){

                File::makeDirectory($path, 0777, true, true);

            }

            $ext = strtolower($berkas->getClientOriginalExtension());

            if($ext == 'jpeg'|| $ext == 'jpg' || $ext =='png')
            {
                $original_name = $berkas->getClientOriginalName();

                $name_file = time()."_".$original_name;

                // isi dengan nama folder tempat kemana file diupload
                $berkas->move($path,$name_file);

                 //insert into database
                $data = RestaurantPhoto::insert(array(
                    'name' => $name_file,
                    'id_restaurant' => $request->id_restaurant,
                    'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));

            }elseif($ext == 'mp4')
            {
                $original_name = $berkas->getClientOriginalName();

                $name_file = time()."_".$original_name;

                // isi dengan nama folder tempat kemana file diupload
                $berkas->move($path,$name_file);

                 //insert into database
                $data = RestaurantVideo::insert(array(
                    'name' => $name_file,
                    'id_restaurant' => $request->id_restaurant,
                    'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            }
        }
    }

    public function destroy_gallery($id)
    {
        $this->authorize('restaurant_delete');
        $find = RestaurantPhoto::where('id_photo', $id)->first();
        $id_restaurant = Restaurant::where('id_restaurant', $find->id_restaurant)->first();
        File::delete(public_path('foto/restaurant/'.strtolower($id_restaurant->name).'/'.$find->name));
        $find->delete();
        return redirect()->route('admin_restaurant_create_gallery', $id_restaurant->id_restaurant)
            ->with('success', 'Your data has been deleted');
    }

    public function destroy_video($id)
    {
        $this->authorize('restaurant_delete');
        $find = RestaurantVideo::where('id_video', $id)->first();
        $restaurant = Restaurant::where('id_restaurant', $find->id_restaurant)->first();
        File::delete(public_path('foto/restaurant/'.strtolower($restaurant->name).'/'.$find->name));
        $find->delete();
        return redirect()->route('admin_restaurant_create_gallery', $restaurant->id_restaurant)
            ->with('success', 'Your data has been deleted');
    }
}
