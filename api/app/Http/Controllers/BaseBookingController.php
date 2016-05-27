<?php namespace PathoTrack\Http\Controllers;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Booking;
use PathoTrack\BookingPatient;
use PathoTrack\BookingPackage;
use PathoTrack\BookingTest;
use PathoTrack\Vendor;
use PathoTrack\Role;
use PathoTrack\User;

class BaseBookingController extends Controller
{

    public static $total_pages = null;

    public function getBookings($inputs) {

        $nonfilter_keys = ['page', 'per_page', 'search'];
        $per_page = null;

        if(array_key_exists('per_page', $inputs)) {
            $per_page = $inputs['per_page'];
        }

        $filters = array_except($inputs, $nonfilter_keys);

        $bookings = Booking::orderBy('booking_slot_id', 'asc');

        foreach ($filters as $key => $value) {
            if ($value) {
                $bookings = $bookings->where($key, '=', $value);
            }
        }

        if (!is_null($per_page)) {
            $paginator = $bookings->paginate($per_page);
            $bookings = $paginator->items();
            self::$total_pages = $paginator->lastPage();
        } else {
            $bookings = $bookings->get();
        }

        return $bookings;
    }

    public function getBookingsData($bookings) {
        foreach ($bookings as $booking) {
            $booking->vendor->user;
            $booking->user;
            $booking->bookingSlot;
        }
    }

    public function store()
    {
        $input = Input::json()->get('booking');
        $patients = $input['patients'];

        if (!Booking::isSlotAvailable($input['booking_slot_id'], $input['date'])) {
            return Response::json(array(
                'errors' => array([
                    'title'     => 'Slot is already occupied.',
                    'status'    => 'UNPROCESSABLE_ENTITY',
                    'code'      => 422
                ]),
            ), 422);
        }

        $vendor_id = $input['vendor_id']; // if request is coming from staff, it will send vendor_id in request
        if ($input['vendor_id'] == null) {
            $vendor_id = Vendor::where('user_id', '=', Auth::user()->id)->pluck('id');
        }

        $input['user_id'] = Auth::user()->id; // booking done by user
        $booking = Booking::storeBooking($input, $vendor_id);

        // Store patients
        $patients = BookingPatient::addBookingPatients($patients, $booking->id);
        
        return Response::json(array(
            'booking' => [$booking],
            'patients'  => $patients
        ), 200);
    }

    public function show($id)
    {
        $booking = Booking::find($id);

        $booking->vendor;
        $booking->user;
        $booking->bookingSlot;
        $booking->test_ids = BookingTest::where('booking_id', '=', $booking->id)->lists('test_id');
        $booking->package_ids = BookingPackage::where('booking_id', '=', $booking->id)->lists('package_id');
        $patient_ids = BookingPatient::where('booking_id', '=', $booking->id)->lists('patient_id');
        $booking->patients = User::whereIn('id', $patient_ids)->get();
        
        return Response::json(array(
            'booking' => $booking
        ), 200);
    }

    public function update($id)
    {
        $input = Input::json()->get('booking');
        $patients = $input['patients'];
        $existing_booking = Booking::find($id);

        if ($existing_booking->booking_slot_id != $input['booking_slot_id']) {
            if (!Booking::isSlotAvailable($input['booking_slot_id'], $input['date'])) {
                return Response::json(array(
                    'errors' => array([
                        'title'     => 'Slot is already occupied.',
                        'status'    => 'UNPROCESSABLE_ENTITY',
                        'code'      => 422
                    ]),
                ), 422);
            }
        }

        $input['user_id'] = Auth::user()->id; // booking done by user
        $booking = Booking::updateBooking($existing_booking, $input);
                    
        return Response::json(array(
            'booking' => $booking
        ), 200);
    }

    public function destroy($id)
    {
        $booking = Booking::find($id);
        $booking->delete();
     
        return Response::json(array(
            'errors' => []
        ), 200);
    }
}