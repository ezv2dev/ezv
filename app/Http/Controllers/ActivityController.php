<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use File;
use App\Models\Location;
use App\Models\ActivityPrice;
use App\Models\ActivityPhoto;
use App\Models\ActivityVideo;

class ActivityController extends Controller
{
    public function index()
    {
        $this->authorize('activity_index');
        $data = Activity::where('step', '<>', 0)->where('created_by', Auth::user()->id)->count();

        return view('new-admin.activity.index', compact('data'));
    }

    public function grade()
    {
    }

    public function datatable()
    {
        $this->authorize('activity_index');
        return Activity::datatables();
    }

    public function trash()
    {
        $this->authorize('activity_index');
        $data = Activity::where('step', '<>', 0)->where('created_by', Auth::user()->id)->count();

        return view('new-admin.activity.trash', compact('data'));
    }

    public function datatableTrash()
    {
        $this->authorize('activity_index');
        return Activity::datatablestrash();
    }


    //==================== add by step ==========================
    public function add_step_continue()
    {
        $this->authorize('activity_create');
        $step = Activity::where('step', '<>', 0)->where('created_by', Auth::user()->id)->get();
        if ($step[0]->step == 1) {
            return redirect()->action('RestaurantController@add_step_two');
        } else if ($step[0]->step == 2) {
            return redirect()->action('RestaurantController@add_step_three');
        } else if ($step[0]->step == 3) {
            return redirect()->action('RestaurantController@add_step_four');
        } else if ($step[0]->step == 4) {
            return redirect()->action('RestaurantController@add_step_five');
        } else if ($step[0]->step == 5) {
            return redirect()->action('RestaurantController@add_step_six');
        }
    }

