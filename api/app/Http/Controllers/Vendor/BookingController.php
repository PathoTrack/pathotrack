<?php namespace PathoTrack\Http\Controllers\Vendor;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Booking;
use PathoTrack\BookingPackage;
use PathoTrack\BookingTest;

class BookingController extends Controller
{
    public function index()
    {
        $errors = [];
        $bookings = [];
        $total_pages = null;
        $filters = Input::get();
        $per_page = Input::get('per_page');

        $nonFilterKeys = array('per_page', 'page', 'search');

        $bookings = Booking::orderBy('booking_slot_id', 'asc');

        foreach ($filters as $key => $value) {
            if (!in_array($key, $nonFilterKeys)) {
                $bookings = $bookings->where($key, '=', $value);
            }
        }

        if ($per_page) {
            $vendor_pagination = $bookings->paginate($per_page);
            $bookings = $vendor_pagination->items();
            $total_pages = $vendor_pagination->lastPage();
        } else if($filters) {
            $bookings = $bookings->get();
        } else {
            $bookings = $bookings->get();
        }

        foreach ($bookings as $booking) {
            $booking->vendor;
            $booking->user;
            $booking->bookingSlot;
        }

        return Response::json(array(
            'errors' => $errors,
            'bookings' => $bookings,
            'meta' => array(
                'total_pages' => $total_pages
            )
        ), empty($errors) ? 200 : 400);
    }

    public function store()
    {
        $input = Input::json()->get('booking');

        $booking = new Booking($input);
        $booking->save();

        if (isset($input['tests']) && sizeof($input['tests']) > 0) {
            foreach ($input['tests'] as $test_id) {
                $booking_test = new BookingTest();
                $booking_test->booking_id = $booking->id;
                $booking_test->test_id = $test_id;
                $booking_test->save();
            }
        }
        
        if (isset($input['packages']) && sizeof($input['packages']) > 0) {
            foreach ($input['packages'] as $package_id) {
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
        
        return Response::json(array(
            'booking' => $booking
        ), 200);
    }

    public function update($id)
    {
        $input = Input::json()->get('booking');

        $booking = Booking::find($id);
        $booking->update($input);

        if (isset($input['tests']) && sizeof($input['tests']) > 0) {
            BookingTest::where('booking_id', '=', $booking->id)->delete();
            foreach ($input['tests'] as $test_id) {
                $booking_test = new BookingTest();
                $booking_test->booking_id = $booking->id;
                $booking_test->test_id = $test_id;
                $booking_test->save();
            }
        }
        
        if (isset($input['packages']) && sizeof($input['packages']) > 0) {
            BookingPackage::where('booking_id', '=', $booking->id)->delete();
            foreach ($input['packages'] as $package_id) {
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
