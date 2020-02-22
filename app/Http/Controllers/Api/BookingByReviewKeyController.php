<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingByReviewShowResource;
use Illuminate\Http\Request;

class BookingByReviewKeyController extends Controller
{
    /**
     * @param $reviewKey
     * @param Request $request
     */
    public function __invoke($reviewKey ,Request $request)
    {
        $booking = Booking::findByReviewKey($reviewKey);

        return $booking ?  new BookingByReviewShowResource($booking) : abort(404);
    }

}
