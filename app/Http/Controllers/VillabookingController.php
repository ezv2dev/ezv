<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\VillaDetailPrice;
use App\Models\VillaBooking;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;
use App\Models\VillaEvents;
use App\Models\VillaAvailability;
use App\Models\TaxSetting;
use App\Services\CurrencyConversionService as CurrencyConversion;
use App\Models\VillaCleaningFee;
use App\Models\VillaExtraBed;
use App\Models\VillaExtraGuest;
use App\Services\IcalReader as ical;

class VillabookingController extends Controller
{
    public function index()
    {
        $this->authorize('bookingvilla_create');
        $villa = Villa::get();
        // return view('admin.villa.booking', compact('villa'));
        return view('new-admin.villa.booking', compact('villa'));
    }

    public function store(Request $request)
    {
        $this->authorize('bookingvilla_create');
        $villa = Villa::where('id_villa', $request->id_villa)->get();
        $stay = date_diff(date_create($request->check_out), date_create($request->check_in));
        $year = Carbon::now()->year;
        //insert into database
        $data = villabooking::insertGetId(array(
            'no_invoice' => 0,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'id_villa' => $request->id_villa,
            'adult' => $request->adult,
            'child' => $request->child,
            'id_extra_price' => 0,
            'number_extra' => 0,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'villa_price' => $villa[0]->price,
            'extra_price' => 0,
            'total_price' => ($villa[0]->price * $stay->d) + 0,
            'status' =>  0,
            'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ));

        // $event = VillaEvents::insert(array(
        //     'id_villa' => $request->id_villa,
        //     'starts' => $request->check_in,
        //     'ends' => $request->check_out,
        //     'status' => 0,
        //     'summary' => "booked",
        //     'uid' => $data,
        //     'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
        //     'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
        // ));

        return redirect()->route('admin_villa_booking_list', $data)
            ->with('success', 'Your data has been submited');
    }

    public function list()
    {
        $this->authorize('bookingvilla_index');
        // return view('admin.villa.booking_list');
        return view('new-admin.villa.booking_list');
    }

    public function datatable()
    {
        $this->authorize('bookingvilla_index');
        return villabooking::datatables();
    }

    public function importCalendar(Request $request, $id)
    {
        // $cal = new CalFileParser;
        $berkas = $request->file('file');
        $ext = $request->file('file')->getClientOriginalName();
        // // $result = $cal->parse($berkas, 'array');

        // $cal->set_file_name($ext);
        // $example4 = $cal->parse();
        // return $example4;
        $ical = new ical($berkas);
        $event = $ical->events();

        $date = [];
        $i = 0;

        foreach ($event as $key => $value) {
            $date[$i]['no'] = $key;
            $date[$i]['start'] = date('Y-m-d', strtotime($value['DTSTART']));
            $date[$i]['end'] = date('Y-m-d', strtotime($value['DTEND']));
            $i++;
        }

        foreach ($date as $key => $value) {
            VillaAvailability::insert([
                'id_villa' => $id,
                'start' => $value['start'],
                'end' => $value['end'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }

        return response()->json([
            'message' => 'Successfully import calendar.'
        ]);
    }

    public function checkCookiesAvailability(Request $request)
    {
        $sCheck_in = $request->start;
        $sCheck_out = $request->end;

        $availability = VillaAvailability::whereBetween('start', [$sCheck_in, $sCheck_out])
            ->orWhereBetween('end', [$sCheck_in, $sCheck_out])
            ->get();

        $villa = $availability->where('id_villa', $request->id);
        return response()->json([
            'data' => $villa,
            'status' => 200,
        ]);
    }

    public function update(Request $request, $id)
    {
        // $status = 500;
        $this->authorize('bookingvilla_update');
        $find = Villabooking::where('id_booking', $id)->first();

        $find->update(array(
            'status' => 1,
            'ip' => request()->ip(),
            'session_id' => request()->getSession()->getId(),
            'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            'updated_by' => Auth::user()->id,
        ));
        if ($find) {
            $status = 200;
        }
        return $status;
    }

    public function delete(Request $request, $id)
    {
        $this->authorize('bookingvilla_delete');
        $find = Villabooking::where('id_booking', $id)->first();
        $find->delete();

        return redirect()->route('admin_villa_booking_list')
            ->with('success', 'Your data has been deleted');
    }

    public function user_store(Request $request)
    {
        $no = "01";
        $invoice = "EZV-0122" . $no;
        $villa = Villa::where('id_villa', $request->id_villa)->get();

        if ($request->method == 1) {
            $stay = date_diff(date_create($request->check_out), date_create($request->check_in));
            $data = villabooking::insertGetId(array(
                'no_invoice' => $invoice,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'id_villa' => $request->id_villa,
                'adult' => $request->adult,
                'child' => $request->child,
                'id_extra_price' => 0,
                'number_extra' => 0,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'villa_price' => $request->villa_price,
                'extra_price' => 0,
                'total_price' => ($request->villa_price * $stay->d),
                'method' => $request->method,
                'status' =>  0,
                'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            // $event = VillaEvents::insert(array(
            //     'id_villa' => $request->id_villa,
            //     'starts' => $request->check_in,
            //     'ends' => $request->check_out,
            //     'status' => 0,
            //     'summary' => "booked",
            //     'uid' => $data,
            //     'created_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            //     'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            // ));

            $details = [
                'no_invoice' => $invoice,
                'name' => $request->lastname . ", " . $request->firstname,
                'email' => $request->email,
                'phone' => $request->phone,
                'villa_name' => $villa[0]->name,
                'villa_photo' => $villa[0]->image,
                'villa_price' => $request->villa_price,
                'stay' => $stay->d,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'adult' => $request->adult,
                'children' => $request->child,
                'total_price' => ($request->villa_price * $stay->d),
            ];

            // \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));

            // \Mail::to($villa[0]->email)->send(new \App\Mail\BlockDateToVilla($details));

            dd("Email sudah terkirim.");
        }
    }


    public function disabled($id)
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

        if ($availability->count() > 0) {
            foreach ($availability as $item2) {
                $period2 = CarbonPeriod::create($item2->start, $item2->end);
                foreach ($period2 as $date2) {
                    $dates[] = $date2->format('Y-m-d');
                }
            }
        }

        return $dates;
    }

    public static function get_disc(array $data){
        $start = $data['start'];
        $end = $data['end'];
        // $end_count = date('Y-m-d', strtotime($end .' -1 day'));
        $regular = Villa::select('price', 'adult', 'children')->where('id_villa', $data['id_villa'])->get();
        $special = VillaDetailPrice::where('id_villa', $data['id_villa'])->get();

        //get normal price
        $normal_price = $regular[0]->price;

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

        $discount = CurrencyConversion::exchangeWithUnit($discounts);
        return $discount;
    }

    public static function get_service(array $data)
    {
        $start = $data['start'];
        $end = $data['end'];
        // $end_count = date('Y-m-d', strtotime($end .' -1 day'));
        $regular = Villa::select('price', 'adult', 'children')->where('id_villa', $data['id_villa'])->get();
        $special = VillaDetailPrice::where('id_villa', $data['id_villa'])->get();
        $tax_setting = TaxSetting::select('total_tax')->first();
        $tax = $tax_setting->total_tax;
        $cleaning = VillaCleaningFee::where('id_villa', $data['id_villa'])->get();
        $extra_guest = VillaExtraGuest::where('id_villa', $data['id_villa'])->get();
        $extra_bed = VillaExtraBed::where('id_villa', $data['id_villa'])->get();

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

        $tax = CurrencyConversion::exchangeWithUnit(($total * $tax / 100));

        return $tax;
    }

    public static function get_total_all(array $data)
    {
        $start = $data['start'];
        $end = $data['end'];
        // $end_count = date('Y-m-d', strtotime($end .' -1 day'));
        $regular = Villa::select('price', 'adult', 'children')->where('id_villa', $data['id_villa'])->get();
        $special = VillaDetailPrice::where('id_villa', $data['id_villa'])->get();
        $tax_setting = TaxSetting::select('total_tax')->first();
        $tax = $tax_setting->total_tax;
        $cleaning = VillaCleaningFee::where('id_villa', $data['id_villa'])->get();
        $extra_guest = VillaExtraGuest::where('id_villa', $data['id_villa'])->get();
        $extra_bed = VillaExtraBed::where('id_villa', $data['id_villa'])->get();

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
        $total_alls = CurrencyConversion::exchangeWithUnit($total_all);

        return $total_alls;
    }

    public function get_total(Request $request, $id)
    {
        $start = $request->start;
        $end = $request->end;
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
        if (count($cleaning) != 0) {
            $cleaning_fee = $cleaning[0]->price;
        } else {
            $cleaning_fee = 0;
        }

        //cek if there is extra bed
        if (count($extra_bed) != 0) {
            $extra_bed_price = $extra_bed[0]->price;
            $extra_bed_max = $extra_bed[0]->max;
        } else {
            $extra_bed_price = 0;
            $extra_bed_max = 0;
        }

        //cek if there is extra guest
        if (count($extra_guest) != 0) {
            $extra_guest_price = $extra_guest[0]->price;
            $extra_guest_max = $extra_guest[0]->max;
        } else {
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
        if (count($special) != 0) {
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
                if (count($discount) != 0) {
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

            if (count($special) != 0) {
                foreach ($date_price as $item) {
                    if ($booking == $item[0]) {
                        $price = $item[1];
                    }
                }

                foreach ($date_discount as $item) {
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
        $data = [
            'normal_price' => CurrencyConversion::exchangeWithUnit($normal_price),
            'total' => CurrencyConversion::exchangeWithUnit($total),
            'tax' => CurrencyConversion::exchangeWithUnit(($total * $tax / 100)),
            'total_all' => CurrencyConversion::exchangeWithUnit($total_all),
            'price' => (int)($total_all),
            'discount' => CurrencyConversion::exchangeWithUnit($discounts),
            'cleaning_fee' => CurrencyConversion::exchangeWithUnit($cleaning_fee),
            'max_total_guest' => $max_total_guest,
            'normal_guest' => $regular[0]->adult,
            'max_total_children' => $max_total_child,
        ];

        return $data;
    }

    public function confirm(Request $request)
    {
        // dd($request->all(), request()->adult);
        $id = $request->id_villa;
        $villa = Villa::where('id_villa', $id)->where('status', 1)->first();

        // abort if villa not found
        abort_if(!$villa, 404);

        //get number of night
        $startTimeStamp = strtotime($request->check_in);
        $endTimeStamp = strtotime($request->check_out);
        $timeDiff = abs($endTimeStamp - $startTimeStamp);
        $numberDays = $timeDiff / 86400;
        $night = intval($numberDays);

        //total
        $total = $night * $villa->price;

        $data = $request;
        // dd($data, $villa, $night, $total);

        return view('user.confirm-booking', compact('data', 'villa', 'night', 'total'));
    }
}
