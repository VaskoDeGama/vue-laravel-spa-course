<?php

namespace App\Http\Controllers\Api;


use App\Bookable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookableAvailabilityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $id Bookable id
     * @param \Illuminate\Http\Request $request
     *
     */
    public function __invoke($id, Request $request)
    {
        $data = $request -> validate([
            'from' => 'required|date_format:Y-m-d|after_or_equal:now',
            'to' => 'required|date_format:Y-m-d|after_or_equal:from'
        ]);

        $bookable = Bookable::findOrFail($id);

        return $bookable->availableFor($data['from'],$data['to'])
            ? response()->json([], 200)
            : response()->json([], 404);

    }
}
