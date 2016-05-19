<?php namespace PathoTrack\Http\Controllers;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\BookingSlot;

class BaseBookingSlotController extends Controller
{

    public static $total_pages = null;

    public function getBookingSlots($inputs) {

        $nonfilter_keys = ['page', 'per_page', 'search'];
        $per_page = null;

        if(array_key_exists('per_page', $inputs)) {
            $per_page = $inputs['per_page'];
        }

        $filters = array_except($inputs, $nonfilter_keys);

        $booking_slots = BookingSlot::orderBy('day', 'asc')->where('is_active', '=', true);

        foreach ($filters as $key => $value) {
            if ($value) {
                $booking_slots = $booking_slots->where($key, '=', $value);
            }
        }

        if (!is_null($per_page)) {
            $paginator = $booking_slots->paginate($per_page);
            $booking_slots = $paginator->items();
            self::$total_pages = $paginator->lastPage();
        } else {
            $booking_slots = $booking_slots->get();
        }

        return $booking_slots;
    }

    public function store()
    {
        $input = Input::json()->get('bookingSlot');

        $booking_slot = new BookingSlot($input);
        $booking_slot->end_time = $input['start_time'] + 1;
        $booking_slot->save();

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
        $booking_slot->end_time = $input['start_time'] + 1;
        $booking_slot->update($input);
                    
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