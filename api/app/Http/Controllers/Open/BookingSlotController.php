<?php namespace PathoTrack\Http\Controllers\Open;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\BaseBookingSlotController;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\BookingSlot;

class BookingSlotController extends BaseBookingSlotController
{
    public function index()
    {
        $errors = [];
        $booking_slots = collect([]);
        $inputs = Input::get();

        $booking_slots = BaseBookingSlotController::getBookingSlots($inputs);

        return Response::json(array(
            'errors' => $errors,
            'booking_slots' => $booking_slots,
            'meta' => array(
                'total_pages' => BaseBookingSlotController::$total_pages
            )
        ), empty($errors) ? 200 : 400);
    }
}