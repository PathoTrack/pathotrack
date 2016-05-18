<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

class BookingTest extends Model
{
    protected $fillable = ['test_id', 'booking_id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'booking_tests';
}