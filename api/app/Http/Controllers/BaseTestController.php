<?php namespace PathoTrack\Http\Controllers;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Test;
use PathoTrack\Package;

class BaseTestController extends Controller
{
    
    public static $total_pages = null;

    public function store(Request $request)
    {
        $input = Input::json()->get('test');

        $test = new Test($input);
        $test->save();

        return Response::json(array(
            'errors' => [],
            'test' => [$test]
        ), 200);
    }
    
    public function show($id)
    {
        $test = Test::find($id);
        
        return Response::json(array(
            'errors' => [],
            'test' => $test
        ), 200);
    }

    public function update(Request $request, $id)
    {
        $input = Input::json()->get('test');

        $test = Test::find($id);
        $test->update($input);
                    
        return Response::json(array(
            'errors' => [],
            'test' => [$test]
        ), 200);
    }

    public function destroy($id)
    {
        $test = Test::find($id);
        $test->delete();
     
        return Response::json(array(
            'errors' => [],
        ), 200);
    }
}
