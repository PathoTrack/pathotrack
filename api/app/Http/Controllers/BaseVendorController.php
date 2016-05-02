<?php namespace PathoTrack\Http\Controllers;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Vendor;

class BaseVendorController extends Controller
{
    public function store()
    {
        $input = Input::json()->get('vendor');

        $vendor = new Vendor($input);
        $vendor->save();

        return Response::json(array(
            'errors' => [],
            'vendor' => [$vendor]
        ), 200);
    }

    public function show($id)
    {
        $vendor = Vendor::find($id);
        
        return Response::json(array(
            'errors' => [],
            'vendor' => $vendor
        ), 200);
    }

    public function update($id)
    {
        $input = Input::json()->get('vendor');

        $vendor = Vendor::find($id);
        $vendor->update($input);
                    
        return Response::json(array(
            'errors' => [],
            'vendor' => [$vendor]
        ), 200);
    }

    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();
     
        return Response::json(array(
            'errors' => [],
        ), 200);
    }
}
