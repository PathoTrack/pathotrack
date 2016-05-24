<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

class BookingSlot extends Model
{
    protected $fillable = ['day', 'start_time', 'end_time', 'is_active', 'no_of_booking'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'booking_slots';

    public static function getExistingBookingSlot($input) {
    	return BookingSlot::where('day', '=', $input['day'])
            ->where('start_time', '=', $input['start_time'])
            ->first();
    }
}
