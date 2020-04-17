<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Booking
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $from
 * @property string $to
 * @property int $bookable_id
 * @property-read \App\Bookable $bookable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereBookableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $review_key
 * @property-read \App\Review $review
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking beetwinDates($from, $to)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereReviewKey($value)
 */
class Booking extends Model
{
    protected $fillable = ['from','to'];

    public function bookable() {
        return $this->belongsTo(Bookable::class);
    }


    public function review() {
        return $this->hasOne(Review::class);
    }

    public function adress()  {
        return $this -> belongsTo(Address::class);
    }

    /**
     * scope for query Beetwin Dates
     * @param Builder $query
     * @param $from
     * @param $to
     * @return Builder
     */
    public function scopeBeetwinDates(Builder $query, $from, $to) {
        return $query->where('to', '>=', $from)
            ->where('from', '<=', $to);
    }

    /**
     * @param string $review_key
     * @return Booking|null
     */
    public static function findByReviewKey (string $reviewKey): ?Booking {
        return static::where('review_key', $reviewKey)->with('bookable')->get()->first();
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function($booking) {
           $booking -> review_key = Str::uuid();
        });

    }
}
