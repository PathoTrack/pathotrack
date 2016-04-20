<?php namespace PathoTrack\Http\Controllers\Staff;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Package;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $errors = [];
        $packages = [];
        $total_pages = null;
        $filters = Input::get();
        $per_page = Input::get('per_page');

        $nonFilterKeys = array('per_page', 'page', 'search');

        $packages = Package::orderBy('name', 'asc');

        if(Input::has('search') && !empty(Input::get('search'))) {
            $packages = $packages->where('name', 'like', '%'.Input::get('search').'%');
        }

        foreach ($filters as $key => $value) {
            if (!in_array($key, $nonFilterKeys)) {
                $packages = $packages->where($key, '=', $value);
            }
        }

        if ($per_page) {
            $package_pagination = $packages->paginate($per_page);
            $packages = $package_pagination->items();
            $total_pages = $package_pagination->lastPage();
        } else if($filters) {
            $packages = $packages->get();
        } else {
            $packages = $packages->get();
        }

        return Response::json(array(
            'errors' => $errors,
            'packages' => $packages,
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
        $input = Input::json()->get('package');

        $package = new Package($input);
        $package->save();

        return Response::json(array(
            'errors' => [],
            'package' => [$package]
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
        $package = Package::find($id);
        
        return Response::json(array(
            'errors' => [],
            'package' => [$package]
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
        $input = Input::json()->get('package');

        $package = Package::find($id);
        $package->update($input);
                    
        return Response::json(array(
            'errors' => [],
            'package' => [$package]
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
        $package = Package::find($id);
        $package->delete();
     
        return Response::json(array(
            'errors' => [],
        ), 200);
    }
}
