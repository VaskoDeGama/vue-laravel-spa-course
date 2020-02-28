<?php

namespace App\Http\Controllers\Api;

use App\Bookable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookablePriceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function __invoke($id, Request $request)
    {
        $bookable = Bookable::findOrFail($id);

        $data = $request->validate([
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after_or_equal:from',
        ]);

        $days = (new Carbon($data['from']))->diffInDays(new Carbon($data['to']));
        $price = $days * $bookable->price;
        return response() -> json([
            'data' => [
                'total' => $price,
                'breakdown' => [
                    $bookable->price => $days
                ]
            ]
        ]);

    }
}