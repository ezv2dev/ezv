<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\Villa;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SortFilterController extends Controller
{
    public function sort_low_to_high(Request $request)
    {
        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        if ($request->location == '') {
            $req['location'] = null;
            $req['check_in'] = null;
            $req['check_out'] = null;
            $req['adult'] = null;
            $req['children'] = null;

            $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                ->orderBy('price', 'ASC')
                ->inRandomOrder()->get();
        } else {
            if ($request->adult == '' || $request->children == '') {
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;

                $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    ->where('location.name', 'like', '%' . $request->location . '%')
                    ->orderBy('price', 'ASC')
                    ->inRandomOrder()->get();
            } else {
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;

                $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    ->where('location.name', 'like', '%' . $request->location . '%')
                    ->where('villa.adult', '>=', $request->adult)
                    ->where('villa.children', '>=', $request->children)
                    ->orderBy('price', 'ASC')
                    ->inRandomOrder()->get();
            }
        }

        $amenities = Amenities::all();

        return view('user.list_villa', compact('villa', 'req', 'amenities'));
    }

    public function sort_high_to_low(Request $request)
    {
        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        if ($request->location == '') {
            $req['location'] = null;
            $req['check_in'] = null;
            $req['check_out'] = null;
            $req['adult'] = null;
            $req['children'] = null;

            $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                ->orderBy('price', 'DESC')
                ->inRandomOrder()->get();
        } else {
            if ($request->adult == '' || $request->children == '') {
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;

                $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    ->where('location.name', 'like', '%' . $request->location . '%')
                    ->orderBy('price', 'DESC')
                    ->inRandomOrder()->get();
            } else {
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;

                $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    ->where('location.name', 'like', '%' . $request->location . '%')
                    ->where('villa.adult', '>=', $request->adult)
                    ->where('villa.children', '>=', $request->children)
                    ->orderBy('price', 'DESC')
                    ->inRandomOrder()->get();
            }
        }

        $amenities = Amenities::all();

        return view('user.list_villa', compact('villa', 'req', 'amenities'));
    }

    public function popularity(Request $request)
    {
        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        if ($request->location == '') {
            $req['location'] = null;
            $req['check_in'] = null;
            $req['check_out'] = null;
            $req['adult'] = null;
            $req['children'] = null;

            $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                ->orderBy('detail_review.count_person', 'DESC')
                ->inRandomOrder()->get();
        } else {
            if ($request->adult == '' || $request->children == '') {
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;

                $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    ->where('location.name', 'like', '%' . $request->location . '%')
                    ->orderBy('detail_review.count_person', 'DESC')
                    ->inRandomOrder()->get();
            } else {
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;

                $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    ->where('location.name', 'like', '%' . $request->location . '%')
                    ->where('villa.adult', '>=', $request->adult)
                    ->where('villa.children', '>=', $request->children)
                    ->orderBy('detail_review.count_person', 'DESC')
                    ->inRandomOrder()->get();
            }
        }

        $amenities = Amenities::all();

        return view('user.list_villa', compact('villa', 'req', 'amenities'));
    }

    public function newest(Request $request)
    {
        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        if ($request->location == '') {
            $req['location'] = null;
            $req['check_in'] = null;
            $req['check_out'] = null;
            $req['adult'] = null;
            $req['children'] = null;

            $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                ->orderBy('id_villa', 'DESC')
                ->inRandomOrder()->get();
        } else {
            if ($request->adult == '' || $request->children == '') {
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;

                $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    ->where('location.name', 'like', '%' . $request->location . '%')
                    ->orderBy('villa_review.value', 'DESC')
                    ->orderBy('id_villa', 'DESC')
                    ->inRandomOrder()->get();
            } else {
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;

                $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    ->where('location.name', 'like', '%' . $request->location . '%')
                    ->where('villa.adult', '>=', $request->adult)
                    ->where('villa.children', '>=', $request->children)
                    ->orderBy('villa_review.value', 'DESC')
                    ->orderBy('id_villa', 'DESC')
                    ->inRandomOrder()->get();
            }
        }

        $amenities = Amenities::all();

        return view('user.list_villa', compact('villa', 'req', 'amenities'));
    }

    public function highest_rating(Request $request)
    {
        if (empty($request)) {
            $req = 0;
        } else {
            $req = $request->all();
        }

        if ($request->location == '') {
            $req['location'] = null;
            $req['check_in'] = null;
            $req['check_out'] = null;
            $req['adult'] = null;
            $req['children'] = null;

            $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                ->orderBy('detail_review.count_person', 'DESC')
                ->inRandomOrder()->get();
        } else {
            if ($request->adult == '' || $request->children == '') {
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;

                $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    ->where('location.name', 'like', '%' . $request->location . '%')
                    ->orderBy('detail_review.count_person', 'DESC')
                    ->inRandomOrder()->get();
            } else {
                $req['location'] = null;
                $req['check_in'] = null;
                $req['check_out'] = null;
                $req['adult'] = null;
                $req['children'] = null;

                $villa = Villa::select('villa.*', DB::raw('(select name from villa_video where id_villa = villa.id_villa order by id_video asc limit 1) as video'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo asc limit 1) as photo'), DB::raw('(select name from villa_photo where id_villa = villa.id_villa order by id_photo desc limit 1) as photo2'), 'detail_review.average as average', 'detail_review.count_person as person')
                    ->join('detail_review', 'villa.id_villa', '=', 'detail_review.id_villa', 'left')
                    ->join('location', 'villa.id_location', '=', 'location.id_location', 'left')
                    ->where('location.name', 'like', '%' . $request->location . '%')
                    ->where('villa.adult', '>=', $request->adult)
                    ->where('villa.children', '>=', $request->children)
                    ->orderBy('detail_review.count_person', 'DESC')
                    ->inRandomOrder()->get();
            }
        }

        $amenities = Amenities::all();

        return view('user.list_villa', compact('villa', 'req', 'amenities'));
    }
}
