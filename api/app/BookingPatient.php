<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

use PathoTrack\User;
use PathoTrack\Role;

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

    public static function deleteBookingPatient($booking_id) {
        BookingPatient::where('booking_id', '=', $booking_id)->delete();
        return true;
    }

    public static function addBookingPatients($patients, $booking_id) {

        $new_patients = [];

        for ($count = 0; $count < sizeof($patients); $count++) { 
            if (!is_null($patients[$count]['name']) && !is_null($patients[$count]['email'])) {
                $patient_role_id = Role::where('name', '=', 'patient')->pluck('id'); 
                $patients[$count]['id'] = User::storeUser($patients[$count], $patient_role_id)->id;

                $booking_patient = new BookingPatient();
                $booking_patient->patient_id = $patients[$count]['id'];
                $booking_patient->booking_id = $booking_id;
                $booking_patient->save();

                array_push($new_patients, $patients[$count]);
            }
        }

        return $new_patients;
    }
}