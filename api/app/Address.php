<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Address extends Model
{
    protected $fillable = ['address_line_1', 'address_line_2', 'pincode', 'special_instructions', 'suburb', 'city', 'latitude', 'longitude'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';

    public static function storeAddress($address) {
        $address = new Address($address);
        $address->save();

        return $address;
    }
}