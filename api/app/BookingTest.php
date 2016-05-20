<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

class BookingTest extends Model
{
    protected $fillable = ['test_id', 'booking_id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'booking_tests';

    public static function storeBookingTest($booking_id, $test_id) {
    	$booking_test = new BookingTest();
        $booking_test->booking_id = $booking_id;
        $booking_test->test_id = $test_id;
        $booking_test->save();
        
        return true;
    }

    public static function deleteBookingTest($booking_id) {
    	BookingTest::where('booking_id', '=', $booking_id)->delete();
    	return true;
    }
}