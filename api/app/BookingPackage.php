<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

class BookingPackage extends Model
{
    protected $fillable = ['package_id', 'booking_id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'booking_packages';

    public static function storeBookingPackage($booking_id, $package_id) {
    	$booking_package = new BookingPackage();
        $booking_package->booking_id = $booking_id;
        $booking_package->package_id = $package_id;
        $booking_package->save();
        
        return true;
    }

    public static function deleteBookingPackage($booking_id) {
    	BookingPackage::where('booking_id', '=', $booking_id)->delete();
    	return true;
    }
}