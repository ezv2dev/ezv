<?php

namespace App\Http\Controllers\Activity;

use App\Models\ActivityDetailReview;
use App\Models\ActivityReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ActivityReviewController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->all());
        $this->authorize('review_create');

        // check if editor not authenticated
        abort_if(!auth()->check(), 500);

        // validation
        $validator = Validator::make($request->all(), [
            'id_activity' => ['required', 'integer'],
            'experience' => ['required', 'numeric'],
            'comment' => ['string']
        ]);

        if ($validator->fails()) {
            abort(500);
        }

        // find if logged user already give review
        $review = ActivityReview::where('id_activity', $request->id_activity)->where('created_by', auth()->user()->id)->first();
        if ($review) {
            // return back()->with('success', 'Your data has been updated');
            abort(500);
        }

        // find activity details
        // if exist update detail review
        // otherwise create detail review
        $detailReview = ActivityDetailReview::where('id_activity', $request->id_activity)->first();
        if ($detailReview) {
            $average_experience = (($detailReview->average_experience * $detailReview->count_person) + $request->experience) / ($detailReview->count_person + 1);

            $detailReview->update([
                'average_experience' => $average_experience,
                'average' => ($average_experience) / 1,
                'count_person' => $detailReview->count_person + 1,
                'updated_at' => gmdate("Y-m-d H:i:s", time() + 60 * 60 * 8),
            ]);
        } else {
            // dd($request->all());
            ActivityDetailReview::create([
                'average_experience' => $request->experience,
                'average' => ($request->experience) / 1,
                'id_activity' => $request->id_activity,
                'count_person' => 1,
            ]);
        }

        $createdReview = ActivityReview::create([
            'experience' => $request->experience,
            'comment' => $request->comment,
            'id_activity' => $request->id_activity,
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
            'id_activity' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            abort(500);
        }

        $review = ActivityReview::find($request->id_review);

        // if review not found, abort 404
        if (!$review) {
            abort(404);
        }

        $detailReview = ActivityDetailReview::where('id_activity', $request->id_activity)->first();

        // if detailReview not found, abort 404
        if (!$detailReview) {
            abort(404);
        }

        // check if review about activity is 1,
        // if empty, remove detail review activity
        $reviews = ActivityReview::where('id_activity', $request->id_activity)->get();
        if ($reviews->count() == 1) {
            $deletedReview = $review->delete();
            ActivityDetailReview::where('id_activity', $request->id_activity)->first()->delete();
        } else {
            // recalculate detail review
            $average_experience = (($detailReview->average_experience * $detailReview->count_person) - $review->experience) / ($detailReview->count_person - 1);

            $detailReview->update([
                'average_experience' => $average_experience,
                'average' => ($average_experience) / 1,
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
