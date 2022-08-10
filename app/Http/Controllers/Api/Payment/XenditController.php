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
use App\Models\VillaBooking;
use App\Models\VillaCleaningFee;
use App\Models\VillaDetailPrice;
use App\Models\VillaExtraBed;
use App\Models\VillaExtraGuest;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Crypt;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Services\CurrencyConversionService as CurrencyConversion;
use App\Models\VillaAvailability;

class XenditController extends Controller
{
    private $token = 'xnd_development_ev0koCvH7zPR6z1uX8T7DbHmaqaNPSoQV2DTGBzWFFNe6YNEgoVIK6eLt64GVzc';
    private $xenditCallbackToken = 'MAfggTCtsF26SjeyQsZfJHQ1brZv1fyOYfMDhSZhhG0CNPrz';

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
        // dd($request->all());
        //get id villa
        $id_villa = $request->id_villa;
        $villa = Villa::select('price', 'adult', 'children', 'min_stay')->where('id_villa', $id_villa)->where('status', 1)->first();

        // check if date availability is valid
        $isUnavailable = $this->checkDateIsUnavailable($request, $id_villa);
        if($isUnavailable){
            abort(500);
        }

        // check if min stay is valid
        $stayCountMoreThanMinStay = $this->checkStayCountMoreThanMinStay($request, $villa);
        if($stayCountMoreThanMinStay){
            abort(500);
        }

        // abort if villa not found
        abort_if(!$villa, 404);

        //get check_in, check_out, night
        $check_in = $request->check_in;
        $check_out = $request->check_out;

        //get adult child
        if($request->adult == null || $request->adult == 0)
        {
            $adult = 1;
        }else{
            $adult = $request->adult;
        }
        if($request->children == null || $request->children == 0)
        {
            $child = 0;
        }else{
            $child = $request->children;
        }

        //price villa
        $price = $this->count($id_villa, $villa, $check_in, $check_out);

        Xendit::setApiKey($this->token);

        if(auth()->check())
        {
            $user = auth()->user();
            $name = $user->first_name." ".$user->last_name;
        }else{
            $name = $request->firstname." ".$request->lastname;
        }

        $external_id = 'va-'.time();

        $params = [
            "external_id" => $external_id,
            "bank_code" => $request->bank_option,
            "name" => $name,
            "expected_amount" => (int)$price,
            "is_closed" => true,
            "expiration_date" => Carbon::now()->addDays(1)->toISOString(),
            "is_single_use" => true,
        ];

        $createVA = \Xendit\VirtualAccounts::create($params);

        // dd($request->all());

        if(auth()->check())
        {
            $user_id = auth()->user()->id;
            $email = auth()->user()->email;
        }else{
            $user_id = NULL;
            $email = $request->email;
        }

        // dd($user, $email);

        // save data payment
        $storePayment = Payment::create([
            'external_id' => $createVA['external_id'],
            'id_user' => $user_id,
            'payment_channel' => 'Virtual Account',
            'bank' => $createVA['bank_code'],
            'name' => $createVA['name'],
            'email' => $email,
            'va_number' => $createVA['account_number'],
            'price' => $createVA['expected_amount'],
        ]);

        // save data booking
        if($storePayment){
            $storeBooking = $this->storeUsersBooking($request, 'virtual_account', $storePayment);
        } else {
            abort(500);
        }

        if($storeBooking){
            return 'success';
        } else {
            abort(500);
        }

