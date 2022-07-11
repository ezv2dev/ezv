<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Collaborator;
use App\Models\CollaboratorHasCategory;
use App\Models\CollaboratorCategory;
use App\Models\CollaboratorFilter;
use App\Models\CollaboratorLanguage;
use App\Models\Location;
use App\Models\CollaboratorPhoto;
use App\Models\CollaboratorStory;
use App\Models\CollaboratorVideo;
use Collator;
use File;
use App\Models\HostLanguage;
use App\Models\ProfileLanguage;

use App\Services\FileCompressionService as FileCompression;

class CollaboratorController extends Controller
{
    public function collaborator_list()
    {
        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        $collab = Collaborator::where('status', 1)->with('user')->get();
        $collabCategory = CollaboratorCategory::all();
        $collabFilter = CollaboratorFilter::all();

        return view('collaborator.list_collaborator', compact('collab', 'collabCategory', 'collabFilter'));
    }

    public static  function gallery($id)
    {
        $gallery = CollaboratorPhoto::select('collaborator_photo.name as photo')->where('id_collab', $id)->get();
        // dd($gallery);

        return $gallery;
    }

    // profile
    public function collaborator($id)
    {
        $this->authorize('collaborator_index');

        $profile = Collaborator::select('location.name as name_location', 'collaborator.*')
            ->join('location', 'collaborator.id_location', '=', 'location.id_location', 'left')
            ->join('users', 'users.id', '=', 'collaborator.created_by')
            ->where('collaborator.id_collab', $id)->first();

        abort_if(!$profile, 404);

        $user = User::where('id', $profile->created_by)->first();
        $tags = CollaboratorHasCategory::with('collaboratorCategory')->where('id_collab', $id)->get();
        $category = CollaboratorCategory::get();
        $location = Location::get();
        $photo = CollaboratorPhoto::where('id_collab', $id)->get();
        $video = CollaboratorVideo::where('id_collab', $id)->get();
        $stories = CollaboratorStory::where('id_collab', $id)->get();
        $languages = HostLanguage::all();
        $owner_language = CollaboratorLanguage::where('id_collab', $id)
            ->with('language')
            ->get();

        // dd($owner_language);

        if ($profile == null) {
            $this->authorize('collaborator_create');
            $profile = Collaborator::create([
                'uid' => rand(10000, 99999) . time(),
                'status' => 0,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => $id,
                'updated_by' => $id,
            ]);
        }

        return view('collaborator.profile', compact('owner_language', 'languages', 'user', 'profile', 'tags', 'category', 'location', 'photo', 'video', 'stories'));
    }
    // profile

