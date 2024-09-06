<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\JsonResponse;

class PlaceController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $search = request()->query('name');
        $sort = request()->query('sort');
        if ($sort !== 'asc' && $sort !== 'desc') {
            $sort = 'asc';
        }
        $places = Place::where('name','LIKE',"%{$search}%")->orderBy('bike_count', $sort)->get();

        return $this->response([
            'places' => $places
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function detail(int $id): JsonResponse
    {
        $place = Place::find($id);
        if (!($place instanceof Place)) {
            return $this->response([
                'message' => 'Place not found',
            ], 404);
        }

        return $this->response([
            'place' => $place
        ]);
    }
}