    public function add_step_one_store()
    {
        $this->authorize('activity_create');
        //insert into database
        $data = Activity::insert(array(
            'status' => 0,
            'step' => 1,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('ActivityController@add_step_two');
    }

    public function add_step_two() //name of activity
    {
        $this->authorize('activity_create');
        $data = Activity::where('created_by', Auth::user()->id)->where('step', '<>', 0)->get();
        return view('admin.activity.add_list.step2', compact('data'));
    }

    public function add_step_two_store(Request $request)
    {
        $this->authorize('activity_create');
        //insert into database
        $data = Activity::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $data->update(array(
            'name' => $request->name,
            'step' => 2,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('ActivityController@add_step_three');
    }

    public function add_step_three() //description
    {
        $this->authorize('activity_create');
        $data = Activity::where('created_by', Auth::user()->id)->where('step', '<>', 0)->get();
        return view('admin.activity.add_list.step3', compact('data'));
    }

    public function add_step_three_store(Request $request)
    {
        $this->authorize('activity_create');
        //insert into database
        $data = Activity::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $data->update(array(
            'description' => $request->description,
            'step' => 3,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('ActivityController@add_step_four');
    }

    public function add_step_four() //location
    {
        $this->authorize('activity_create');
        $location = Location::get();
        $data = Activity::where('created_by', Auth::user()->id)->where('step', '<>', 0)->get();
        return view('admin.activity.add_list.step4', compact('location', 'data'));
    }

    public function add_step_four_store(Request $request)
    {
        $this->authorize('activity_create');
        //insert into database
        $data = Activity::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $data->update(array(
            'id_location' => $request->id_location,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'phone' => $request->phone,
            'email' => $request->email,
            'step' => 4,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('ActivityController@add_step_five');
    }

    public function add_step_five()
    {
        $this->authorize('activity_create');
        return view('admin.activity.add_list.step5');
    }

    public function add_step_five_store(Request $request)
    {
        $this->authorize('activity_create');
        $data = Activity::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $berkas = $request->image;
        if (empty($berkas)) {
            $data->update(array(
                'step' => 5,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
        } else {
            $folder = strtolower($data->name);
            $path = public_path() . '/foto/activity/' . $folder;
            if (!File::isDirectory($path)) {

                File::makeDirectory($path, 0777, true, true);
            }

            $ext = strtolower($berkas->getClientOriginalExtension());

            if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png') {
                $original_name = $berkas->getClientOriginalName();

                $name_file = time() . "_" . $original_name;
                // isi dengan nama folder tempat kemana file diupload
                $berkas->move($path, $name_file);

                //insert into database
                $data->update(array(
                    'image' => $name_file,
                    'step' => 0,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_by' => Auth::user()->id,
                ));
            }
        }

        return redirect()->action('ActivityController@add_step_six');
    }

    public function add_step_six()
    {
        $this->authorize('activity_create');
        return view('admin.activity.add_list.step6');
    }


    //======================== ACTIVITY PRICE ==========================
    public function index_price($id)
    {
        $this->authorize('activity_index');
        $data = Activity::where('id_activity', $id)->get();
        return view('admin.activity.price.index_price', compact('data'));
    }

    public function datatable_price($id)
    {
        $this->authorize('activity_index');
        return ActivityPrice::datatables($id);
    }

    public function create_price($id)
    {
        $this->authorize('activity_create');
        $find = Activity::where('id_activity', $id)->get();
        return view('admin.activity.price.create_price', compact('find'));
    }

    public function store_price(Request $request)
    {
        $this->authorize('activity_create');
        $berkas = $request->image;
        if (empty($berkas)) {
            //insert into database
            $data = ActivityPrice::insert(array(
                'id_activity' => $request->id_activity,
                'name' => $request->name,
                'description' => $request->description,
                'adult' => $request->adult,
                'children' => $request->children,
                'price' => $request->price,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        } else {
            //cek the directori first
            $find = Activity::select('name')->where('id_activity', $request->id_activity)->get();
            $name_dir = strtolower($find[0]->name);

            $path = public_path() . '/foto/activity/' . $name_dir . '/price';
            if (!File::isDirectory($path)) {

                File::makeDirectory($path, 0777, true, true);
            }

            $ext = strtolower($berkas->getClientOriginalExtension());

            if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png') {
                $original_name = $berkas->getClientOriginalName();

                $name_file = time() . "_" . $original_name;

                // isi dengan nama folder tempat kemana file diupload
                $berkas->move($path, $name_file);
            }

            //insert into database
            $data = ActivityPrice::insert(array(
                'id_activity' => $request->id_activity,
                'name' => $request->name,
                'description' => $request->description,
                'adult' => $request->adult,
                'children' => $request->children,
                'price' => $request->price,
                'foto' => $name_file,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        return redirect()->route('admin_activity_index_price', $request->id_activity)
            ->with('success', 'Your data has been submited');
    }

    public function destroy_price($id)
    {
        $this->authorize('activity_delete');
        $find = ActivityPrice::where('id_price', $id)->first();
        $id_restaurant = Activity::where('id_activity', $find->id_activity)->first();
        $data = File::delete(public_path('foto/activity/' . strtolower($id_restaurant->name) . '/price' . '/' . $find->foto));
        $find->delete();
        return redirect()->back()
            ->with('success', 'Your data has been deleted');
    }

    //==========================  GALLERY =================================

    public function create_gallery($id)
    {
        $this->authorize('activity_create');
        $find = Activity::where('id_activity', $id)->get();
        $gallery = ActivityPhoto::where('id_activity', $id)->get();
        $video = ActivityVideo::where('id_activity', $id)->get();
        return view('admin.activity.gallery.create_gallery', compact('find', 'gallery', 'video'));
    }

    public function store_gallery(Request $request)
    {
        $this->authorize('activity_create');
        $berkas = $request->file;
        if (empty($berkas)) {
        } else {
            //cek the directori first
            $find = Activity::where('id_activity', $request->id_activity)->get();
            $folder = strtolower($find[0]->name);
            $path = public_path() . '/foto/activity/' . $folder;
            if (!File::isDirectory($path)) {

                File::makeDirectory($path, 0777, true, true);
            }

            $ext = strtolower($berkas->getClientOriginalExtension());

            if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png') {
                $original_name = $berkas->getClientOriginalName();

                $name_file = time() . "_" . $original_name;

                // isi dengan nama folder tempat kemana file diupload
                $berkas->move($path, $name_file);

                //insert into database
                $data = ActivityPhoto::insert(array(
                    'name' => $name_file,
                    'id_activity' => $request->id_activity,
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

                //insert into database
                $data = ActivityVideo::insert(array(
                    'name' => $name_file,
                    'id_activity' => $request->id_activity,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            }
        }
    }

    public function destroy_gallery($id)
    {
        $this->authorize('activity_delete');
        $find = ActivityPhoto::where('id_photo', $id)->first();
        $id_restaurant = Activity::where('id_activity', $find->id_activity)->first();
        File::delete(public_path('foto/activity/' . strtolower($id_restaurant->name) . '/' . $find->name));
        $find->delete();
        return redirect()->route('admin_activity_create_gallery', $id_restaurant->id_activity)
            ->with('success', 'Your data has been deleted');
    }

    public function destroy_video($id)
    {
        $this->authorize('activity_delete');
        $find = ActivityVideo::where('id_video', $id)->first();
        $restaurant = Activity::where('id_activity', $find->id_activity)->first();
        File::delete(public_path('foto/activity/' . strtolower($restaurant->name) . '/' . $find->name));
        $find->delete();
        return redirect()->route('admin_activity_create_gallery', $restaurant->id_activity)
            ->with('success', 'Your data has been deleted');
    }
}
