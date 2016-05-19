<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['date', 'booking_slot_id', 'user_id', 'vendor_id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookings';

    public function vendor() {
        return $this->belongsTo('PathoTrack\Vendor');
    }

    public function user() {
        return $this->belongsTo('PathoTrack\User');
    }

    public function bookingSlot() {
        return $this->belongsTo('PathoTrack\BookingSlot');
    }
}
