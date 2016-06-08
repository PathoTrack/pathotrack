<?php namespace PathoTrack\Http\Controllers\Open;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Vendor;

class VendorController extends Controller
{
    public function index()
    {
        $vendor_key = getallheaders()['vendor_key'];
        return Response::json(array(
            'vendors' => [Vendor::findVendor($vendor_key)]
        ), 200);
    }
}