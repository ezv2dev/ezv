<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use App\Models\VillaContactHost;
use App\Models\VillaContactHostReply;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(auth()->user()->role_id != 3, 403);
        // $allConversationList = VillaContactHost::where('id_owner', auth()->user()->id)
        //     ->where('approve_by', '!=', null)
        //     ->where('disapprove_by', '=', null)
        //     ->orderBy('created_at')->get();
        // $i = 1;
        $messageReply = VillaContactHostReply::select('id_message')->get();
        $tempReply = array();
        foreach ($messageReply as $item) {
            array_push($tempReply, $item->id_message);
        }
        $messageList = VillaContactHost::with('user')->where('id_owner', auth()->user()->id)->whereNotIn('id_message', $tempReply)->orderBy('created_at', 'DESC')->get();
        return view('new-admin.partner.inbox_partner', compact('messageList'));
    }

    public function user_message(Request $request)
    {
        $data = VillaContactHost::with('user')->where('id_message', $request->id_message)->first();
        return response()->json(['data' => $data]);
    }

    public function datatable()
    {
        // $this->authorize('amenities_index');

        return VillaContactHost::PartnerConversations();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
