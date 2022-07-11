<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Villa;
use File;

class LocationController extends Controller
{
    public function index()
    {
        $this->authorize('location_index');
        // return view('admin.location.index');
        return view('new-admin.location.index');
    }

    public function datatable()
	{
        $this->authorize('location_index');
		return Location::datatables();
	}

    public function create()
    {
        $this->authorize('location_create');
        $location = Location::get();
        // return view('admin.location.create', compact('location'));
        return view('new-admin.location.create', compact('location'));
    }

    public function store(Request $request){

        // dd($request->all());
        $this->authorize('location_create');
        $status = 500;

        try {
            $request->validate([
                'name' => 'required',
            ]);

            $berkas = $request->image;
            if (empty($berkas)) {
                dd('hit image empty');
                //insert into database
                $data = Location::insert(array(
                    'name' => $request->name,
                    'description' => $request->description,
                    'latitude' => $request->latitude,
                    'longitude' =>$request->longitude,
                    'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));
            }else{
                // dd('hit image exist');
                //cek the directori first
                $folder = strtolower($request->name);
                // $path = public_path().'/foto/location/'.$folder;
                $path = env('LOCATION_FILE_PATH').$folder;
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
                $data = Location::insert(array(
                    'name' => $request->name,
                    'description' => $request->description,
                    'image'=> $name_file,
                    'latitude' => $request->latitude,
                    'longitude' =>$request->longitude,
                    'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ));

            }

            if ($data){
                $status = 200;
            }
        } catch ( \Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if($status == 200){
            return redirect()->route('admin_location')
            ->with('success', 'Your data has been submited');
        }else{
            return back()
            ->with('error','Please check the form below for errors');
        }

    }

    public function show($id)
    {
        $this->authorize('location_update');
        $location = Location::get();
        $find = Location::where('id_location', $id)->get();
        // return view('admin.location.edit', compact('find', 'location'));
        return view('new-admin.location.edit', compact('find', 'location'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('location_update');
        $status = 500;

        try {
            $data = Location::where('id_location', $id)->first();

        $request->validate([
            'name' => 'required',
        ]);

        $berkas = $request->image;

        if(strtolower($data->name) != strtolower($request->name))
        {
            if (empty($berkas)) {

                if($data->image != null)
                {
                    $old_folder = strtolower($data->name);
                    $new_folder = strtolower($request->name);
                    $path_new = public_path().'/foto/location/'.$new_folder;
                    if(!File::isDirectory($path_new)){

                        File::makeDirectory($path_new, 0777, true, true);

                    }
                    File::copy(public_path('/foto/location/'.$old_folder.'/'.$data->image), public_path('/foto/location/'.$new_folder.'/'.$data->image));
                    File::deleteDirectory(public_path('foto/location/'.$data->name));
                }else{
                    File::deleteDirectory(public_path('foto/location/'.$data->name));
                }

                $data->update(array(
                    'name' => $request->name,
                    'description' => $request->description,
                    'latitude' => $request->latitude,
                    'longitude' =>$request->longitude,
                    'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'updated_by' => Auth::user()->id,
                ));
            }else{
                File::deleteDirectory(public_path('foto/location/'.$data->name));
                //cek the directori first
                $folder = strtolower($request->name);
                $path = public_path().'/foto/location/'.$folder;
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

                $data->update(array(
                    'name' => $request->name,
                    'description' => $request->description,
                    'latitude' => $request->latitude,
                    'longitude' =>$request->longitude,
                    'image' => $name_file,
                    'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'updated_by' => Auth::user()->id,
                ));

            }
        }
        else{
            if (empty($berkas)) {
                $data->update(array(
                    'name' => $request->name,
                    'description' => $request->description,
                    'latitude' => $request->latitude,
                    'longitude' =>$request->longitude,
                    'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'updated_by' => Auth::user()->id,
                ));
            }else{
                //cek the directori first
                $folder = strtolower($request->name);
                $path = public_path().'/foto/location/'.$folder;

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

                    //hapus berkas lama
                    File::delete($path.'/'.$data->image);

                }

                $data->update(array(
                    'name' => $request->name,
                    'description' => $request->description,
                    'image' => $name_file,
                    'latitude' => $request->latitude,
                    'longitude' =>$request->longitude,
                    'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'updated_by' => Auth::user()->id,
                ));

            }
        }

            if ($data){
                $status = 200;
            }
        } catch ( \Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if($status == 200){
            return redirect()->route('admin_location')
            ->with('success', 'Your data has been updated');
        }else{
            return back()
            ->with('error','Please check the form below for errors');
        }

    }

    public function destroy($id)
    {
        $this->authorize('location_delete');
        $status = 500;

        try {
            $villa = Villa::where('id_location', $id)->first();
            if($villa){
                $status = 500;
            }else{
                $find = Location::where('id_location', $id)->first();
                File::deleteDirectory(public_path('foto/location/'.$find->name));
                $find->delete();

                if ($find){
                    $status = 200;
                }
            }
        } catch ( \Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if($status == 200){
            return redirect()->route('admin_location')
            ->with('success', 'Your data has been deleted');
        }else{
            return back()
            ->with('error','Please check the data before delete maybe have relation');
        }

    }
}
