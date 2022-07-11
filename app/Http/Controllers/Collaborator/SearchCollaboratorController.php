<?php

namespace App\Http\Controllers\Collaborator;

use App\Models\Collaborator;
use App\Models\CollaboratorAvailability;
use App\Models\CollaboratorCategory;
use App\Models\CollaboratorFilter;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SearchCollaboratorController extends Controller
{
    private function setCookie($name, $value)
    {
        $minutes = 1440;
        $response = new Response($value);
        $response->withCookie(cookie($name, $value, $minutes));
        return $response;
    }

    public function index(Request $request)
    {
        $collab = Collaborator::with('collaboratorHasCategory')->inRandomOrder()->get();
        $collabCategory = CollaboratorCategory::all();
        $collabFilter = CollaboratorFilter::all();

        $sLocation = $request->sLocation;
        $sStart = $request->sStart;
        $sEnd = $request->sEnd;

        $this->setCookie('sStart', $sStart);
        $this->setCookie('sEnd', $sEnd);

        $conditionSearch = $sLocation || $sStart || $sEnd;
        if ($conditionSearch) {
            $collab = $this->processSearch($collab, $request);
        }

        $fCategory = $request->fCategory;
        $filter = $request->filter;

        $conditionFilter = $fCategory || $filter;

        if ($conditionFilter) {
            $collab = $this->processFilter($collab, $request);
        }

        $collabIds = $collab->modelKeys();
        $collab = Collaborator::whereIn('id_collab', $collabIds)->paginate(8);

        return view('collaborator.list_collaborator', compact('collab', 'collabCategory', 'collabFilter'));
    }

    public function processSearch($collabs, $request)
    {
        $collab = $collabs;

        $sLocation = $request->sLocation;
        $sStart = $request->sStart;
        $sEnd = $request->sEnd;

        if ($sLocation) {
            if ($sLocation == 'Add Location') {
                $sLocation = null;
            }
            $location = $sLocation;
            $collabIds = $collab->modelKeys();
            $collabOther = Collaborator::whereIn('id_collab', $collabIds)
                ->whereHas('location', function (Builder $query) use ($location) {
                    $query->where('name', 'like', '%' . $location . '%');
                })->get();

            $collab = new Collection();
            $collab = $collab->merge($collabOther);
        }

        if ($sStart || $sEnd) {
            $collabIds = $collab->modelKeys();
            // dd($collabIds);

            $collab_all = Collaborator::whereIn('id_collab', $collabIds)
                ->orderBy('id_collab', 'asc')->get()->toArray();
            $collab_availability = CollaboratorAvailability::select('id_collab')
                ->whereBetween('start', [$sStart, $sEnd])
                ->orWhereBetween('end', [$sStart, $sEnd])
                ->groupBy('id_collab')
                ->get();

            $count = count($collab_all);
            foreach ($collab_availability as $item) {
                for ($i = 0; $i < $count; $i++) {
                    if (array_search($item->id_collab, $collab_all[$i]) == "id_collab") {
                        unset($collab_all[$i]);
                    }
                }
            }

            $collab = collect($collab_all);
        }

        return $collab;
    }

    public function processFilter($collabs, $request)
    {
        $collab = $collabs;
        $fCategory = $request->fCategory;
        $filter = $request->filter;

        if ($fCategory) {
            $category = $fCategory;
            $collabIds = $collab->pluck('id_collab');
            $collab = Collaborator::with('collaboratorHasCategory')->whereIn('id_collab', $collabIds)
                ->whereHas('collaboratorHasCategory', function (Builder $query) use ($category) {
                    $query->where('id_collab_category', $category);
                })
                ->inRandomOrder()->get();
        }

        if ($filter) {
            $filter = explode(',', $request->filter);
            $collabIds = $collab->modelKeys();
            $collab = Collaborator::with('collaboratorHasFilter')->whereIn('id_collab', $collabIds)
                ->whereHas('collaboratorHasFilter', function (Builder $query) use ($filter) {
                    $query->where('id_collab_filter', $filter);
                })
                ->inRandomOrder()->get();
        }

        return $collab;
    }
}
