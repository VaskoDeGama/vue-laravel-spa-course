<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Bookable
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $title
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Booking[] $bookings
 * @property-read int|null $bookings_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookable query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookable whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookable whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bookable whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bookable extends Model
{
    public function bookings() {
        return $this->hasMany(Booking::class);
    }

}
