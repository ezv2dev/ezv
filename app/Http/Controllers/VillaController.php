<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\Amenities;
use App\Models\BathRoom;
use App\Models\BedRoom;
use App\Models\Kitchen;
use App\Models\Safety;
use App\Models\Service;
use App\Models\VillaType;
use App\Models\VillaTypeDetail;
use App\Models\VillaPhoto;
use App\Models\VillaVideo;
use App\Models\VillaNearby;
use App\Models\VillaExtraprice;
use App\Models\Location;
use App\Models\VillaAmenities;
use App\Models\VillaBathroom;
use App\Models\VillaBedroom;
use App\Models\VillaKitchen;
use App\Models\VillaSafety;
use App\Models\VillaService;
use File;

class VillaController extends Controller
{
    public function index()
    {
        $this->authorize('listvilla_index');
        $data = Villa::where('step', '<>', 0)->where('created_by', Auth::user()->id)->count();

        // return view('admin.villa.index', compact('data'));
        return view('new-admin.villa.index', compact('data'));
    }

    public function datatable()
    {
        $this->authorize('listvilla_index');
        return villa::datatables();
    }

    public function trash()
    {
        $this->authorize('listvilla_index');
        $data = Villa::where('step', '<>', 0)->where('created_by', Auth::user()->id)->count();

        // return view('admin.villa.index', compact('data'));
        return view('new-admin.villa.trash', compact('data'));
    }

    public function datatableTrash()
    {
        $this->authorize('listvilla_index');
        return villa::datatablestrash();
    }

    public function create()
    {
        $this->authorize('listvilla_create');
        $type = VillaType::get();
        $location = Location::get();
        return view('admin.villa.create', compact('type', 'location'));
    }

