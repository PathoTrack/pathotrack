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
        $vendor_key_from_request = null;
        $input = Input::json()->get('booking');

        if (isset(getallheaders()['vendor_key'])) {
            $vendor_key_from_request = getallheaders()['vendor_key'];
        }

        if (!is_null($vendor_key_from_request)) {
            $vendor = Vendor::findVendor($vendor_key_from_request);
            if (sizeof($vendor) < 1) {
                return Response::json(array(
                    'error' => array([
                        'title'     => 'Invalid vendor key',
                        'status'    => 'UNPROCESSABLE_ENTITY',
                        'code'      => 422
                    ]),
                ), 422);
            }
        }

        if (!Booking::isSlotAvailable($input['booking_slot_id'], $input['date'])) {
            return Response::json(array(
                'error' => array([
                    'title'     => 'Slot is already occupied.',
                    'status'    => 'UNPROCESSABLE_ENTITY',
                    'code'      => 422
                ]),
            ), 422);
        }

        $booking = Booking::storeBooking($input, $vendor->id);
        
        return Response::json(array(
            'booking' => [$booking]
        ), 200);
    }
}