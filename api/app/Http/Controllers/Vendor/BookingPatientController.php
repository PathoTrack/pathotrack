<?php 

namespace PathoTrack\Http\Controllers\Vendor;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\BaseBookingPatientController;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class BookingPatientController extends BaseBookingPatientController
{
    public function index()
    {
        $errors = [];
        $booking_patients = collect([]);
        $inputs = Input::get();

        $booking_patients = BaseBookingPatientController::getBookingPatients($inputs);
        BaseBookingPatientController::getPatientsData($booking_patients);
        
        return Response::json(array(
            'errors' => $errors,
            'booking_patients' => $booking_patients,
            'meta' => array(
                'total_pages' => BaseBookingPatientController::$total_pages
            )
        ), empty($errors) ? 200 : 400);
    }
}