<?php namespace PathoTrack\Http\Controllers;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\BookingPatient;

class BaseBookingPatientController extends Controller
{

    public static $total_pages = null;

    public function getBookingPatients($inputs) {

        $nonfilter_keys = ['page', 'per_page', 'search'];
        $per_page = null;

        if(array_key_exists('per_page', $inputs)) {
            $per_page = $inputs['per_page'];
        }

        $filters = array_except($inputs, $nonfilter_keys);

        $booking_patients = BookingPatient::orderBy('booking_id', 'asc');

        foreach ($filters as $key => $value) {
            if ($value) {
                $booking_patients = $booking_patients->where($key, '=', $value);
            }
        }

        if (!is_null($per_page)) {
            $paginator = $booking_patients->paginate($per_page);
            $booking_patients = $paginator->items();
            self::$total_pages = $paginator->lastPage();
        } else {
            $booking_patients = $booking_patients->get();
        }

        return $booking_patients;
    }

    public function getPatientsData($booking_patients) {
        foreach ($booking_patients as $booking_patient) {
            $booking_patient->booking;
            $booking_patient->patient;
        }
    }
}