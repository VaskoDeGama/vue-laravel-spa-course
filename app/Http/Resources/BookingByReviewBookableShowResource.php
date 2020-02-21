<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed description
 * @property mixed title
 * @property mixed id
 */
class BookingByReviewBookableShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'bookable_id' => $this->id,
            'title' => $this->title,
            'description' => $this->description
        ];
    }
}
