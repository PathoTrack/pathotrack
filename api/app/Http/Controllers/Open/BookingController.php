<?php namespace PathoTrack\Http\Controllers\Open;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Input;

use PathoTrack\Booking;
use PathoTrack\BookingPackage;
use PathoTrack\BookingTest;
use PathoTrack\Vendor;

class BookingController extends Controller
{
    public function store()
    {
        $booking = collect([]);
        $vendor_key = getallheaders()['vendor_key'];
        $inputs = Input::json();
        $booking = $inputs->get('booking');
        $user = $inputs->get('patients');
        $patients = $inputs->get('patients');

        // Store user

        foreach($patients as $patients) {
            // Store patients
        }

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
        $users = Booking::storeBooking($booking, $vendor->id);
        $booking = Booking::storeBooking($booking, $vendor->id);
        
        return Response::json(array(
            'booking'   => [$booking],
            'users'     => $users
        ), 200);
    }
}