<?php namespace PathoTrack\Http\Controllers\Staff;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $test = Test::find($id);
        
        return Response::json(array(
            'errors' => [],
            'test' => [$test]
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $test = Test::find($id);
        $test->delete();
     
        return Response::json(array(
            'errors' => [],
        ), 200);
    }
}
