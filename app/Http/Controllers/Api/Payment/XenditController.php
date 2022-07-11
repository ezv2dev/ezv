<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Xendit\Xendit;
use Carbon\Carbon;
Use App\Models\Payment;
use App\Models\TaxSetting;
use App\Models\User;
use App\Models\Villa;
use App\Models\VillaCleaningFee;
use App\Models\VillaDetailPrice;
use App\Models\VillaExtraBed;
use App\Models\VillaExtraGuest;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Crypt;
use DateTime;
use Illuminate\Support\Facades\Auth;

class XenditController extends Controller
{
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
        $villa = Villa::select('price', 'adult', 'children')->where('id_villa', $decrypt_id)->first();

        //get check_in, check_out, night
        $check_in = $request->check_in_date;
        $check_out = $request->check_out_date;

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
        $price = $this->count($decrypt_id, $villa, $check_in, $check_out);

        Xendit::setApiKey($this->token);

        if(Auth::user())
        {
            $user = User::where('id', $request->user)->first();
            $name = $user->first_name." ".$user->last_name;
        }else{
            $name = $request->firstname_va." ".$request->lastname_va;
        }

        $external_id = 'va-'.time();

        $params = [
            "external_id" => $external_id,
            "bank_code" => $request->bank_option,
            "name" => $name,
            "expected_amount" => $price,
            "is_closed" => true,
            "expiration_date" => Carbon::now()->addDays(1)->toISOString(),
            "is_single_use" => true,
        ];

        $createVA = \Xendit\VirtualAccounts::create($params);

        if(Auth::user())
        {
            $user = $request->user;
            $email = $user->email;
        }else{
            $user = NULL;
            $email = $request->email_va;
        }

        $insert = Payment::insert([
            'external_id' => $createVA['external_id'],
            'id_user' => $user,
            'payment_channel' => 'Virtual Account',
            'bank' => $createVA['bank_code'],
            'name' => $createVA['name'],
            'email' => $email,
            'va_number' => $createVA['account_number'],
            'price' => $createVA['expected_amount'],
        ]);

        return redirect()->route('api.invoiceVa');
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


    //function count price
    private function count($decrypt_id, $villa, $check_in, $check_out)
    {
        $special = VillaDetailPrice::where('id_villa', $decrypt_id)->get();
        $tax_setting = TaxSetting::select('total_tax')->first();
        $tax = $tax_setting->total_tax;
        $cleaning = VillaCleaningFee::where('id_villa', $decrypt_id)->get();
        $extra_guest = VillaExtraGuest::where('id_villa', $decrypt_id)->get();
        $extra_bed = VillaExtraBed::where('id_villa', $decrypt_id)->get();

         //get normal price
         $normal_price = $villa->price;

         //cek if there is  cleaning fee
         if(count($cleaning) != 0)
         {
             $cleaning_fee = $cleaning[0]->price;
         }else{
             $cleaning_fee = 0;
         }

         //cek if there is extra bed
         if(count($extra_bed) != 0)
         {
             $extra_bed_price = $extra_bed[0]->price;
             $extra_bed_max = $extra_bed[0]->max;
         }else{
             $extra_bed_price = 0;
             $extra_bed_max = 0;
         }

         //cek if there is extra guest
         if(count($extra_guest) != 0)
         {
             $extra_guest_price = $extra_guest[0]->price;
             $extra_guest_max = $extra_guest[0]->max;
         }else{
             $extra_guest_price = 0;
             $extra_guest_max = 0;
         }

         //count regular guest + extra guest
         $max_total_guest = $villa->adult + $extra_guest_max;
         $max_total_child = $villa->children;

         //get booking date
         $period_pick = CarbonPeriod::create($check_in, $check_out);
         foreach ($period_pick as $date) {
             $date_pick[] = $date->format('Y-m-d');
         }

         array_pop($date_pick);

         //count
         if (count($special) != 0)
         {
             //get special date
             foreach ($special as $item) {
                 $period_price = CarbonPeriod::create($item->start, $item->end);
                 $special_price = VillaDetailPrice::select('price')->where('start', $item->start)->where('end', $item->end)->get();
                 foreach ($period_price as $date) {
                     $date_price[] = array($date->format('Y-m-d'), $special_price[0]->price);
                 }
             }

             //get discount
             foreach ($special as $item) {
                 $period_price = CarbonPeriod::create($item->start, $item->end);
                 $discount = VillaDetailPrice::select('disc')->where('start', $item->start)->where('end', $item->end)->get();
                 if(count($discount) != 0){
                     foreach ($period_price as $date) {
                         $date_discount[] = array($date->format('Y-m-d'), $discount[0]->disc);
                     }
                 }
             }
         }

         $total = 0;
         $discounts = 0;
         $disc = 0;
         foreach ($date_pick as $booking) {
             $price = $villa->price;

             if (count($special) != 0)
             {
                 foreach ($date_price as $item) {
                     if ($booking == $item[0]) {
                         $price = $item[1];
                     }
                 }

                 foreach ($date_discount as $item)
                 {
                     if ($booking == $item[0]) {
                         $disc = $item[1] / 100 * $price;
                     }
                 }
             }

             $discounts += $disc;
             $total += $price;
             $disc = 0;
             $price = 0;
         }

         //count total all
         $total_all = $total + ($total * $tax / 100) - $discounts + $cleaning_fee;

         return $total_all;
    }
    //endfunction

    //invoice
    public function invoice_va($va)
    {
        $data = Payment::where('va_number', $va)->first();
        return view('user.confirm', compact('data'));
    }
    //endinvoice

}
