<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use App\Models\VillaContactHost;
use App\Models\VillaContactHostReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
    public function index()
    {
        if (in_array(Auth::user()->role_id, [1, 2])) {
            return view('new-admin.partner.inbox_admin');
        } else {
            $messageReply = VillaContactHostReply::select('id_message')->get();
            $tempReply = array();
            foreach ($messageReply as $item) {
                array_push($tempReply, $item->id_message);
            }
            $messageList = VillaContactHost::with('user')->where('id_owner', auth()->user()->id)->whereNotIn('id_message', $tempReply)->where('approve_at', '!=', null)->orderBy('created_at', 'DESC')->get();
            return view('new-admin.partner.inbox_partner', compact('messageList'));
        }
    }

    public function user_message(Request $request)
    {
        $data = VillaContactHost::with('user')->where('id_message', $request->id_message)->first();
        return response()->json(['data' => $data]);
    }

    public function reply_message(Request $request)
    {
        $data = VillaContactHostReply::create([
            'id_message' => $request->id_message,
            'message' => $request->message,
            'created_by' => $request->id_owner,
            'updated_by' => $request->id_owner
        ]);

        return response()->json(['success' => true, 'message' => 'Successfully Reply the Message', 'data' => $data]);
    }

    public function datatable()
    {
        return VillaContactHost::datatables();
    }

    public function show(Request $request)
    {
        $id = $request->id;
        abort_if(!$id, 500);
        abort_if(auth()->user()->role->name != 'partner', 403);
        $data = VillaContactHost::find($id);
        abort_if(!$data, 404);

        $sendedData = [
            'sender_name' => $data->sender_name,
            'message' => $data->message,
            'is_reply' => $data->is_reply,
            'id_message' => $data->id_message,
            'id_owner' => $data->id_owner,
        ];
        if ($data->is_reply) {
            array_push($sendedData, [
                'message_reply' => $data->conversationReply->message
            ]);
        }

        return response()->json($sendedData);
    }
}
