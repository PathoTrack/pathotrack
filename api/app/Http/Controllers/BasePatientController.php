<?php namespace PathoTrack\Http\Controllers;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Booking;
use PathoTrack\User;
use PathoTrack\BookingPatient;

class BasePatientController extends Controller
{

    public static $total_pages = null;

    public function getPatients($inputs, $vendor_id = null) {

        $nonfilter_keys = ['page', 'per_page', 'search'];
        $per_page = null;
        $patient_ids = null;

        if(array_key_exists('per_page', $inputs)) {
            $per_page = $inputs['per_page'];
        }

        $filters = array_except($inputs, $nonfilter_keys);

        if (!is_null($vendor_id)) {
            $booking_ids = Booking::where('vendor_id', '=', $vendor_id)->lists('id');
            $patients_ids = BookingPatient::whereIn('booking_id', $booking_ids)->lists('patient_id');
        } else {
            $patients_ids = BookingPatient::lists('patient_id');
        }

        $patients = User::whereIn('id', $patients_ids);

        foreach ($filters as $key => $value) {
            if ($value) {
                $patients = $patients->where($key, '=', $value);
            }
        }

        if (!is_null($per_page)) {
            $paginator = $patients->paginate($per_page);
            $patients = $paginator->items();
            self::$total_pages = $paginator->lastPage();
        } else {
            $patients = $patients->get();
        }

        return $patients;
    }

    public function getPatientsData($patients) {
        foreach ($patients as $patient) {
            $patient->address;
        }
    }
}