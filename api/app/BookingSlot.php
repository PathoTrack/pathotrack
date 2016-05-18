<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

class BookingSlot extends Model
{
    protected $fillable = ['day', 'start_time', 'end_time', 'is_active'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'booking_slots';
}
