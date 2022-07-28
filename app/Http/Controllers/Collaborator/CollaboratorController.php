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
use App\Models\CollaboratorSave;
use App\Models\CollaboratorSocialMedia;
use App\Models\CollaboratorStory;
use App\Models\CollaboratorVideo;
use Collator;
use File;
use App\Models\HostLanguage;
use App\Models\ProfileLanguage;

use App\Services\FileCompressionService as FileCompression;
use Illuminate\Validation\Rule;

class CollaboratorController extends Controller
{
    public function index()
    {
        return view('collaborator.collaborator_intro');
    }

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
        // check if editor not authenticated
        abort_if(!auth()->check(), 401);

        $profile = Collaborator::with(['collaboratorSocial', 'detailReview'])->select('location.name as name_location', 'collaborator.*')
            ->join('location', 'collaborator.id_location', '=', 'location.id_location', 'left')
            ->join('users', 'users.id', '=', 'collaborator.created_by')
            ->where('collaborator.id_collab', $id)
            ->where('collaborator.status', 1)
            ->first();

        // check if collab does not exist, abort 404
        abort_if(!$profile, 404);

        // check if the editor does not have authorization
        // $this->authorize('collaborator_index');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin', 'partner', 'collaborator']) && auth()->user()->id != $profile->created_by) {
            abort(403);
        }elseif(in_array(auth()->user()->role->name, ['admin', 'superadmin']) || auth()->user()->id == $profile->created_by){
            $profile = Collaborator::with(['collaboratorSocial', 'detailReview'])->select('location.name as name_location', 'collaborator.*')
                ->join('location', 'collaborator.id_location', '=', 'location.id_location', 'left')
                ->join('users', 'users.id', '=', 'collaborator.created_by')
                ->where('collaborator.id_collab', $id)
                ->where('collaborator.status', 1)
                ->first();
        };
        $profile->append('user_review');

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

        return view('collaborator.collaborator', compact('owner_language', 'languages', 'user', 'profile', 'tags', 'category', 'location', 'photo', 'video', 'stories'));
    }
    // profile

    public function update_position_photo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'imageids' => ['required', 'array'],
            'id' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 500);
        }

        $imageids_arr = $request->imageids;

        $collab = Collaborator::find($request->id);

        if (!$collab) {
            return response()->json([
                'message' => 'Data Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('collaborator_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collab->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        if (count($imageids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($imageids_arr as $id) {
                $find = CollaboratorPhoto::where('id_photo', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            $data = [
                'photo' => CollaboratorPhoto::where('id_collab', $request->id)->orderBy('order', 'asc')->get(),
                'video' => CollaboratorVideo::where('id_collab', $request->id)->orderBy('order', 'asc')->get(),
                'uid' => Collaborator::where('id_collab', $request->id)->select('uid')->first(),
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
    public function update_position_video(Request $request)
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

        $collab = Collaborator::find($request->id);

        if (!$collab) {
            return response()->json([
                'message' => 'Data Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('collaborator_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collab->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        if (count($videoids_arr) > 0) {
            // Update sort position of images
            $position = 1;
            foreach ($videoids_arr as $id) {
                $find = CollaboratorVideo::where('id_video', $id)->first();
                abort_if(!$find, 404);
                $find->update(array(
                    'order' => $position,
                    'updated_by' => auth()->user()->id,
                ));

                $position++;
            }

            $data = [
                'photo' => CollaboratorPhoto::where('id_collab', $request->id)->orderBy('order', 'asc')->get(),
                'video' => CollaboratorVideo::where('id_collab', $request->id)->orderBy('order', 'asc')->get(),
                'uid' => Collaborator::where('id_collab', $request->id)->select('uid')->first(),
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


    // update profile
    public function collab_update_image(Request $request)
    {
        /*
        $this->authorize('collaborator_update');

        // validation
        request()->validate([
            'id_collab' => ['required', 'integer'],
            'image' => ['required', 'mimes:jpeg,png,jpg,webp', 'dimensions:min_width=960'],
        ]);

        $profile = Collaborator::where('id_collab', $request->id_collab)->first();

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
        */
        $profile = Collaborator::where('id_collab', $request->id_collab)->first('uid');
        $folder = $profile->uid;
        $path = env("COLLAB_FILE_PATH") . $folder;

        if (!File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->image->getClientOriginalExtension());
        // dd($ext);

        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
            $original_name = $request->image->getClientOriginalName();
            $find = Collaborator::where('id_collab', $request->id_collab)->first();
            $name_file = time() . "_" . $original_name;
            $name_file = FileCompression::compressImageToCustomExt($request->image, $path, pathinfo($name_file, PATHINFO_FILENAME), 'webp');
            $updatedCollab = $find->update(array(
                'image' => $name_file,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_by' => Auth::user()->id,
            ));
        }

        $profileData = Collaborator::where('id_collab', $request->id_collab)->select('image')->first();

        if ($updatedCollab) {
            return response()->json([
                'message' => 'Successfuly Updated Collaborator Profile',
                'status' => 200,
                'data' => $profileData
            ]);
        } else {
            return response()->json([
                'message' => 'Error Updated Collaborator Profile',
                'status' => 500,
            ]);
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
                if ($user->update(array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                ))) {
                    $status = 200;
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 500;
        }

        if ($status == 200) {
            // return back()
            //     ->with('success', 'Your data has been updated');
            return response()->json(['success' => true, 'message' => 'Succesfully Updated Collaborator Name',  'data' => $request->name]);
        } else {
            // return back()
            //     ->with('error', 'Please check the form below for errors');
            return response()->json(['errors' => true, 'message' => 'Fail Updated Collaborator Name',  'data' => $request->name]);
        }
    }
    // updatename

    public function collab_update_gender(Request $request)
    {
        // check if editor not authenticated
        if(!auth()->check())
        {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_collab' => ['required', 'integer'],
            'gender' => ['nullable', Rule::in(Collaborator::GENDER)],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // collab data
        $collab = Collaborator::find($request->id_collab);

        // check if collab does not exist, abort 404
        if (!$collab) {
            return response()->json([
                'message' => 'Data Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('collaborator_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collab->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $updatedCollab = $collab->update([
            'gender' => $request->gender,
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ]);

        $collabData = Collaborator::where('id_collab', $request->id_collab)->select('gender')->first();

        // check if update is success or not
        if ($updatedCollab) {
            return response()->json([
                'message' => 'Successfuly Updated Gender',
                'data' => $collabData
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Updated Gender',
            ], 500);
        }
    }

    // update category
    public function collab_store_category(Request $request)
    {
        // check if editor not authenticated
        if(!auth()->check())
        {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_collab' => ['required', 'integer'],
            'category' => ['nullable', 'array'],
            'category.*' => ['nullable', Rule::in(CollaboratorCategory::get()->modelKeys())],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // collab data
        $collab = Collaborator::find($request->id_collab);

        // check if collab does not exist, abort 404
        if (!$collab) {
            return response()->json([
                'message' => 'Data Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('collaborator_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collab->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        CollaboratorHasCategory::where('id_collab', $request->id_collab)->delete();

        if ($request->category) {
            foreach ($request->category as $id_collab_category) {
                $data[] = [
                    'id_collab' => $request->id_collab,
                    'id_collab_category' => $id_collab_category,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id
                ];
            }

            $updatedCollab = CollaboratorHasCategory::insert($data);
        } else {
            $updatedCollab = true;
        }

        $collabData = Collaborator::where('id_collab', $request->id_collab)->first();

        // check if update is success or not
        if ($updatedCollab) {
            return response()->json([
                'message' => 'Successfuly Updated Tags',
                'data' => $collabData->category
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Updated Tags',
            ], 500);
        }
    }
    // update category

    // update location
    public function collab_update_location(Request $request)
    {
        // check if editor not authenticated
        if(!auth()->check()) {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_collab' => ['required', 'integer'],
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

        // collab data
        $collab = Collaborator::find($request->id_collab);

        // check if collab does not exist, abort 404
        if (!$collab) {
            return response()->json([
                'message' => 'Data Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('collaborator_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collab->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $updatedCollab = $collab->update([
            'id_collab' => $request->id_collab,
            'id_location' => $request->id_location,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'updated_by' => auth()->user()->id,
        ]);

        $collabData = Collaborator::where('id_collab', $request->id_collab)->with('location')->first();

        // check if update is success or not
        if ($updatedCollab) {
            return response()->json([
                'message' => 'Successfuly Updated Location',
                'data' => (object)[
                    'latitude' => $collabData->latitude,
                    'longitude' => $collabData->longitude,
                    'location' => (object)[
                        'name' => $collabData->location->name,
                    ],
                ]
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Updated Location',
            ], 500);
        }
    }
    // update location

    // update social media
    public function collab_update_social_media(Request $request)
    {
        // check if editor not authenticated
        if(!auth()->check())
        {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_collab' => ['nullable', 'integer'],
            'instagram_link' => ['nullable', 'string'],
            'instagram_follower' => ['nullable', 'integer'],
            'facebook_link' => ['nullable', 'string'],
            'facebook_follower' => ['nullable', 'integer'],
            'twitter_link' => ['nullable', 'string'],
            'twitter_follower' => ['nullable', 'integer'],
            'tiktok_link' => ['nullable', 'string'],
            'tiktok_follower' => ['nullable', 'integer'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // collab data
        $collab = Collaborator::where('id_collab', $request->id_collab)->first();

        // check if collab does not exist, abort 404
        if (!$collab) {
            return response()->json([
                'message' => 'Data Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        // $this->authorize('collaborator_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collab->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // update
        $findCollabSocialMedia = CollaboratorSocialMedia::where('id_collab', $request->id_collab)->first();
        if($findCollabSocialMedia){
            $updatedCollab = $findCollabSocialMedia->update([
                'id_collab' => $request->id_collab,
                'instagram_link' => $request->instagram_link,
                'instagram_follower' => $request->instagram_follower,
                'facebook_link' => $request->facebook_link,
                'facebook_follower' => $request->facebook_follower,
                'twitter_link' => $request->twitter_link,
                'twitter_follower' => $request->twitter_follower,
                'tiktok_link' => $request->tiktok_link,
                'tiktok_follower' => $request->tiktok_follower,
                'follower_amount' => $request->instagram_follower + $request->facebook_follower + $request->twitter_follower + $request->tiktok_follower
            ]);
        } else {
            $updatedCollab = CollaboratorSocialMedia::create([
                'id_collab' => $request->id_collab,
                'instagram_link' => $request->instagram_link,
                'instagram_follower' => $request->instagram_follower,
                'facebook_link' => $request->facebook_link,
                'facebook_follower' => $request->facebook_follower,
                'twitter_link' => $request->twitter_link,
                'twitter_follower' => $request->twitter_follower,
                'tiktok_link' => $request->tiktok_link,
                'tiktok_follower' => $request->tiktok_follower,
                'follower_amount' => $request->instagram_follower + $request->facebook_follower + $request->twitter_follower + $request->tiktok_follower
            ]);
        }

        $collab = CollaboratorSocialMedia::where('id_collab', $request->id_collab)->first();

        // check if update is success or not
        if ($updatedCollab) {
            return response()->json([
                'message' => 'Successfuly Updated Social Media',
                'data' => $collab
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Updated Social Media',
            ], 500);
        }
    }
    // end update social media

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
        // $data = CollabStory::where('id_story', $id)->get();
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
        // check if editor not authenticated
        if(!auth()->check())
        {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_collab' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:100'],
            'file' => ['required', 'mimes:mp4,mov']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 500);
        }

        // collab data
        $collab = Collaborator::find($request->id_collab);

        // check if collab does not exist, abort 404
        if (!$collab) {
            return response()->json([
                'message' => 'Data Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('collaborator_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collab->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // store process
        // $path = public_path() . '/foto/restaurant/' . $restaurant->name;
        $folder = strtolower($collab->uid);
        // dd($folder);
        $path = env("COLLAB_FILE_PATH") . $folder;

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
            $createdStory = CollaboratorStory::create([
                'title' => $request->title,
                'name' => $name_file,
                'id_collab' => $request->id_collab,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }

        $getStory = CollaboratorStory::where('id_collab', $request->id_collab)->select('name', 'id_story')->latest()->get();
        $getUID = Collaborator::where('id_collab', $request->id_collab)->select('uid')->first();
        $collabVideo = CollaboratorVideo::where('id_collab', $request->id_collab)->select('id_video', 'name')->orderBy('order', 'asc')->get();

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
                'message' => 'Updated Collaborator Story',
                'data' => $data,
                'uid' => $getUID->uid,
                'video' => $collabVideo,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Updated Collaborator Story',
            ], 500);
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
        // $path = public_path() . '/foto/gallery/' . $profile->name;
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
        abort_if(!$request->id_photo || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $collab = Collaborator::where('id_collab', $request->id)->first();
        $collabPhoto = CollaboratorPhoto::where('id_photo', $request->id_photo)->first();
        abort_if(!$collab, 404);
        abort_if(!$collabPhoto, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collabPhoto->created_by;
        abort_if($condition, 403);

        // delete photo
        // $path = public_path() . '/foto/gallery/' . $profile->name;
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
        abort_if(!$request->id_video || !$request->id, 500);
        abort_if(!auth()->check(), 401);

        $collab = Collaborator::where('id_collab', $request->id)->first();
        $collabVideo = CollaboratorVideo::where('id_video', $request->id_video)->first();
        abort_if(!$collab, 404);
        abort_if(!$collabVideo, 404);

        $condition = !in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collabVideo->created_by;
        abort_if($condition, 403);

        // delete photo
        // $path = public_path() . '/foto/gallery/' . $profile->name;
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
                //'description' => str_replace(array("\n", "\r"), ' ', $request->description),
                'description' => str_replace(array("\r\n"), "<br><br>", $request->collab_description),
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
            // return back()
            //     ->with('success', 'Your data has been updated');
            return response()->json(['success' => true, 'message' => 'Succesfully Updated Description Collaborator',  'data' => $request->collab_description]);
        } else {
            // return back()
            //     ->with('error', 'Please check the form below for errors');
            return response()->json(['errors' => true, 'message' => 'Please check the form below for errors',  'data' => $request->collab_description]);
        }
    }

    public function update_language(Request $request)
    {
        // check if editor not authenticated
        if(!auth()->check())
        {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_collab' => ['required', 'integer'],
            'language' => ['nullable', 'array'],
            'language.*' => ['nullable', Rule::in(HostLanguage::get()->modelKeys())],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // collab data
        $collab = Collaborator::find($request->id_collab);

        // check if collab does not exist, abort 404
        if (!$collab) {
            return response()->json([
                'message' => 'Data Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('collaborator_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collab->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        CollaboratorLanguage::where('id_collab', $request->id_collab)->delete();
        if($request->language){
            foreach ($request->language as $item) {
                $data[] = [
                    'id_collab' => $request->id_collab,
                    'id_language' => $item,
                    'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ];
            }
            $updatedCollab = CollaboratorLanguage::insert($data);
        } else {
            $updatedCollab = true;
        }

        $collab = CollaboratorLanguage::where('id_collab', $request->id_collab)->with('language')->get();

        // check if update is success or not
        if ($updatedCollab) {
            return response()->json([
                'message' => 'Successfuly Updated Language',
                'data' => $collab
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Updated Language',
            ], 500);
        }
    }

    public function collab_update_photo(Request $request)
    {
        // check if editor not authenticated
        if(!auth()->check())
        {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_collab' => ['required', 'integer'],
            'file' => ['required', 'mimes:jpeg,png,jpg,webp,mp4']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // collab data
        $collab = Collaborator::find($request->id_collab);

        // check if collab does not exist, abort 404
        if (!$collab) {
            return response()->json([
                'message' => 'Data Not Found',
            ], 404);
        }

        // check if the editor does not have authorization
        $this->authorize('collaborator_update');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin']) && auth()->user()->id != $collab->created_by) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        $folder = strtolower($collab->uid);
        $path = env("COLLAB_FILE_PATH") . $folder;

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $ext = strtolower($request->file->getClientOriginalExtension());

        $photo = [];

        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
            $validator2 = Validator::make($request->all(), [
                'id_collab' => ['required', 'integer'],
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
            $lastOrder = CollaboratorPhoto::where('id_collab', $request->id_collab)->orderBy('order', 'desc')->select('order')->first();
            if ($lastOrder) {
                $lastOrder = $lastOrder->order + 1;
            } else {
                $lastOrder = 1;
                $lastOrder;
            }

            //insert into database
            $createdCollab = CollaboratorPhoto::create([
                'id_collab' => $request->id_collab,
                'name' => $name_file,
                'order' => $lastOrder,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);

            // $photo['id_photo'] = $createdRestaurant->id_photo;
            array_push($photo, $createdCollab->id_photo);
        }

        $video = [];

        if ($ext == 'mp4' || $ext == 'mov') {
            $original_name = $request->file->getClientOriginalName();
            // dd($original_name);
            $name_file = time() . "_" . $original_name;
            // isi dengan nama folder tempat kemana file diupload
            $request->file->move($path, $name_file);

            // check last order
            $lastOrder = CollaboratorVideo::where('id_collab', $request->id_collab)->orderBy('order', 'desc')->select('order')->first();
            if ($lastOrder) {
                $lastOrder = $lastOrder->order + 1;
            } else {
                $lastOrder = 1;
                $lastOrder;
            }

            //insert into database
            $createdCollab = CollaboratorVideo::create([
                'id_collab' => $request->id_collab,
                'name' => $name_file,
                'order' => $lastOrder,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);

            array_push($video, $createdCollab->id_video);
        }

        $collabReturn = [
            'photo' => CollaboratorPhoto::whereIn('id_photo', $photo)->get(),
            'video' => CollaboratorVideo::whereIn('id_video', $video)->get(),
            'uid' => Collaborator::where('id_collab', $request->id_collab)->select('uid')->first(),
        ];

        if (isset($createdCollab) == true) {
            return response()->json([
                'message' => 'Update Gallery',
                'data' => $collabReturn,
            ], 200);
        } else if (isset($createdCollab) == false) {
            $validator = Validator::make($request->all(), [
                'id_collab' => ['required', 'integer'],
                'file' => ['required', 'mimes:jpeg,png,jpg,webp,mp4,mov']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->all(),
                ], 500);
            }
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
                    // 'uid' => $data->collab->uid
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

    public function like_collaborator(Request $request, $id)
    {
        // check if editor not authenticated
        if(!auth()->check())
        {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_collab' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // check if the editor does not have authorization
        // $this->authorize('collaborator_save_store');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin', 'partner', 'collaborator'])) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // check if there same favorit content
        $checkSameFavorit = CollaboratorSave::where([
            ['id_collab', '=', $request->id_collab],
            ['id_user', '=', auth()->user()->id],
        ])->first();

        if ($checkSameFavorit != null) {
            $checkSameFavorit->delete();
            $data = 0;
            return $data;
        } else {
            // otherwise, create favorit
            $data = CollaboratorSave::create([
                'id_collab' => $request->id_collab,
                'id_user' => auth()->user()->id,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);

            $data = 1;
            return $data;
        };
    }
}
