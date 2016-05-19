<?php namespace PathoTrack\Http\Controllers;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Booking;
use PathoTrack\BookingPackage;
use PathoTrack\BookingTest;
use PathoTrack\Vendor;

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
            $booking->vendor;
            $booking->user;
            $booking->bookingSlot;
        }
    }

    public function store()
    {
        $input = Input::json()->get('booking');

        $booking = new Booking($input);
        if ($input['vendor_id'] == null) {
            $booking->vendor_id = Vendor::where('user_id', '=', Auth::user()->id)->pluck('id');
        }
        $booking->save();

        if (isset($input['test_ids']) && sizeof($input['test_ids']) > 0) {
            foreach ($input['test_ids'] as $test_id) {
                $booking_test = new BookingTest();
                $booking_test->booking_id = $booking->id;
                $booking_test->test_id = $test_id;
                $booking_test->save();
            }
        }
        
        if (isset($input['package_ids']) && sizeof($input['package_ids']) > 0) {
            foreach ($input['package_ids'] as $package_id) {
                $booking_package = new BookingPackage();
                $booking_package->booking_id = $booking->id;
                $booking_package->package_id = $package_id;
                $booking_package->save();
            }
        }

        return Response::json(array(
            'booking' => [$booking]
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

        
        return Response::json(array(
            'booking' => $booking
        ), 200);
    }

    public function update($id)
    {
        $input = Input::json()->get('booking');

        $booking = Booking::find($id);
        if ($input['vendor_id'] == null) {
            $booking->vendor_id = Vendor::where('user_id', '=', Auth::user()->id)->pluck('id');
        }
        $booking->update($input);

        if (isset($input['test_ids'])) {
            BookingTest::where('booking_id', '=', $booking->id)->delete();
            foreach ($input['test_ids'] as $test_id) {
                $booking_test = new BookingTest();
                $booking_test->booking_id = $booking->id;
                $booking_test->test_id = $test_id;
                $booking_test->save();
            }
        }
        
        if (isset($input['package_ids'])) {
            BookingPackage::where('booking_id', '=', $booking->id)->delete();
            foreach ($input['package_ids'] as $package_id) {
                $booking_package = new BookingPackage();
                $booking_package->booking_id = $booking->id;
                $booking_package->package_id = $package_id;
                $booking_package->save();
            }
        }
                    
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