        // return redirect()->route('api.invoiceVa');
    }

    public function callbackVa(Request $request)
    {
        try {
            // decode json callback
            $requestEncoded = $request->json()->all();

            // verify callback the callback come from xendit or not
            $callbackToken = $request->header('x-callback-token');
            if(!$callbackToken || $callbackToken != $this->xenditCallbackToken){
                abort(403);
            }

            // proceed data if verified
            $external_id = $requestEncoded["external_id"];
            $payment = Payment::where('external_id', '=',$external_id)
                ->where('bank', '=',$requestEncoded["bank_code"])
                ->where('price', '=',$requestEncoded["amount"])
                ->first();
            if($payment)
            {
                $update = Payment::where('external_id', $external_id)->update([
                    'status' => 1
                ]);
                if($update > 0)
                {
                    return response()->json([
                        'message' => 'success'
                    ], 200);
                }
            }else{
                return response()->json([
                    'message' => 'data not found'
                ], 404);
            }
        } catch (\Throwable $e) {
            abort(500);
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
    public function createCreditCard(Request $request)
    {
        try {
            //get id villa
            $id_villa = $request["formData"]["id_villa"];
            $villa = Villa::select('price', 'adult', 'children', 'min_stay')->where('id_villa', $id_villa)->where('status', 1)->first();

            // check if date availability is valid
            $isUnavailable = $this->checkDateIsUnavailable($request, $id_villa);
            if($isUnavailable){
                abort(500);
            }

            // check if min stay is valid
            $stayCountMoreThanMinStay = $this->checkStayCountMoreThanMinStay($request, $villa);
            if($stayCountMoreThanMinStay){
                abort(500);
            }

            // return 'hit continue';

            // set xendit token
            Xendit::setApiKey($this->token);
            // process charge
            $params = [
                'token_id' => $request['dataresult']['id'],
                'external_id' => 'card_' . time(),
                'authentication_id' => $request['dataresult']['authentication_id'],
                'amount' => $request['datarequest']['amount'],
                'card_cvn' => $request['datarequest']['card_cvn'],
                'capture' => false
            ];
            return $request->all();
            $createCharge = \Xendit\Cards::create($params);

            // check if amount is valid
            // if valid, capture charge for the credit card
            // if not, reverse authorization/cancel payment for the credit card
            if(false){
                // capture charge for the credit card
                $id = $createCharge['id'];
                $captureCharge = \Xendit\Cards::capture($id, $params);
                return $captureCharge;
                // save data payment
                if($captureCharge){
                    $storePayment = $this->storeUsersPayment($request, 'credit_card', $captureCharge);
                } else {
                    abort(500);
                }

                // save data booking
                if($storePayment){
                    $storeBooking = $this->storeUsersBooking($request, 'credit_card', $storePayment);
                } else {
                    abort(500);
                }

                return response()->json((object)[
                    'message' => 'success',
                    'storePayment' => $storePayment,
                    'storeBooking' => $storeBooking

                ], 200);
            } else {
                // reverse authorization/cancel payment for the credit card
                $id = $createCharge['id'];
                $paramsReverseAuth = ['external_id' => 'reverse_authorization_'.time()];
                $reverseAuth = \Xendit\Cards::reverseAuthorization($id, $paramsReverseAuth);
                // return response()->json((object)[
                //     'message' => 'total amount not equal'
                // ], 500);
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }
    public function creditcard(Request $request)
    {
        dd($request->all());
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
    private function count($id_villa, $villa, $check_in, $check_out)
    {
        $special = VillaDetailPrice::where('id_villa', $id_villa)->get();
        $tax_setting = TaxSetting::select('total_tax')->first();
        $tax = $tax_setting->total_tax;
        $cleaning = VillaCleaningFee::where('id_villa', $id_villa)->get();
        $extra_guest = VillaExtraGuest::where('id_villa', $id_villa)->get();
        $extra_bed = VillaExtraBed::where('id_villa', $id_villa)->get();

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

    private function storeUsersBooking($request, $paymentMethod, $paymentDetail)
    {
        // set invoice number
        $companyCode = "EZV";
        $dateSection = date('ym');
        $invoice = VillaBooking::latest()->first();
        if($invoice){
            $lastYearCode = substr($invoice->no_invoice,4,2);
            $isInSameYear = ($lastYearCode == date('y'));
            $lastNumberCode = substr($invoice->no_invoice,9);
            if($isInSameYear){
                $numberSection = $lastNumberCode+1;
                if($numberSection < 10){
                    $numberSection = '00'.$numberSection;
                } else if($numberSection < 100){
                    $numberSection = '0'.$numberSection;
                };
                // dd('code when it is in the same year', $numberSection);
            } else {
                $numberSection = 1;
                $numberSection = '00'.$numberSection;
                // dd('code when it is not in the same year', $numberSection);
            }
        } else {
            $numberSection = 1;
            $numberSection = '00'.$numberSection;
            // dd('code when there is not invoice yet', $numberSection);
        }
        $invoice_code = $companyCode.'-'.$dateSection.'-'.$numberSection;

        // find villa
        $id_villa = $request->id_villa ?? null;
        $villa = Villa::where('id_villa', $id_villa)->where('status', 1)->first();
        if(!$villa){
            return false;
        }

        // set date check in check out & stay duration
        $check_in = null;
        $check_out = null;
        if($paymentMethod == 'virtual_account'){
            $check_in = $request->check_in;
            $check_out = $request->check_out;
        } else if($paymentMethod == 'credit_card'){
            $check_in = $request->check_in;
            $check_out = $request->check_out;
        } else {
            return false;
        }
        $stay = date_diff(date_create($check_out), date_create($check_in));

        // get price detail
        $detailPrice = $this->getPriceDetail(
            (object)[
                'check_in'=>$check_in,
                'check_out'=>$check_out,
            ],
            $id_villa
        );

        // save booking
        if($paymentMethod == 'virtual_account'){
            // store booking
            $data = [
                'id_payment' => $paymentDetail->id_payment,
                'no_invoice' =>$invoice_code,
                'firstname' => auth()->user()->first_name ?? $request->firstname,
                'lastname' => auth()->user()->last_name ?? $request->lastname,
                'email' => auth()->user()->email ?? $request->email,
                'phone' => null,
                'id_villa' => $id_villa,
                'adult' => $request->adult,
                'children' => $request->children,
                'infant' => $request->infant,
                'pet' => $request->pet,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'id_extra' => null,
                'number_extra' => null,
                'type_extra' => null,
                'price_extra' => null,
                'villa_price' => $detailPrice->normal_price,
                'total_price' => $detailPrice->total,
                'service_price' => $detailPrice->service,
                'cleaning_fee_price' => $detailPrice->cleaning_fee,
                'discount_price' => $detailPrice->discount,
                'total_all_price' => $detailPrice->total_all,
                'status' =>  0,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id ?? null,
                'updated_by' => Auth::user()->id ?? null,
            ];
            $storeBooking = villabooking::create($data);
            // // send email
            $details = [
                'no_invoice' => $storeBooking->no_invoice,
                'name' => $storeBooking->firstname . ", " . $storeBooking->lastname,
                'email' => $storeBooking->email,
                'phone' => $storeBooking->phone,
                'villa_name' => $villa->name,
                'villa_photo' => $villa->image ?? null,
                'villa_price' => $storeBooking->villa_price,
                'total_price' => $storeBooking->total_price,
                'service_price' => $storeBooking->service_price,
                'cleaning_fee_price' => $storeBooking->cleaning_fee_price,
                'discount_price' => $storeBooking->discount_price,
                'total_all_price' => $storeBooking->total_all_price,
                'stay' => $stay->d,
                'check_in' => $storeBooking->check_in,
                'check_out' => $storeBooking->check_out,
                'adult' => $storeBooking->adult,
                'children' => $storeBooking->children,
                'status' => $storeBooking->status
            ];

            // Mail::to($storeBooking->email)->send(new \App\Mail\MyTestMail($details));
            // Mail::to($villa->email)->send(new \App\Mail\BlockDateToVilla($details));
            return $storeBooking;
        } else if($paymentMethod == 'credit_card'){
            // store booking
            $data = [
                'id_payment' => $paymentDetail->id_payment,
                'no_invoice' =>$invoice_code,
                'firstname' => auth()->user()->first_name ?? $request->firstname ?? NULL,
                'lastname' => auth()->user()->last_name ?? $request->lastname ?? NULL,
                'email' => auth()->user()->email ?? $request->email ?? NULL,
                'phone' => NULL,
                'id_villa' => $id_villa,
                'adult' => $request->adult,
                'children' => $request->children,
                'infant' => $request->infant,
                'pet' => $request->pet,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'id_extra' => NULL,
                'number_extra' => NULL,
                'type_extra' => NULL,
                'price_extra' => NULL,
                'villa_price' => $detailPrice->normal_price,
                'total_price' => $detailPrice->total,
                'service_price' => $detailPrice->service,
                'cleaning_fee_price' => $detailPrice->cleaning_fee,
                'discount_price' => $detailPrice->discount,
                'total_all_price' => $detailPrice->total_all,
                'status' =>  1,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id ?? NULL,
                'updated_by' => Auth::user()->id ?? NULL,
            ];
            $storeBooking = villabooking::create($data);
            // // send email
            $details = [
                'no_invoice' => $storeBooking->no_invoice,
                'name' => $storeBooking->firstname . ", " . $storeBooking->lastname,
                'email' => $storeBooking->email,
                'phone' => $storeBooking->phone,
                'villa_name' => $villa->name,
                'villa_photo' => $villa->image ?? null,
                'villa_price' => $storeBooking->villa_price,
                'total_price' => $storeBooking->total_price,
                'service_price' => $storeBooking->service_price,
                'cleaning_fee_price' => $storeBooking->cleaning_fee_price,
                'discount_price' => $storeBooking->discount_price,
                'total_all_price' => $storeBooking->total_all_price,
                'stay' => $stay->d,
                'check_in' => $storeBooking->check_in,
                'check_out' => $storeBooking->check_out,
                'adult' => $storeBooking->adult,
                'children' => $storeBooking->children,
                'status' => $storeBooking->status
            ];

            // Mail::to($storeBooking->email)->send(new \App\Mail\MyTestMail($details));
            // Mail::to($villa->email)->send(new \App\Mail\BlockDateToVilla($details));
            return $storeBooking;
        }
    }

    private function storeUsersPayment($request, $paymentMethod, $paymentGatewayDetail)
    {
        // check if user authenticated
        if(auth()->check())
        {
            $user_id = auth()->user()->id;
            $email = auth()->user()->email;
        }else{
            $user_id = NULL;
            $email = $request->email ?? NULL;
        }

        // store payment process
        $storePayment = false;
        if($paymentMethod == 'virtual_account'){
            //
            $storePayment = true;
        } else if($paymentMethod == 'credit_card'){
            $storePayment = Payment::create([
                'external_id' => $paymentGatewayDetail['external_id'],
                'id_user' => $user_id ?? NULL,
                'payment_channel' => 'Credit Card',
                'bank' => NULL,
                'name' => NULL,
                'email' => $email ?? NULL,
                'cc_number' => $paymentGatewayDetail['masked_card_number'],
                'price' => $paymentGatewayDetail['authorized_amount'],
            ]);
        }
        return $storePayment;
    }

    private function getPriceDetail($date, $id_villa)
    {
        $start = $date->check_in;
        $end = $date->check_out;
        $id = $id_villa;

        // $end_count = date('Y-m-d', strtotime($end .' -1 day'));
        $regular = Villa::select('price', 'adult', 'children')->where('id_villa', $id)->get();
        $special = VillaDetailPrice::where('id_villa', $id)->get();
        $tax_setting = TaxSetting::select('total_tax')->first();
        $tax = $tax_setting->total_tax;
        $cleaning = VillaCleaningFee::where('id_villa', $id)->get();
        $extra_guest = VillaExtraGuest::where('id_villa', $id)->get();
        $extra_bed = VillaExtraBed::where('id_villa', $id)->get();

        //get normal price
        $normal_price = $regular[0]->price;

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
        $max_total_guest = $regular[0]->adult + $extra_guest_max;
        $max_total_child = $regular[0]->children;

        //get booking date
        $period_pick = CarbonPeriod::create($start, $end);
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
            $price = $regular[0]->price;

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

        //return data
        // $data = [
        //     'normal_price' => CurrencyConversion::exchangeWithUnit($normal_price),
        //     'total' => CurrencyConversion::exchangeWithUnit($total),
        //     'tax' => CurrencyConversion::exchangeWithUnit(($total * $tax / 100)),
        //     'total_all' => CurrencyConversion::exchangeWithUnit($total_all),
        //     'price' => (int)(round($total_all)),
        //     'discount' => CurrencyConversion::exchangeWithUnit($discounts),
        //     'cleaning_fee' => CurrencyConversion::exchangeWithUnit($cleaning_fee),
        //     'max_total_guest' => $max_total_guest,
        //     'normal_guest' => $regular[0]->adult,
        //     'max_total_children' => $max_total_child,
        // ];
        $data = (object)[
            'normal_price' => (int)$normal_price,
            'total' => (int)$total,
            'service' => (int)($total * $tax / 100),
            'cleaning_fee' => (int)$cleaning_fee,
            'discount' => (int)$discounts,
            'total_all' => (int)$total_all,
        ];

        return $data;
    }

    private function getUnavailableDate($id)
    {
        $blog = VillaBooking::where('id_villa', $id)->get();

        $availability = VillaAvailability::where('id_villa', $id)->get();

        if ($blog->count() > 0)
            foreach ($blog as $item) {
                $period = CarbonPeriod::create($item->check_in, $item->check_out);
                foreach ($period as $date) {
                    $dates[] = $date->format('Y-m-d');
                }
            }
        else {
            $dates[] = Carbon::yesterday()->format('Y-m-d');
        }

        if ($availability->count() > 0)
        {
            foreach ($availability as $item2) {
                $period2 = CarbonPeriod::create($item2->start, $item2->end);
                foreach ($period2 as $date2) {
                    $dates[] = $date2->format('Y-m-d');
                }
            }
        }

        return $dates;
    }

    private function checkDateIsUnavailable($request, $id_villa)
    {
        $unavailableDate = $this->getUnavailableDate($id_villa);
        $isUnavailable = false;

        $check_in = date('Y-m-d', strtotime($request->check_in));
        $check_out = date('Y-m-d', strtotime($request->check_out));
        foreach ($unavailableDate as $item) {
            $date = date('Y-m-d', strtotime($item));
            if(($date >= $check_in) && ($date <= $check_out)){
                $isUnavailable = true;
            }
        }

        return $isUnavailable;
    }

    private function checkStayCountMoreThanMinStay($request, $villa)
    {
        $stay = date_diff(date_create($request->check_out), date_create($request->check_in));
        return !($stay->d < ($villa->min_stay ?? 1));
    }
}
