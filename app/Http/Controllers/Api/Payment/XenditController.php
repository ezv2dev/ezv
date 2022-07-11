<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Xendit\Xendit;
use Carbon\Carbon;
Use App\Models\Payment;
use App\Models\User;
use App\Models\Villa;
use Illuminate\Support\Facades\Crypt;
use DateTime;

class XenditController extends Controller
{
    // public function invoice($params1, $createVa1)
    // {
    //     $params = $params1;
    //     $createVa = $createVa1;
    //     return view('user.confirm', compact('params', 'createVA'));
    // }
    private $token = 'xnd_development_ev0koCvH7zPR6z1uX8T7DbHmaqaNPSoQV2DTGBzWFFNe6YNEgoVIK6eLt64GVzc';

    //virtual account

    public function getlistVa()
    {
        Xendit::setApiKey($this->token);

        $getVaBanks = \Xendit\VirtualAccounts::getVABanks();

        return response()->json([
            'data' => $getVaBanks
        ])->setStatusCode(200);
    }

    public function createVa(Request $request)
    {
        //get id villa
        $decrypt_id = Crypt::decryptString($request->price_total);
        $villa = Villa::select('price')->where('id_villa', $decrypt_id)->first();

        //get check_in, check_out, night
        $check_in = $request->check_in_date;
        $check_out = $request->check_out_date;
        $datetime1 = new DateTime($check_in);
        $datetime2 = new DateTime($check_out);
        $interval = $datetime1->diff($datetime2);
        $night = $interval->format('%a');

        //get adult child
        if($request->adult_va == null || $request->adult_va == 0)
        {
            $adult = 1;
        }else{
            $adult = $request->adult_va;
        }
        if($request->child_va == null || $request->child_va == 0)
        {
            $child = 0;
        }else{
            $child = $request->child_va;
        }

        //price villa
        $price =


        dd($request->all());
        Xendit::setApiKey($this->token);

        $user = User::where('id', $request->user)->first();

        $external_id = 'va-'.time();

        $params = [
            "external_id" => $external_id,
            "bank_code" => $request->bank_option,
            "name" => $user->first_name." ".$user->last_name,
            "expected_amount" => $request->price_total,
            "is_closed" => true,
            "expiration_date" => Carbon::now()->addDays(1)->toISOString(),
            "is_single_use" => true,
        ];

        dd($params);

        $createVA = \Xendit\VirtualAccounts::create($params);

        $insert = Payment::insert([
            'external_id' => $external_id,
            'id_user' => $request->user,
            'payment_channel' => 'Virtual Account',
            'name' => $user->first_name." ".$user->last_name,
            'email' => $user->email,
            'price' => $request->price_total,
        ]);

        // $this->detail($createVA);

        // return view('user.confirm', compact('params', 'createVA'));
    }

    public function detail($createVA)
    {
        dd($createVA);
        // $data = Payment::where('external_id', $id)->first();
        // dd($data);
    }

    public function callbackVa(Request $request)
    {
        $external_id = $request->external_id;
        $status = $request->status;
        $payment = Payment::where('external_id', $external_id)->exists();
        if($payment)
        {
            if($status == "ACTIVE"){
                $update = Payment::where('external_id', $external_id)->update([
                    'status' => 1
                ]);
                if($update > 0)
                {
                    return 'your payment complete';
                }
                return 'false';
            }
        }else{
            return response()->json([
                'message' => 'Data Tidak Ditemukan'
            ]);
        }
    }

    //end virtual account

    //payment channel
    public function getlistchannel()
    {
        Xendit::setApiKey($this->token);
        $getPaymentChannels = \Xendit\PaymentChannels::list();
        return response()->json([
            'data' => $getPaymentChannels
        ])->setStatusCode(200);
    }
    //end payment channel

    //payment credit card
    public function creditcard(Request $request)
    {
        Xendit::setApiKey($this->token);

        $params = [
            'token_id' => $request['dataresult']['id'],
            'external_id' => 'card_' . time(),
            'authentication_id' => $request['dataresult']['authentication_id'],
            'amount' => $request['datarequest']['amount'],
            'card_cvn' => $request['datarequest']['card_cvn'],
            'capture' => false
        ];

        $captureParams = ['amount' => $params['amount']];

        $refundParams = [
            'external_id' => $params['external_id'],
            'amount' => 20 / 100 * $params['amount']
        ];

        $createCharge = \Xendit\Cards::create($params);

        $id = $createCharge['id'];

        $captureCharge = \Xendit\Cards::capture($id, $params);

        $getCharge = \Xendit\Cards::retrieve($id);

        // $captureCharge = \Xendit\Cards::capture($id, $captureParams);

        // $getCharge = \Xendit\Cards::retrieve($id);
        dd($getCharge);
    }
    //end credit card

}