    // update profile
    public function collab_update_image(Request $request)
    {
        $this->authorize('collaborator_update');

        // validation
        request()->validate([
            'id_collab' => ['required', 'integer'],
            'image' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960'],
        ]);

        $profile = Collaborator::where('id_collab', $request->id_collab)->first();
        // dd($profile);

        $status = 500;

        try {
            $berkas = $request->image;

            //cek the directori first
            $find = Collaborator::where('id_collab', $request->id_collab)->get();
            // dd($find);
            // $folder = strtolower($find[0]->name);
            // $path = public_path() . '/foto/gallery/' . $folder;
            $folder = strtolower($find[0]->uid);
            $path = env("COLLAB_FILE_PATH") . $folder;

            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $ext = strtolower($berkas->getClientOriginalExtension());

            if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {

                $original_name = $berkas->getClientOriginalName();

                $name_file = time() . "_" . $original_name;
                // isi dengan nama folder tempat kemana file diupload
                // $berkas->move($path, $name_file);
                // if file size > 1 MB, quality 30%
                // if file size > 700 KB, quality 40%
                // else, quality 50%

                $name_file = FileCompression::compressImageToCustomExt($berkas, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

                //insert into database
                $data = Collaborator::where('id_collab', $request->id_collab)->update([
                    'image' => $name_file,
                    'updated_by' => Auth::user()->id,
                ]);
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
    // update profile

    // update name
    public function collab_update_name(Request $request)
    {
        $this->authorize('collaborator_update');

        $status = 500;

        try {
            if (!$request->id) {
                //
            } else {
                $name = explode(" ", $request->name);
                $first_name = $name[0];
                unset($name[0]);
                $last_name = implode(" ", $name);
                $user = User::where('id', $request->id)->first();
                $user->update(array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                ));
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
    // updatename

    // update category
    public function collab_store_category(Request $request)
    {

        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        // validation
        $validator = Validator::make($request->all(), [
            'id_collab' => ['required', 'integer'],
            'category' => ['array'],
        ]);
        if ($validator->fails()) {
            abort(500);
        }

        // profile data
        $profile = Collaborator::find($request->id_collab);

        // check if profile does not exist, abort 404
        abort_if(!$profile, 404);

        // check if the editor does not have authorization
        $this->authorize('collaborator_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $profile->created_by) {
            abort(403);
        }

        CollaboratorHasCategory::where('id_collab', $request->id_collab)->delete();

        try {
            if ($request->category) {
                foreach ($request->category as $id_category) {
                    CollaboratorHasCategory::create([
                        'id_collab' => $request->id_collab,
                        'id_category' => $id_category,
                        'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id
                    ]);
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
    // update category

    // update location
    public function collab_update_location(Request $request)
    {
        $this->authorize('collaborator_update');
        $status = 500;

        try {
            $find = Collaborator::where('id_collab', $request->id_collab)->first();

            $find->update(array(
                'id_location' => $request->id_location,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
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
    // update location

    // update language
    public function collab_update_language(Request $request)
    {
        dd($request->all());
        $this->authorize('collaborator_update');
        $status = 500;

        try {
            $find = Collaborator::where('id_collab', $request->id_collab)->first();

            $find->update(array(
                'id_location' => $request->id_location,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
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
    // update language

    public function collab_story(Request $request)
    {
        // $data = VillaStory::where('id_story', $id)->get();
        $data = CollaboratorStory::with('collab')->where('id_story', $request->id)->first();

        if ($data) {
            return response()->json([
                'id_story' => $data->id_story,
                'title' => $data->title,
                'name' => $data->name,
                'collab' => (object)[
                    'uid' => $data->collab->uid
                ] ?? null,
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

    public function update_story(Request $request)
    {
        $this->authorize('collaborator_update');

        $status = 500;

        try {
            $berkas = $request->file;
            if (empty($berkas)) {
                $status = 500;
            } else {
                $find = CollaboratorStory::with('collab')->where('id_collab', $request->id_collab)->get();
                // $folder = strtolower($find[0]->name);
                // $path = public_path() . '/foto/gallery/' . $folder;
                $folder = $find[0]->collab->uid;
                // dd($folder);
                $path = env("COLLAB_FILE_PATH") . $folder;
                if (!File::isDirectory($path)) {

                    File::makeDirectory($path, 0777, true, true);
                }

                $ext = strtolower($berkas->getClientOriginalExtension());

                if ($ext == 'mp4') {
                    $original_name = $berkas->getClientOriginalName();

                    $name_file = time() . "_" . $original_name;
                    // isi dengan nama folder tempat kemana file diupload
                    $berkas->move($path, $name_file);

                    $data = CollaboratorStory::insert(array(
                        'title' => $request->title,
                        'name' => $name_file,
                        'id_collab' => $request->id_collab,
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

    public function delete_story(Request $request)
    {
        $this->authorize('collaborator_update');

        $collabStory = CollaboratorStory::with('collab')->where('id_story', $request->id_story)->first();
        abort_if(!$collabStory, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collabStory->created_by;
        abort_if($condition, 403);

        // delete video
        // $path = public_path() . '/foto/gallery/' . $villa->name;
        $folder = $collabStory->collab->uid;
        $path = env("COLLAB_FILE_PATH") . $folder;

        // remove old video
        if (File::exists($path . '/' . $collabStory->name)) {
            File::delete($path . '/' . $collabStory->name);
        }

        $deleted = $collabStory->delete();

        // check if delete is success or not
        if ($deleted) {
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

    public function collab_delete_photo_photo(Request $request)
    {
        $this->authorize('collaborator_update');

        $collab = Collaborator::where('id_collab', $request->id)->first();
        $collabPhoto = CollaboratorPhoto::where('id_photo', $request->id_photo)->first();
        abort_if(!$collab, 404);
        abort_if(!$collabPhoto, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collabPhoto->created_by;
        abort_if($condition, 403);

        // delete photo
        // $path = public_path() . '/foto/gallery/' . $villa->name;
        $folder = $collab->uid;
        $path = env("COLLAB_FILE_PATH") . $folder;

        // remove old photo
        if (File::exists($path . '/' . $collabPhoto->name)) {
            File::delete($path . '/' . $collabPhoto->name);
        }

        $deleted = $collabPhoto->delete();
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

    public function collab_delete_photo_video(Request $request)
    {
        $this->authorize('collaborator_update');

        $collab = Collaborator::where('id_collab', $request->id)->first();
        $collabVideo = CollaboratorVideo::where('id_video', $request->id_video)->first();
        abort_if(!$collab, 404);
        abort_if(!$collabVideo, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collabVideo->created_by;
        abort_if($condition, 403);

        // delete photo
        // $path = public_path() . '/foto/gallery/' . $villa->name;
        $folder = $collab->uid;
        $path = env("COLLAB_FILE_PATH") . $folder;

        // remove old photo
        if (File::exists($path . '/' . $collabVideo->name)) {
            File::delete($path . '/' . $collabVideo->name);
        }

        $deleted = $collabVideo->delete();
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

    public function update_description(Request $request)
    {
        $this->authorize('collaborator_update');
        $status = 500;

        try {
            $find = Collaborator::where('id_collab', $request->id_collab)->first();

            $find->update(array(
                'description' => str_replace(array("\n", "\r"), ' ', $request->description),
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

    public function update_language(Request $request)
    {
        $this->authorize('collaborator_update');
        $status = 500;

        try {
            $find = CollaboratorLanguage::where('id_collab', $request->id_collab)->get();

            // dd($find);

            foreach ($find as $item) {
                CollaboratorLanguage::where('id_language', $item->id_language)->delete();
            }

            $language = $request->language;
            // dd($language);

            foreach ($language as $key => $value) {
                $data[] = [
                    'id_collab' => $request->id_collab,
                    'id_language' => $value,
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ];
            }

            $store = CollaboratorLanguage::insert($data);

            if ($store) {
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

    public function collab_update_photo(Request $request)
    {
        $this->authorize('collaborator_update');
        // validation
        $validator = Validator::make($request->all(), [
            'id_collab' => ['required', 'integer'],
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
                $find = Collaborator::where('id_collab', $request->id_collab)->get();
                // $folder = strtolower($find[0]->name);
                // $path = public_path() . '/foto/gallery/' . $folder;
                $folder = $find[0]->uid;
                $path = env("COLLAB_FILE_PATH") . $folder;

                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $ext = strtolower($berkas->getClientOriginalExtension());

                if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
                    request()->validate([
                        'id_collab' => ['required', 'integer'],
                        'file' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960']
                    ]);

                    $original_name = $berkas->getClientOriginalName();

                    $name_file = time() . "_" . $original_name;
                    $name_file = FileCompression::compressImageToCustomExt($request->file, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');

                    //insert into database
                    $data = CollaboratorPhoto::create([
                        'name' => $name_file,
                        'id_collab' => $request->id_collab,
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id
                    ]);
                } elseif ($ext == 'mp4') {
                    $original_name = $berkas->getClientOriginalName();

                    $name_file = time() . "_" . $original_name;

                    // isi dengan nama folder tempat kemana file diupload
                    $berkas->move($path, $name_file);

                    //insert into database
                    $data = CollaboratorVideo::create([
                        'name' => $name_file,
                        'id_collab' => $request->id_collab,
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id
                    ]);
                }
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

    public function video_open($id)
    {
        $data = CollaboratorVideo::with('collab')->where('id_video', $id)->first();
        $user = User::where('id', $data->collab->created_by)->select('first_name', 'last_name')->first();

        if ($data) {
            return response()->json([
                'video' => $data->name,
                'collab' => (object)[
                    'uid' => $data->collab->uid,
                    // 'uid' => $data->villa->uid
                ] ?? null
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        echo json_encode($data);
    }

    public function status(Request $request, $id)
    {
        $find = Collaborator::where('id_collab', $id)->first();
        if ($find->status == 2) {
            $find->update(array(
                'status' =>  1,
                'grade' => $request->grade,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
        } else {
            $find->update(array(
                'status' =>  0,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
        }

        return back();
    }

    public function request_update_status(Request $request)
    {
        $id = $request->id;
        $find = Collaborator::where('id_collab', $id)->first();

        if ($find->status == 0) {
            $find->update(array(
                'status' =>  2, //request activation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($find->status == 1) {
            $find->update(array(
                'status' =>  3, //request deactivation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($status) {
            return back()
                ->with('success', 'request has been sended');
        } else {
            return back()
                ->with('error', 'request fail to sended due internal server error');
        }
    }

    public function cancel_request_update_status(Request $request)
    {
        $id = $request->id;
        $find = Collaborator::where('id_collab', $id)->first();

        if ($find->status == 2) {
            $find->update(array(
                'status' =>  0, //cancel request activation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($find->status == 3) {
            $find->update(array(
                'status' =>  1, //cancel request deactivation
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
            $status = true;
        }

        if ($status) {
            return back()
                ->with('success', 'request has been sended');
        } else {
            return back()
                ->with('error', 'request fail to sended due internal server error');
        }
    }

    public function grade(Request $request, $id)
    {
        $find = Collaborator::where('id_collab', $id)->first();

        $find->update(array(
            'grade' => $request->grade,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));

        return redirect()->back()->with('success', 'Your data has been update');
    }
}
