<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

class BookingPackage extends Model
{
    protected $fillable = ['package_id', 'booking_id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'booking_packages';
}