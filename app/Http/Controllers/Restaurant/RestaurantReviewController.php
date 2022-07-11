<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\RestaurantDetailReview;
use App\Models\RestaurantReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantReviewController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->all());
        $this->authorize('review_create');

        // check if editor not authenticated
        abort_if(!auth()->check(), 500);

        // validation
        $validator = Validator::make($request->all(), [
            'id_restaurant' => ['required', 'integer'],
            'food' => ['required', 'numeric'],
            'service' => ['required', 'numeric'],
            'value' => ['required', 'numeric'],
            'atmosphere' => ['required', 'numeric'],
            'comment' => ['string']
        ]);

        if ($validator->fails()) {
            abort(500);
        }

        // find if logged user already give review
        $review = RestaurantReview::where('id_restaurant', $request->id_restaurant)->where('created_by', auth()->user()->id)->first();
        if ($review) {
            // return back()->with('success', 'Your data has been updated');
            abort(500);
        }

        // find restaurant details
        // if exist update detail review
        // otherwise create detail review
        $detailReview = RestaurantDetailReview::where('id_restaurant', $request->id_restaurant)->first();
        if ($detailReview) {
            $average_food = (($detailReview->average_food * $detailReview->count_person) + $request->food) / ($detailReview->count_person + 1);
            $average_service = (($detailReview->average_service * $detailReview->count_person) + $request->service) / ($detailReview->count_person + 1);
            $average_value = (($detailReview->average_value * $detailReview->count_person) + $request->value) / ($detailReview->count_person + 1);
            $average_atmosphere = (($detailReview->average_atmosphere * $detailReview->count_person) + $request->atmosphere) / ($detailReview->count_person + 1);

            $detailReview->update([
                'average_food' => $average_food,
                'average_service' => $average_service,
                'average_value' => $average_value,
                'average_atmosphere' => $average_atmosphere,
                'average' => ($average_food + $average_service + $average_value + $average_atmosphere) / 4,
                'count_person' => $detailReview->count_person + 1,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ]);
        } else {
            // dd($request->all());
            RestaurantDetailReview::create([
                'average_food' => $request->food,
                'average_service' => $request->service,
                'average_value' => $request->value,
                'average_atmosphere' => $request->atmosphere,
                'average' => ($request->food + $request->service + $request->value + $request->atmosphere) / 4,
                'id_restaurant' => $request->id_restaurant,
                'count_person' => 1,
            ]);
        }

        $createdReview = RestaurantReview::create([
            'food' => $request->food,
            'service' => $request->service,
            'value' => $request->value,
            'atmosphere' => $request->atmosphere,
            'comment' => $request->comment,
            'id_restaurant' => $request->id_restaurant,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        if ($createdReview) {
            return back()->with('success', 'Your data has been created');
        } else {
            return back()->with('error', 'Please check the form below for errors');
        }
    }

    public function destroy(Request $request)
    {
        $this->authorize('review_delete');

        // check if editor not authenticated
        abort_if(!auth()->check(), 500);

        // validation
        $validator = Validator::make($request->all(), [
            'id_review' => ['required', 'integer'],
            'id_restaurant' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            abort(500);
        }

        $review = RestaurantReview::find($request->id_review);

        // if review not found, abort 404
        if (!$review) {
            abort(404);
        }

        $detailReview = RestaurantDetailReview::where('id_restaurant', $request->id_restaurant)->first();

        // if detailReview not found, abort 404
        if (!$detailReview) {
            abort(404);
        }

        // check if review about restaurant is 1,
        // if empty, remove detail review restaurant
        $reviews = RestaurantReview::where('id_restaurant', $request->id_restaurant)->get();
        if ($reviews->count() == 1) {
            $deletedReview = $review->delete();
            RestaurantDetailReview::where('id_restaurant', $request->id_restaurant)->first()->delete();
        } else {
            // recalculate detail review
            $average_food = (($detailReview->average_food * $detailReview->count_person) - $review->food) / ($detailReview->count_person - 1);
            $average_service = (($detailReview->average_service * $detailReview->count_person) - $review->service) / ($detailReview->count_person - 1);
            $average_value = (($detailReview->average_value * $detailReview->count_person) - $review->value) / ($detailReview->count_person - 1);
            $average_atmosphere = (($detailReview->average_atmosphere * $detailReview->count_person) - $review->atmosphere) / ($detailReview->count_person - 1);

            $detailReview->update([
                'average_food' => $average_food,
                'average_service' => $average_service,
                'average_value' => $average_value,
                'average_atmosphere' => $average_atmosphere,
                'average' => ($average_food + $average_service + $average_value + $average_atmosphere) / 4,
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
