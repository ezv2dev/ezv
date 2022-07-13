<?php

namespace App\Http\Controllers\Hotel;

use App\Models\HotelDetailReview;
use App\Models\HotelReview;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class HotelReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'id_hotel' => ['required', 'integer'],
            'cleanliness' => ['required', 'numeric'],
            'service' => ['required', 'numeric'],
            'check_in' => ['required', 'numeric'],
            'location' => ['required', 'numeric'],
            'value' => ['required', 'numeric'],
            'comment' => ['string']
        ]);

        $review = HotelReview::where('id_hotel', $request->id_hotel)->where('created_by', auth()->user()->id)->first();
        if ($review) {
            abort(500);
        }

        $detailReview = HotelDetailReview::where('id_hotel', $request->id_hotel)->first();

        if ($detailReview) {
            $average_clean = (($detailReview->average_clean * $detailReview->count_person) + $request->cleanliness) / ($detailReview->count_person + 1);
            $average_service = (($detailReview->average_service * $detailReview->count_person) + $request->service) / ($detailReview->count_person + 1);
            $average_check_in = (($detailReview->average_check_in * $detailReview->count_person) + $request->check_in) / ($detailReview->count_person + 1);
            $average_location = (($detailReview->average_location * $detailReview->count_person) + $request->location) / ($detailReview->count_person + 1);
            $average_value = (($detailReview->average_value * $detailReview->count_person) + $request->value) / ($detailReview->count_person + 1);

            $detailReview->update([
                'average_clean' => $average_clean,
                'average_service' => $average_service,
                'average_check_in' => $average_check_in,
                'average_location' => $average_location,
                'average_value' => $average_value,
                'average' => ($average_clean + $average_service + $average_check_in + $average_location + $average_value) / 5,
                'count_person' => $detailReview->count_person + 1,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ]);
        } else {
            HotelDetailReview::create([
                'average_clean' => $request->cleanliness,
                'average_service' => $request->service,
                'average_check_in' => $request->check_in,
                'average_location' => $request->location,
                'average_value' => $request->value,
                'average' => ($request->cleanliness + $request->service + $request->check_in + $request->location + $request->value) / 5,
                'id_hotel' => $request->id_hotel,
                'count_person' => 1,
            ]);
        }

        $createdReview = HotelReview::create([
            'cleanliness' => $request->cleanliness,
            'service' => $request->service,
            'check_in' => $request->check_in,
            'location' => $request->location,
            'value' => $request->value,
            'comment' => $request->comment,
            'id_hotel' => $request->id_hotel,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        if ($createdReview) {
            return back()->with('success', 'Your data has been created');
        } else {
            return back()->with('error', 'Please check the form below for errors');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Request $request)
    {
        // dd($request->all());
        // validation
        // $validator = Validator::make($request->all(), [
        //     'id_review' => ['required', 'integer'],
        //     'id_hotel' => ['required', 'integer']
        // ]);

        // if ($validator->fails()) {
        //     abort(500);
        // }

        $review = HotelReview::find($request->id_review);

        // if review not found, abort 404
        if (!$review) {
            abort(404);
        }

        $detailReview = HotelDetailReview::where('id_hotel', $request->id_hotel)->first();

        // if detailReview not found, abort 404
        if (!$detailReview) {
            abort(404);
        }

        // check if review about restaurant is 1,
        // if empty, remove detail review restaurant
        $reviews = HotelReview::where('id_hotel', $request->id_hotel)->get();
        if ($reviews->count() == 1) {
            $deletedReview = $review->delete();
            HotelDetailReview::where('id_hotel', $request->id_hotel)->first()->delete();
        } else {
            // recalculate detail review
            $average_clean = (($detailReview->average_clean * $detailReview->count_person) - $review->cleanliness) / ($detailReview->count_person - 1);
            $average_service = (($detailReview->average_service * $detailReview->count_person) - $review->service) / ($detailReview->count_person - 1);
            $average_check_in = (($detailReview->average_check_in * $detailReview->count_person) - $review->check_in) / ($detailReview->count_person - 1);
            $average_location = (($detailReview->average_location * $detailReview->count_person) - $review->location) / ($detailReview->count_person - 1);
            $average_value = (($detailReview->average_value * $detailReview->count_person) - $review->value) / ($detailReview->count_person - 1);

            $detailReview->update([
                'average_clean' => $average_clean,
                'average_service' => $average_service,
                'average_check_in' => $average_check_in,
                'average_location' => $average_location,
                'average_value' => $average_value,
                'average' => ($average_clean + $average_service + $average_check_in + $average_value) / 5,
                'count_person' => $detailReview->count_person + 1,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ]);

            // delete review
            $deletedReview = $review->delete();
        }

        if ($deletedReview) {
            return back()->with('success', 'Your data has been deleted');
        } else {
            return back()->with('error', 'Please check the form below for errors');
        }
    }
}
