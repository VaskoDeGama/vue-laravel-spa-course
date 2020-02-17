<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
 */
class Booking extends Model
{
    protected $fillable = ['from','to'];

    public function bookable() {
        return $this->belongsTo(Bookable::class);
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
}
