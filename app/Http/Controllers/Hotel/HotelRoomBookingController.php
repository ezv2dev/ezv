<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HotelRoomAvailability;
use Auth;
use App\Models\Hotel;
use App\Models\HotelTypeDetail;
use App\Models\HotelRoomDetailPrice;
use App\Models\HotelRoomBooking;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;

class HotelRoomBookingController extends Controller
{
    public function index()
    {
        $this->authorize('bookingvilla_index');
        return view('new-admin.hotel.reservations.reservations_index');
    }

    public function datatableUpcoming()
    {
        $this->authorize('bookingvilla_index');
        return HotelRoomBooking::datatablesUpcoming();
    }

    public function all()
    {
        $this->authorize('bookingvilla_index');
        return view('new-admin.hotel.reservations.reservations_all');
    }

    public function datatableAll()
    {
        $this->authorize('bookingvilla_index');
        return HotelRoomBooking::datatablesAll();
    }

    public function disabled($id)
    {
        $booking = HotelRoomBooking::with('hotel_room')
        ->where('id_hotel_room', $id)
        ->where('status', 1)
        ->get();

        //pecah booking date
        if (count($booking) > 0)
        {
            foreach ($booking as $item)
            {
                $period = CarbonPeriod::create($item->check_in, $item->check_out);
                foreach ($period as $date)
                {
                    $bookingDate[] = $date->format('Y-m-d');

                }
            }

            //check same date and count each date
            $sameDate = array_count_values($bookingDate);

            $i = 0;

            $dates = [];

            foreach ($sameDate as $key => $value)
            {
                //if each date count equals number of room hotel should be disabled date
                if ($value == $booking[0]->hotel_room->number_of_room)
                {
                    $dates[$i] = $key;
                    $i++;
                }
            }
        }

        // dd($sameDate["2022-05-17"]);

        $availability = HotelRoomAvailability::where('id_hotel_room', $id)->get();

        if ($availability->count() > 0)
        {
            foreach ($availability as $item2)
            {
                $dates[] = $item2->date;
            }
        }
        else
        {
            $dates[] = Carbon::yesterday()->format('Y-m-d');
        }

        // dd($dates);

        return $dates;
    }

    public function get_total(Request $request, $id)
    {
        $start = \DateTime::createFromFormat('Y-m-d', $request->start);
        $end = $request->end;
        // $end_count = date('Y-m-d', strtotime($end .' -1 day'));
        $regular = HotelTypeDetail::select('price')->where('id_hotel_room', $id)->get();
        $special = HotelRoomDetailPrice::where('id_hotel_room', $id)->get();

        //get booking date
        $period_pick = CarbonPeriod::create($start, $end);

        foreach ($period_pick as $date) {
            $date_pick[] = $date->format('Y-m-d');
        }

        if (count($special) != 0)
        {
            //get special date
            foreach ($special as $item) {
                $period_price = CarbonPeriod::create($item->start, $item->end);
                $special_price = HotelRoomDetailPrice::select('price')->where('start', $item->start)->where('end', $item->end)->get();
                foreach ($period_price as $date) {
                    $date_price[] = array('date' => $date->format('Y-m-d'), 'special_price' => $special_price[0]->price);
                }
            }
        }

        // dd($date_price);

        //total
        $total = 0;
        foreach ($date_pick as $booking) {
            $price = $regular[0]->price;

            if (count($special) != 0)
            {
                foreach ($date_price as $item) {
                    if ($booking == $item['date']) {
                        $price = $item['special_price'];
                    }
                }
            }

            $total += $price;
        }

        return $total;
    }

    public function confirm(Request $request)
    {
        // dd($request->all());
        if (empty($request))
        {
            return back();
        }

        $id = $request->id_hotel_room;
        $hotel = HotelTypeDetail::with('hotel','hotelType')->where('id_hotel_room', $id)->get();

        // dd($hotel);

        //get number of night
        $startTimeStamp = strtotime($request->check_in);
        $endTimeStamp = strtotime($request->check_out);
        $timeDiff = abs($endTimeStamp - $startTimeStamp);
        $numberDays = $timeDiff / 86400;
        $night = intval($numberDays);

        //total
        $total = $night * $hotel[0]->price;

        $data = $request;

        return view('user.hotel.confirm', compact('data', 'hotel', 'night', 'total'));
    }

    public function booking_store(Request $request)
    {
        $no = "1932723";
        $invoice = "EZV-0122" . $no;
        $hotelRoom = HotelTypeDetail::with('hotel')->where('id_hotel_room', $request->id_hotel_room)->get();

        if ($request->method == 1) {
            $stay = date_diff(date_create($request->check_out), date_create($request->check_in));
            $data = HotelRoomBooking::insertGetId(array(
                'no_invoice' => $invoice,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'id_hotel_room' => $request->id_hotel_room,
                'id_hotel' => $hotelRoom[0]->id_hotel,
                'adult' => $request->adult,
                'child' => $request->child,
                'id_extra_price' => 0,
                'number_extra' => 0,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'price' => $request->hotel_room_price,
                'extra_price' => 0,
                'total_price' => ($request->hotel_room_price * $stay->d),
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

            // $details = [
            //     'no_invoice' => $invoice,
            //     'name' => $request->lastname . ", " . $request->firstname,
            //     'email' => $request->email,
            //     'phone' => $request->phone,
            //     'hotel_name' => $hotelRoom[0]->hotelType->name . "Room " . $hotelRoom[0]->hotel->name,
            //     'hotel_photo' => $hotelRoom[0]->image,
            //     'hotel_price' => $request->hotel_room_price,
            //     'stay' => $stay->d,
            //     'check_in' => $request->check_in,
            //     'check_out' => $request->check_out,
            //     'adult' => $request->adult,
            //     'children' => $request->child,
            //     'total_price' => ($request->hotel_room_price * $stay->d),
            // ];

            // \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));

            // \Mail::to($villa[0]->email)->send(new \App\Mail\BlockDateToVilla($details));

            dd("Email sudah terkirim.");
        }
    }
}
