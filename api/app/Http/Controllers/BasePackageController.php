<?php namespace PathoTrack\Http\Controllers;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Package;

class BasePackageController extends Controller
{

    public static $total_pages = null;

    public function store(Request $request)
    {
        $input = Input::json()->get('package');

        $package = new Package($input);
        $package->save();

        return Response::json(array(
            'errors' => [],
            'package' => [$package]
        ), 200);
    }

    public function show($id)
    {
        $package = Package::find($id);
        
        return Response::json(array(
            'errors' => [],
            'package' => $package
        ), 200);
    }
    
    public function update(Request $request, $id)
    {
        $input = Input::json()->get('package');

        $package = Package::find($id);
        $package->update($input);
                    
        return Response::json(array(
            'errors' => [],
            'package' => [$package]
        ), 200);
    }

    public function destroy($id)
    {
        $package = Package::find($id);
        $package->delete();
     
        return Response::json(array(
            'errors' => [],
        ), 200);
    }
}
