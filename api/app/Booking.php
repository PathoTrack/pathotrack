<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Booking extends Model
{
    protected $fillable = ['date', 'booking_slot_id', 'user_id', 'vendor_id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookings';

    public function vendor() {
        return $this->belongsTo('PathoTrack\Vendor');
    }

    public function user() {
        return $this->belongsTo('PathoTrack\User');
    }

    public function bookingSlot() {
        return $this->belongsTo('PathoTrack\BookingSlot');
    }

    public static function storeBooking($input, $vendor_id) {

        $booking = new Booking($input);
        $booking->vendor_id = $vendor_id;
        $booking->save();

        if (isset($input['test_ids']) && sizeof($input['test_ids']) > 0) {
            foreach ($input['test_ids'] as $test_id) {
                BookingTest::storeBookingTest($booking->id, $test_id);
            }
        }
        
        if (isset($input['package_ids']) && sizeof($input['package_ids']) > 0) {
            foreach ($input['package_ids'] as $package_id) {
                BookingPackage::storeBookingPackage($booking->id, $package_id);
            }
        }

        return $booking;
    }

    public static function updateBooking($existing_booking, $new_booking) {

        if ($new_booking['vendor_id'] == null) {
            $existing_booking->vendor_id = Vendor::where('user_id', '=', Auth::user()->id)->pluck('id');
        }
        $existing_booking->update($new_booking);

        if (isset($new_booking['test_ids'])) {
            BookingTest::deleteBookingTest($existing_booking->id);
            foreach ($new_booking['test_ids'] as $test_id) {
                BookingTest::storeBookingTest($existing_booking->id, $test_id);
            }
        }
        
        if (isset($new_booking['package_ids'])) {
            BookingPackage::deleteBookingPackage($existing_booking->id);
            foreach ($new_booking['package_ids'] as $package_id) {
                BookingPackage::storeBookingPackage($existing_booking->id, $package_id);
            }
        }

        return $existing_booking;
    }

    public static function isSlotAvailable($slot_id, $date) {
        return Booking::where('booking_slot_id', '=', $slot_id)->where('date', '=', $date)->count() < 1 ? true : false;
    }
}
