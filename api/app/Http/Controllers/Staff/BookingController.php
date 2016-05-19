<?php namespace PathoTrack\Http\Controllers\Staff;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\BaseBookingController;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class BookingController extends BaseBookingController
{
    public function index()
    {
        $errors = [];
        $bookings = collect([]);
        $inputs = Input::get();

        $bookings = BaseBookingController::getBookings($inputs);
        BaseBookingController::getBookingsData($bookings);

        return Response::json(array(
            'errors' => $errors,
            'bookings' => $bookings,
            'meta' => array(
                'total_pages' => BaseBookingController::$total_pages
            )
        ), empty($errors) ? 200 : 400);
    }
}