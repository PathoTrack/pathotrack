<?php namespace PathoTrack\Http\Controllers\Open;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Input;

use PathoTrack\Booking;
use PathoTrack\BookingPackage;
use PathoTrack\BookingPatient;
use PathoTrack\BookingTest;
use PathoTrack\Vendor;
use PathoTrack\User;
use PathoTrack\Role;

class BookingController extends Controller
{
    public function store()
    {
        $user_id = null;
        $booking = collect([]);

        $vendor_key = getallheaders()['vendor_key'];
        $booking = Input::json()->get('booking');
        $patients = Input::json()->get('patients');
        $user = $booking['user'];

        // Store user
        $user_id = User::storeUser($user)->id;

        $vendor = Vendor::findVendor($vendor_key);
        if (!Booking::isSlotAvailable($booking['booking_slot_id'], $booking['date'])) {
            return Response::json(array(
                'error' => array([
                    'title'     => 'Slot is already occupied.',
                    'status'    => 'UNPROCESSABLE_ENTITY',
                    'code'      => 422
                ]),
            ), 422);
        }

        $booking['user_id'] = $user_id;
        $booking = Booking::storeBooking($booking, $vendor->id);

        // Store patients
        for ($count = 0; $count < sizeof($patients); $count++) { 
            $patients[$count]['id'] = User::storeUser($patients[$count], Role::where('name', '=', 'patient')->pluck('id'))->id;

            $booking_patient = new BookingPatient();
            $booking_patient->patient_id = $patients[$count]['id'];
            $booking_patient->booking_id = $booking->id;
            $booking_patient->save();
        }


        return Response::json(array(
            'booking'   => [$booking],
            'patients'  => $patients
        ), 200);
    }
}