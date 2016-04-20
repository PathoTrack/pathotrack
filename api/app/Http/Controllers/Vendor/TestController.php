<?php namespace PathoTrack\Http\Controllers\Vendor;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Test;
use PathoTrack\Package;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $errors = [];
        $tests = [];
        $packages = [];
        $total_pages = null;
        $filters = Input::get();
        $per_page = Input::get('per_page');

        $nonFilterKeys = array('per_page', 'page', 'search');

        $tests = Test::orderBy('name', 'asc');

        if(Input::has('search') && !empty(Input::get('search'))) {
            $tests = $tests->where('name', 'like', '%'.Input::get('search').'%');
        }

        foreach ($filters as $key => $value) {
            if (!in_array($key, $nonFilterKeys)) {
                $tests = $tests->where($key, '=', $value);
            }
        }

        if ($per_page) {
            $test_pagination = $tests->paginate($per_page);
            $tests = $test_pagination->items();
            $total_pages = $test_pagination->lastPage();
        } else if($filters) {
            $tests = $tests->get();
        } else {
            $tests = $tests->get();
        }

        return Response::json(array(
            'errors' => $errors,
            'tests' => $tests,
            'meta' => array(
                'total_pages' => $total_pages
            )
        ), empty($errors) ? 200 : 400);
    }
}