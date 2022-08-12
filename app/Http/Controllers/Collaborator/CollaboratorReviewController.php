<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use App\Models\ActivityDetailReview;
use App\Models\CollaboratorDetailReview;
use App\Models\CollaboratorReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollaboratorReviewController extends Controller
{
    public function store(Request $request)
    {
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_collab' => ['required', 'integer'],
            'experience' => ['required', 'numeric'],
            'comment' => ['nullable', 'string']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // check if the editor does not have authorization
        // $this->authorize('collaborator_review_store');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin', 'partner'])) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        // find if logged user already give review
        $review = CollaboratorReview::where('id_collab', $request->id_collab)->where('created_by', auth()->user()->id)->first();
        if ($review) {
            return response()->json([
                'message' => 'Data Already Exist',
            ], 500);
        }

        // find activity details
        // if exist update detail review
        // otherwise create detail review
        $detailReview = CollaboratorDetailReview::where('id_collab', $request->id_collab)->first();
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
            CollaboratorDetailReview::create([
                'average_experience' => $request->experience,
                'average' => ($request->experience) / 1,
                'id_collab' => $request->id_collab,
                'count_person' => 1,
            ]);
        }

        $createdReview = CollaboratorReview::create([
            'experience' => $request->experience,
            'comment' => $request->comment,
            'id_collab' => $request->id_collab,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        $reviews = $createdReview;
        $detailReview = CollaboratorDetailReview::where('id_collab', $request->id_collab)->first();

        if ($createdReview) {
            return response()->json([
                'message' => 'Successfully Create Review',
                'data' => (object)[
                    'reviews' => $reviews,
                    'detailReview' => $detailReview,
                ],
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Create Review',
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        // check if editor not authenticated
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Error, Please Login !'
            ], 401);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'id_review' => ['required', 'integer'],
            'id_collab' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'something error',
                'errors' => $validator->errors()->all(),
            ], 500);
        }

        // check if the editor does not have authorization
        // $this->authorize('collaborator_review_store');
        if (!in_array(auth()->user()->role->name, ['admin', 'superadmin', 'partner'])) {
            return response()->json([
                'message' => 'This action is unauthorized',
            ], 403);
        }

        $review = CollaboratorReview::find($request->id_review);
        // if review not found, abort 404
        if (!$review) {
            return response()->json([
                'message' => 'Data Not Found',
            ], 404);
        }

        $detailReview = CollaboratorDetailReview::where('id_collab', $request->id_collab)->first();

        // if detailReview not found, abort 404
        if (!$detailReview) {
            return response()->json([
                'message' => 'Data Not Found',
            ], 404);
        }

        // check if review about activity is 1,
        // if empty, remove detail review activity
        $reviews = CollaboratorReview::where('id_collab', $request->id_collab)->get();
        if ($reviews->count() == 1) {
            $deletedReview = $review->delete();
            CollaboratorDetailReview::where('id_collab', $request->id_collab)->first()->delete();
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

        $reviews = CollaboratorReview::where('id_collab', $request->id_collab)->get();
        $detailReview = CollaboratorDetailReview::where('id_collab', $request->id_collab)->first();

        if ($deletedReview) {
            return response()->json([
                'message' => 'Successfully Delete Review',
                'data' => (object)[
                    'reviews' => $reviews,
                    'detailReview' => $detailReview,
                ],
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error Delete Review',
            ], 500);
        }
    }
}
