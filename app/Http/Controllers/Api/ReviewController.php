<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewRecource;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * @param $id
     * @return mixed
     */
    public function show($id){
        return new ReviewRecource(Review::findOrFail($id));
    }

    public function store(Request $request) {

    }
}
