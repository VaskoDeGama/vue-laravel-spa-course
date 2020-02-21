<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingByReviewKeyController extends Controller
{
    /**
     * @param $reviewKey
     * @param Request $request
     */
    public function __invoke($reviewKey ,Request $request)
    {
        return Booking::findByReviewKey($reviewKey) ?? abort(404);
    }

}