    public function store(Request $request)
    {
        $this->authorize('listvilla_create');

        $status = 500;

        try {
            //insert into database
            $berkas = $request->image;
            if (empty($berkas)) {
                $data = villa::insertGetId(array(
                    'name' => $request->name,
                    'description' => $request->description,
                    'as_feature' => $request->feature,
                    'adult' => $request->maxadult,
                    'children' => $request->maxchild,
                    'size' => $request->size,
                    'bedroom' => $request->bedroom,
                    'bathroom' => $request->bathroom,
                    'min_stay' => $request->minstay,
                    'booking' => $request->booking,
                    'id_location' => $request->id_location,
                    'address' => $request->address,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'cancel' => $request->cancel,
                    'status' =>  0,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            } else {
                $folder = $request->uid;
                $path = public_path() . '/foto/gallery/' . $folder;
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
                $data = villa::insertGetId(array(
                    'name' => $request->name,
                    'description' => $request->description,
                    'as_feature' => $request->feature,
                    'adult' => $request->maxadult,
                    'children' => $request->maxchild,
                    'size' => $request->size,
                    'bedroom' => $request->bedroom,
                    'bathroom' => $request->bathroom,
                    'min_stay' => $request->minstay,
                    'booking' => $request->booking,
                    'id_location' => $request->id_location,
                    'address' => $request->address,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'cancel' => $request->cancel,
                    'image' => $name_file,
                    'status' =>  0,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            }

            if ($data) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('admin_villa')
                ->with('success', 'Your data has been submited');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }


    public function show($id)
    {
        $this->authorize('listvilla_update');
        $villa = villa::get();
        $find = villa::where('id_villa', $id)->get();
        $type = VillaType::get();
        $location = Location::get();
        return view('admin.villa.edit', compact('find', 'villa', 'location', 'type'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('listvilla_update');

        $status = 500;

        try {
            $find = villa::where('id_villa', $id)->first();

            $request->validate([
                'name' => 'required',
            ]);

            $berkas = $request->image;

            if (strtolower($find->name) != $request->uid) {
                if (empty($berkas)) {

                    if ($find->image != null) {
                        $old_folder = strtolower($find->name);
                        $new_folder = $request->uid;
                        $path_new = public_path() . '/foto/gallery/' . $new_folder;
                        if (!File::isDirectory($path_new)) {

                            File::makeDirectory($path_new, 0777, true, true);
                        }
                        File::copy(public_path('/foto/gallery/' . $old_folder . '/' . $find->image), public_path('/foto/gallery/' . $new_folder . '/' . $find->image));
                        File::deleteDirectory(public_path('foto/gallery/' . $find->name));
                    } else {
                        File::deleteDirectory(public_path('foto/gallery/' . $find->name));
                    }

                    $find->update(array(
                        'name' => $request->name,
                        'original_name' => $request->original_name,
                        'description' => $request->description,
                        'as_feature' => $request->feature,
                        'adult' => $request->maxadult,
                        'children' => $request->maxchild,
                        'size' => $request->size,
                        'bedroom' => $request->bedroom,
                        'bathroom' => $request->bathroom,
                        'min_stay' => $request->minstay,
                        'booking' => $request->booking,
                        'id_location' => $request->id_location,
                        'address' => $request->address,
                        'latitude' => $request->latitude,
                        'longitude' => $request->longitude,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'price' => $request->price,
                        'discount' => $request->discount,
                        'cancel' => $request->cancel,
                        'status' =>  0,
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_by' => Auth::user()->id,
                    ));
                } else {
                    File::deleteDirectory(public_path('foto/gallery/' . $find->name));
                    //cek the directori first
                    $folder = $request->uid;
                    $path = public_path() . '/foto/gallery/' . $folder;
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

                    $find->update(array(
                        'name' => $request->name,
                        'original_name' => $request->original_name,
                        'description' => $request->description,
                        'as_feature' => $request->feature,
                        'adult' => $request->maxadult,
                        'children' => $request->maxchild,
                        'size' => $request->size,
                        'bedroom' => $request->bedroom,
                        'bathroom' => $request->bathroom,
                        'min_stay' => $request->minstay,
                        'booking' => $request->booking,
                        'id_location' => $request->id_location,
                        'address' => $request->address,
                        'latitude' => $request->latitude,
                        'longitude' => $request->longitude,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'price' => $request->price,
                        'discount' => $request->discount,
                        'cancel' => $request->cancel,
                        'image' => $name_file,
                        'status' =>  0,
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_by' => Auth::user()->id,
                    ));
                }
            } else {
                if (empty($berkas)) {
                    $find->update(array(
                        'name' => $request->name,
                        'original_name' => $request->original_name,
                        'description' => $request->description,
                        'as_feature' => $request->feature,
                        'adult' => $request->maxadult,
                        'children' => $request->maxchild,
                        'size' => $request->size,
                        'bedroom' => $request->bedroom,
                        'bathroom' => $request->bathroom,
                        'min_stay' => $request->minstay,
                        'booking' => $request->booking,
                        'id_location' => $request->id_location,
                        'address' => $request->address,
                        'latitude' => $request->latitude,
                        'longitude' => $request->longitude,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'price' => $request->price,
                        'discount' => $request->discount,
                        'cancel' => $request->cancel,
                        'status' =>  0,
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_by' => Auth::user()->id,
                    ));
                } else {
                    //cek the directori first
                    $folder = $request->uid;
                    $path = public_path() . '/foto/gallery/' . $folder;

                    if (!File::isDirectory($path)) {

                        File::makeDirectory($path, 0777, true, true);
                    }

                    $ext = strtolower($berkas->getClientOriginalExtension());

                    if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png') {
                        $original_name = $berkas->getClientOriginalName();

                        $name_file = time() . "_" . $original_name;

                        // isi dengan nama folder tempat kemana file diupload
                        $berkas->move($path, $name_file);

                        //hapus berkas lama
                        File::delete($path . '/' . $find->image);
                    }

                    $find->update(array(
                        'name' => $request->name,
                        'original_name' => $request->original_name,
                        'description' => $request->description,
                        'as_feature' => $request->feature,
                        'adult' => $request->maxadult,
                        'children' => $request->maxchild,
                        'size' => $request->size,
                        'bedroom' => $request->bedroom,
                        'bathroom' => $request->bathroom,
                        'min_stay' => $request->minstay,
                        'booking' => $request->booking,
                        'id_location' => $request->id_location,
                        'address' => $request->address,
                        'latitude' => $request->latitude,
                        'longitude' => $request->longitude,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'price' => $request->price,
                        'discount' => $request->discount,
                        'cancel' => $request->cancel,
                        'image' => $name_file,
                        'status' =>  0,
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_by' => Auth::user()->id,
                    ));
                }
            }

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('admin_villa')
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('listvilla_delete');
        $status = 500;

        try {
            $find = villa::where('id_villa', $id)->first();
            File::deleteDirectory(public_path('foto/gallery/' . $find->name));
            $find->delete();

            if ($find) {
                $status = 200;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if ($status == 200) {
            return redirect()->route('admin_villa')
                ->with('success', 'Your data has been deleted');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }


    //========================== VILLA GALLERY =================================

    public function create_gallery($id)
    {
        $this->authorize('listvilla_create');
        $find = villa::where('id_villa', $id)->get();
        $gallery = villaphoto::where('id_villa', $id)->get();
        $video = VillaVideo::where('id_villa', $id)->get();
        return view('admin.villa.gallery.create_gallery', compact('find', 'gallery', 'video'));
    }

    public function store_gallery(Request $request)
    {
        // dd($request->all());
        $this->authorize('listvilla_create');
        $berkas = $request->file;
        if (empty($berkas)) {
        } else {
            //cek the directori first
            $find = Villa::where('id_villa', $request->id_villa)->get();
            $folder = $find[0]->uid;
            $path = env("VILLA_FILE_PATH") . $folder;
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
                $data = villaphoto::insert(array(
                    'name' => $name_file,
                    'id_villa' => $request->id_villa,
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
                $data = villavideo::insert(array(
                    'name' => $name_file,
                    'id_villa' => $request->id_villa,
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
        $this->authorize('listvilla_delete');
        $find = villaphoto::where('id_photo', $id)->first();
        $id_villa = villa::where('id_villa', $find->id_villa)->first();
        File::delete(public_path('foto/gallery/' . strtolower($id_villa->name) . '/' . $find->name));
        $find->delete();
        return redirect()->route('admin_villa_create_gallery', $id_villa->id_villa)
            ->with('success', 'Your data has been deleted');
    }

    public function destroy_video($id)
    {
        $this->authorize('listvilla_delete');
        $find = villavideo::where('id_video', $id)->first();
        $villa = villa::where('id_villa', $find->id_villa)->first();
        File::delete(public_path('foto/gallery/' . strtolower($villa->name) . '/' . $find->name));
        $find->delete();
        return redirect()->route('admin_villa_create_gallery', $villa->id_villa)
            ->with('success', 'Your data has been deleted');
    }


    //======================== VILLA NEAR BY ==========================
    public function index_nearby($id)
    {
        $this->authorize('listvilla_index');
        $data = Villa::where('id_villa', $id)->get();
        return view('admin.villa.nearby.index_nearby', compact('data'));
    }

    public function datatable_nearby($id)
    {
        $this->authorize('listvilla_index');
        return villanearby::datatables($id);
    }

    public function create_nearby($id)
    {
        $this->authorize('listvilla_create');
        $find = villa::where('id_villa', $id)->get();
        return view('admin.villa.nearby.create_nearby', compact('find'));
    }

    public function store_nearby(Request $request)
    {
        $this->authorize('listvilla_create');
        $berkas = $request->image;
        if (empty($berkas)) {
            //insert into database
            $data = VillaNearby::insert(array(
                'name' => $request->name,
                'original_name' => $request->original_name,
                'description' => $request->description,
                'distance' => $request->distance,
                'id_villa' => $request->id_villa,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        } else {
            //cek the directori first
            $find = Villa::select('name')->where('id_villa', $request->id_villa)->get();
            $name_dir = $find[0]->uid;
            $path = public_path() . '/foto/gallery/' . $name_dir . '/near_by';
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
            $data = VillaNearby::insert(array(
                'name' => $request->name,
                'original_name' => $request->original_name,
                'description' => $request->description,
                'distance' => $request->distance,
                'id_villa' => $request->id_villa,
                'image' => $name_file,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        return redirect()->route('admin_villa_index_nearby', $request->id_villa)
            ->with('success', 'Your data has been submited');
    }

    public function destroy_nearby($id)
    {
        $this->authorize('listvilla_delete');
        $find = VillaNearby::where('id_nearby', $id)->first();
        $id_villa = villa::where('id_villa', $find->id_villa)->first();
        $data = File::delete(public_path('foto/gallery/' . strtolower($id_villa->name) . '/near_by' . '/' . $find->image));
        $find->delete();
        return redirect()->back()
            ->with('success', 'Your data has been deleted');
    }

    //================== EXTRA PRICING =====================
    public function index_extraprice($id)
    {
        $this->authorize('listvilla_index');
        $data = Villa::where('id_villa', $id)->get();
        return view('admin.villa.extraprice.index_extraprice', compact('data'));
    }

    public function datatable_extraprice($id)
    {
        $this->authorize('listvilla_index');
        return villaextraprice::datatables($id);
    }

    public function create_extraprice($id)
    {
        $this->authorize('listvilla_create');
        $find = villa::where('id_villa', $id)->get();
        return view('admin.villa.extraprice.create_extraprice', compact('find'));
    }

    public function store_extraprice(Request $request)
    {
        $this->authorize('listvilla_create');
        //insert into database
        $data = villaextraprice::insertGetId(array(
            'name' => $request->name,
            'original_name' => $request->original_name,
            'max_number' => $request->max_number,
            'price' => $request->price,
            'type_price' => $request->type_price,
            'id_villa' => $request->id_villa,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->route('admin_villa_index_extraprice', $request->id_villa)
            ->with('success', 'Your data has been submited');
    }

    public function destroy_extraprice($id)
    {
        $this->authorize('listvilla_delete');
        $find = villaextraprice::where('id_extra_price', $id)->first();
        $find->delete();
        return redirect()->back()
            ->with('success', 'Your data has been deleted');
    }


    //==================== add by step ==========================
    public function add_step_continue()
    {
        $this->authorize('listvilla_create');
        $step = Villa::where('step', '<>', 0)->where('created_by', Auth::user()->id)->get();
        if ($step[0]->step == 1) {
            return redirect()->action('VillaController@add_step_two');
        } else if ($step[0]->step == 2) {
            return redirect()->action('VillaController@add_step_three');
        } else if ($step[0]->step == 3) {
            return redirect()->action('VillaController@add_step_four');
        } else if ($step[0]->step == 4) {
            return redirect()->action('VillaController@add_step_five');
        } else if ($step[0]->step == 5) {
            return redirect()->action('VillaController@add_step_six');
        } else if ($step[0]->step == 6) {
            return redirect()->action('VillaController@add_step_seven');
        } else if ($step[0]->step == 7) {
            return redirect()->action('VillaController@add_step_eight');
        } else if ($step[0]->step == 8) {
            return redirect()->action('VillaController@add_step_nine');
        }
    }

    public function add_step_one()
    {
        $this->authorize('listvilla_create');
        $type = DB::table('type_listing')->get();
        return view('admin.villa.add_list.step1', compact('type'));
    }

    public function add_step_one_store()
    {
        $this->authorize('listvilla_create');
        //insert into database
        $data = Villa::insert(array(
            'status' => 0,
            'step' => 1,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('VillaController@add_step_two');
    }

    public function add_step_two() //name of villa
    {
        $this->authorize('listvilla_create');
        $data = Villa::where('created_by', Auth::user()->id)->where('step', '<>', 0)->get();
        return view('admin.villa.add_list.step2', compact('data'));
    }

    public function add_step_two_store(Request $request)
    {
        $this->authorize('listvilla_create');
        //insert into database
        $data = Villa::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $data->update(array(
            'name' => $request->name,
            'original_name' => $request->original_name,
            'step' => 2,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('VillaController@add_step_three');
    }

    public function add_step_three()
    {
        $this->authorize('listvilla_create');
        $data = Villa::where('created_by', Auth::user()->id)->where('step', '<>', 0)->get();
        return view('admin.villa.add_list.step3', compact('data'));
    }

    public function add_step_three_store(Request $request)
    {
        $this->authorize('listvilla_create');
        //insert into database
        $data = Villa::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $data->update(array(
            'description' => $request->description,
            'step' => 3,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('VillaController@add_step_four');
    }

    public function add_step_four()
    {
        $this->authorize('listvilla_create');
        $data = Villa::where('created_by', Auth::user()->id)->where('step', '<>', 0)->get();
        return view('admin.villa.add_list.step4', compact('data'));
    }

    public function add_step_four_store(Request $request)
    {
        $this->authorize('listvilla_create');
        //insert into database
        $data = Villa::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();
        if ($request->stay == "") {
            $stay = 1;
        } else {
            $stay = $request->stay;
        }
        $data->update(array(
            'adult' => $request->adult,
            'children' => $request->children,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'min_stay' => $stay,
            'step' => 4,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('VillaController@add_step_five');
    }

    public function add_step_five()
    {
        $this->authorize('listvilla_create');
        $location = Location::get();
        $data = Villa::where('created_by', Auth::user()->id)->where('step', '<>', 0)->get();
        return view('admin.villa.add_list.step5', compact('location', 'data'));
    }

    public function add_step_five_store(Request $request)
    {
        $this->authorize('listvilla_create');
        //insert into database
        $data = Villa::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $data->update(array(
            'id_location' => $request->id_location,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'phone' => $request->phone,
            'email' => $request->email,
            'step' => 5,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('VillaController@add_step_six');
    }

    public function add_step_six()
    {
        $this->authorize('listvilla_create');
        $id = Villa::select('id_villa')->where('step', '<>', 0)->where('created_by', Auth::user()->id)->get();
        $gallery = villaphoto::where('id_villa', $id[0]->id_villa)->get();
        $video = VillaVideo::where('id_villa', $id[0]->id_villa)->get();
        $find = villa::where('id_villa', $id[0]->id_villa)->get();
        return view('admin.villa.add_list.step6', compact('gallery', 'video', 'find'));
    }

    public function add_step_six_store(Request $request)
    {
        $this->authorize('listvilla_create');
        //insert into database
        $data = Villa::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $data->update(array(
            'step' => 6,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('VillaController@add_step_seven');
    }

    public function add_step_seven()
    {
        $this->authorize('listvilla_create');
        return view('admin.villa.add_list.step7');
    }

    public function add_step_seven_store(Request $request)
    {
        $this->authorize('listvilla_create');
        $data = Villa::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $berkas = $request->image;
        if (empty($berkas)) {
            $data->update(array(
                'step' => 7,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
        } else {
            $folder = $data->uid;
            $path = public_path() . '/foto/gallery/' . $folder;
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
                    'step' => 7,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_by' => Auth::user()->id,
                ));
            }
        }

        return redirect()->action('VillaController@add_step_eight');
    }

    public function add_step_eight()
    {
        $this->authorize('listvilla_create');
        $amenities = Amenities::get();
        $bathroom = Bathroom::get();
        $bedroom = Bedroom::get();
        $kitchen = Kitchen::get();
        $safety = Safety::get();
        $service = Service::get();
        $type = VillaType::get();
        return view('admin.villa.add_list.step8', compact('amenities', 'bathroom', 'bedroom', 'kitchen', 'safety', 'service', 'type'));
    }

    public function add_step_eight_store(Request $request)
    {
        $this->authorize('listvilla_create');
        $data = Villa::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();
        $id_villa = $data->id_villa;
        //insert into database
        foreach ($request->amenities as $row) {

            $data = VillaAmenities::insert(array(
                'id_villa' => $id_villa,
                'id_amenities' => $row,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        foreach ($request->bathroom as $row) {

            $data = VillaBathroom::insert(array(
                'id_villa' => $id_villa,
                'id_bathroom' => $row,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        foreach ($request->bedroom as $row) {

            $data = VillaBedroom::insert(array(
                'id_villa' => $id_villa,
                'id_bedroom' => $row,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        foreach ($request->kitchen as $row) {

            $data = VillaKitchen::insert(array(
                'id_villa' => $id_villa,
                'id_kitchen' => $row,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        foreach ($request->safety as $row) {

            $data = VillaSafety::insert(array(
                'id_villa' => $id_villa,
                'id_safety' => $row,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        foreach ($request->service as $row) {

            $data = VillaService::insert(array(
                'id_villa' => $id_villa,
                'id_service' => $row,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));
        }

        $type = VillaTypeDetail::insert(array(
            'id_villa' => $id_villa,
            'id_villa_type' => $request->id_villa_type,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('VillaController@add_step_nine');
    }

    public function add_step_nine()
    {
        $this->authorize('listvilla_create');
        $data = Villa::where('created_by', Auth::user()->id)->where('step', '<>', 0)->get();
        return view('admin.villa.add_list.step9', compact('data'));
    }

    public function add_step_nine_store(Request $request)
    {

        $this->authorize('listvilla_create');
        //insert into database
        $data = Villa::where('created_by', Auth::user()->id)->where('step', '<>', 0)->first();

        $data->update(array(
            'price' => $request->price,
            'step' => 0,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->action('VillaController@add_step_ten');
    }

    public function add_step_ten()
    {
        $this->authorize('listvilla_create');
        return view('admin.villa.add_list.step10');
    }
}
