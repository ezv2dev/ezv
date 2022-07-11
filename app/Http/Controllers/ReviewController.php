<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\DetailReview;
use App\Models\Villa;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($id)
    {
        $this->authorize('review_create');
        $data = Villa::where('id_villa', $id)->get();
        return view('admin.villa.review.create', compact('data'));
    }

    public function store(Request $request){
        $this->authorize('review_create');
        $status = 500;

        try {
            $find = DetailReview::where('id_villa', $request->id)->first();
            if($find){
                $find->update(array(
                    'average_clean' => (($find['average_clean'] * $find['count_person']) + $request->cleanliness) / ($find['count_person'] + 1),
                    'average_service' => (($find['average_service'] * $find['count_person']) + $request->service) / ($find['count_person'] + 1),
                    'average_check_in' => (($find['average_check_in'] * $find['count_person']) + $request->check_in) / ($find['count_person'] + 1),
                    'average_location' => (($find['average_location'] * $find['count_person']) + $request->location) / ($find['count_person'] + 1),
                    'average_value' => (($find['average_value'] * $find['count_person']) + $request->value) / ($find['count_person'] + 1),
                    'average' => (((($find['average_clean'] * $find['count_person']) + $request->cleanliness) / ($find['count_person'] + 1)) + ((($find['average_service'] * $find['count_person']) + $request->service) / ($find['count_person'] + 1)) + ((($find['average_check_in'] * $find['count_person']) + $request->check_in) / ($find['count_person'] + 1)) + ((($find['average_location'] * $find['count_person']) + $request->location) / ($find['count_person'] + 1)) + ((($find['average_value'] * $find['count_person']) + $request->value) / ($find['count_person'] + 1))) / 5,
                    'count_person' => $find['count_person'] + 1,
                    'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                ));
            }else{
                $detail = DetailReview::insert(array(
                    'id_villa' => $request->id,
                    'average_clean' => $request->cleanliness,
                    'average_service' => $request->service,
                    'average_check_in' => $request->check_in,
                    'average_location' => $request->location,
                    'average_value' => $request->value,
                    'count_person' => 1,
                    'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                    'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                ));
            }

            $data = Review::insert(array(
                'cleanliness' => $request->cleanliness,
                'service' => $request->service,
                'check_in' => $request->check_in,
                'location' => $request->location,
                'value' => $request->value,
                'comment' => $request->comment,
                'id_villa' => $request->id,
                'created_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'updated_at' => gmdate("Y-m-d H:i:s", time()+60*60*8),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ));

            if ($data){
                $status = 200;
            }
        } catch ( \Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if($status == 200){
            return redirect()->route('admin_villa')
            ->with('success', 'Your data has been submited');
        }else{
            return back()
            ->with('error','Please check the form below for errors');
        }
    }

    public function destroy($id)
    {
        $this->authorize('review_delete');

        $status = 500;

        try {
            $find = Amenities::where('id_amenities', $id)->first();
            $find->delete();

            if ($find){
                $status = 200;
            }
        } catch ( \Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            $status = 500;
        }

        if($status == 200){
            return redirect()->route('admin_villa')
            ->with('success', 'Your data has been deleted');
        }else{
            return back()
            ->with('error','Please check the form below for errors');
        }

    }
}
