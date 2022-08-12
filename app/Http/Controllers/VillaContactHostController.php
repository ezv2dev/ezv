<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use App\Models\VillaContactHost;
use App\Models\VillaContactHostReply;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use App\Models\VillaSave;

class VillaContactHostController extends Controller
{
    public function index(Request $request)
    {
        abort_if(auth()->user()->role->name != 'user', 403);

        $allConversationList = VillaContactHost::where('id_user', auth()->user()->id)
            ->orderBy('created_at')->get();
        // dd('hit');

        $user = User::get();
        $villa = Villa::get();
        $save = VillaSave::get();
        $location = Villa::select('location.name', 'location.id_location')
            ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
            ->join('villa_save', 'villa.id_villa', '=', 'villa_save.id_villa', 'left')
            ->where('id_user', auth()->user()->id)->get();
        $i = 1;

        return view('user.profile.messages', compact('user', 'save', 'location', 'villa', 'allConversationList', 'i'));
    }

    public function admin_index()
    {
        abort_if(!in_array(auth()->user()->role->name, ['admin', 'superadmin']), 403);
        if (in_array(auth()->user()->role->name, ['admin', 'superadmin'])) {
            $allConversationList = collect();
            $conversationList = VillaContactHost::all();
            $conversationReplyList = VillaContactHostReply::all();
            $allConversationList = $allConversationList->merge($conversationList)->merge($conversationReplyList);
        }
        $i = 0;
        // dd($allConversationList[4]->conversation->owner->name);
        return view('admin.villa.messages.admin')->with(compact('allConversationList', 'i'));
    }

    public function owner_index()
    {
        abort_if(auth()->user()->role->name != 'partner', 403);
        $allConversationList = VillaContactHost::where('id_owner', auth()->user()->id)
            ->where('approve_by', '!=', null)
            ->where('disapprove_by', '=', null)
            ->orderBy('created_at')->get();
        $i = 1;
        // dd($allConversationList);
        return view('admin.villa.messages.owner')->with(compact('allConversationList', 'i'));
    }

    public function store_message(Request $request)
    {
        $request->validate([
            'id_owner' => ['required', 'integer'],
            'message' => ['required', 'string'],
        ]);

        $createdMessage = VillaContactHost::create([
            'id_owner' => $request->id_owner,
            'id_user' => auth()->user()->id,
            'message' => $request->message,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        if ($createdMessage) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully Sent Message to the Host',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Please check the form below for errors',
            ], 500);
        }
    }

    public function reply_message(Request $request)
    {
        $request->validate([
            'id_message' => ['required', 'integer'],
            'id_owner' => ['required', 'integer'],
            'message' => ['required', 'string'],
        ]);

        // abort_if(auth()->user()->id != $request->id_owner, 403);
        $messageReply = VillaContactHostReply::where('id_message', $request->id_message)->get();
        if ($messageReply->count() > 0) {
            return back()
                ->with('error', 'you already reply the message');
        }

        $createdMessage = VillaContactHostReply::create([
            'id_message' => $request->id_message,
            'message' => $request->message,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        if ($createdMessage) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function update_approve_user_message(Request $request)
    {
        $request->validate([
            'id_message' => ['required', 'integer'],
        ]);

        abort_if(!in_array(auth()->user()->role->name, ['admin', 'superadmin']), 403);

        $message = VillaContactHost::find($request->id_message);

        $updatedMessage = $message->update([
            'approve_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'approve_by' => auth()->user()->id,
        ]);

        if ($updatedMessage) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function update_disapprove_user_message(Request $request)
    {
        $request->validate([
            'id_message' => ['required', 'integer'],
        ]);

        abort_if(!in_array(auth()->user()->role->name, ['admin', 'superadmin']), 403);

        $message = VillaContactHost::find($request->id_message);

        $updatedMessage = $message->update([
            'disapprove_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'disapprove_by' => auth()->user()->id,
        ]);

        if ($updatedMessage) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function update_approve_owner_message(Request $request)
    {
        $request->validate([
            'id_reply' => ['required', 'integer'],
        ]);

        abort_if(!in_array(auth()->user()->role->name, ['admin', 'superadmin']), 403);

        $message = VillaContactHostReply::find($request->id_reply);

        $updatedMessage = $message->update([
            'approve_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'approve_by' => auth()->user()->id,
        ]);

        if ($updatedMessage) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }

    public function update_disapprove_owner_message(Request $request)
    {
        $request->validate([
            'id_reply' => ['required', 'integer'],
        ]);

        abort_if(!in_array(auth()->user()->role->name, ['admin', 'superadmin']), 403);

        $message = VillaContactHostReply::find($request->id_reply);

        $updatedMessage = $message->update([
            'disapprove_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'disapprove_by' => auth()->user()->id,
        ]);

        if ($updatedMessage) {
            return back()
                ->with('success', 'Your data has been updated');
        } else {
            return back()
                ->with('error', 'Please check the form below for errors');
        }
    }
}
