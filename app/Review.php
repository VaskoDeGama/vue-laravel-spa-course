<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Review
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $rating
 * @property string $content
 * @property int $bookable_id
 * @property int|null $booking_id
 * @property-read \App\Bookable $bookable
 * @property-read \App\Booking|null $booking
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Review whereBookableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Review whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Review whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Review whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Review extends Model
{
    protected $fillable = [
        'id', 'content', 'rating'
    ];

    public function bookable() {
        return $this->belongsTo(Bookable::class);
    }

    public function booking() {
        return $this->belongsTo(Booking::class);
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}

