<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

class BookingPatient extends Model
{
    protected $fillable = ['booking_id', 'patient_id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'booking_patients';

    public function booking() {
        return $this->belongsTo('PathoTrack\Booking');
    }
    
    public function patient() {
        return $this->belongsTo('PathoTrack\User');
    }
}