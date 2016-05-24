<?php namespace PathoTrack\Http\Controllers\Admin;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\BookingSlot;

class BookingSlotController extends Controller
{
    public function index()
    {
        $errors = [];
        $booking_slots = [];
        $total_pages = null;
        $filters = Input::get();
        $per_page = Input::get('per_page');

        $nonFilterKeys = array('per_page', 'page', 'search');

        $booking_slots = BookingSlot::orderBy('day', 'asc')->where('is_active', '=', true);

        foreach ($filters as $key => $value) {
            if (!in_array($key, $nonFilterKeys)) {
                $booking_slots = $booking_slots->where($key, '=', $value);
            }
        }

        if ($per_page) {
            $vendor_pagination = $booking_slots->paginate($per_page);
            $booking_slots = $vendor_pagination->items();
            $total_pages = $vendor_pagination->lastPage();
        } else if($filters) {
            $booking_slots = $booking_slots->get();
        } else {
            $booking_slots = $booking_slots->get();
        }

        return Response::json(array(
            'errors' => $errors,
            'booking_slots' => $booking_slots,
            'meta' => array(
                'total_pages' => $total_pages
            )
        ), empty($errors) ? 200 : 400);
    }

    public function store()
    {
        $input = Input::json()->get('bookingSlot');

        $existing_booking_slot = BookingSlot::getExistingBookingSlot($input);

        if (sizeof($existing_booking_slot) > 0) {
            $existing_booking_slot->no_of_booking = $existing_booking_slot->no_of_booking + 1;
            $existing_booking_slot->save();
            $booking_slot = $existing_booking_slot;
        } else {
            $booking_slot = new BookingSlot($input);
            $booking_slot->end_time = $input['start_time'] + 1;
            $booking_slot->save();
        }

        return Response::json(array(
            'booking_slot' => [$booking_slot]
        ), 200);
    }

    public function show($id)
    {
        $booking_slot = BookingSlot::find($id);
        
        return Response::json(array(
            'booking_slot' => $booking_slot
        ), 200);
    }

    public function update($id)
    {
        $input = Input::json()->get('bookingSlot');

        $booking_slot = BookingSlot::find($id);
        $existing_booking_slot = BookingSlot::getExistingBookingSlot($input);

        if (sizeof($existing_booking_slot) > 0 && $existing_booking_slot->id != $id) {
            $existing_booking_slot->no_of_booking = $existing_booking_slot->no_of_booking + 1;
            $existing_booking_slot->save();
        } else {
            $booking_slot->end_time = $input['start_time'] + 1;
            $booking_slot->update($input);
        }
                    
        return Response::json(array(
            'booking_slot' => $booking_slot
        ), 200);
    }

    public function destroy($id)
    {
        $booking_slot = BookingSlot::find($id);
        $booking_slot->is_active = false;
        $booking_slot->update();
     
        return Response::json(array(
            'booking_slot' => $booking_slot
        ), 200);
    }
}
