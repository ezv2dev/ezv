<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CoHost;
use App\Models\CoHostPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoHostController extends Controller
{
    public function index()
    {
        return view('new-admin.cohost.index');
    }

    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $id_cohost = User::select('id')->where('email', $request->email_cohost)->first();

        if(!$id_cohost)
        {
            return response()->json(
                [
                    'message' => 'data not found'
                ],
                500
            );
        }else{
            $cohost = CoHost::create([
                'id_host' => $id,
                'id_co_host' => $id_cohost->id,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);

            if($request->listing == "on")
            {
                $listing = 'yes';
            }else{
                $listing = 'no';
            }

            if($request->reservation == "on")
            {
                $reservation = 'yes';
            }else{
                $reservation = 'no';
            }

            if($request->calendar == "on")
            {
                $calendar = 'yes';
            }else{
                $calendar = 'no';
            }

            if($request->statistic == "on")
            {
                $statistic = 'yes';
            }else{
                $statistic = 'no';
            }

            if($request->finance == "on")
            {
                $finance = 'yes';
            }else{
                $finance = 'no';
            }

            if($request->inbox == "on")
            {
                $inbox = 'yes';
            }else{
                $inbox = 'no';
            }

            if($request->collaboration == "on")
            {
                $collaboration = 'yes';
            }else{
                $collaboration = 'no';
            }

            $permission = CoHostPermission::create([
                'id_detail' => $cohost->id_detail,
                'listing' => $listing,
                'reservation' => $reservation,
                'calendar' => $calendar,
                'statistic' => $statistic,
                'finance' => $finance,
                'inbox' => $inbox,
                'collaboration' => $collaboration,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);

            if($cohost->id_detail && $permission)
            {
                return response()->json(
                    [
                        'message' => 'data added'
                    ],
                    200
                );
            }else{
                return response()->json(
                    [
                        'message' => 'internal server eror'
                    ],
                    500
                );
            }
        }
    }
}
