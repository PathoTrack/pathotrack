<?php namespace PathoTrack\Http\Controllers\Admin;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $errors = [];
        $vendors = [];
        $total_pages = null;
        $filters = Input::get();
        $per_page = Input::get('per_page');

        $nonFilterKeys = array('per_page', 'page', 'search');

        $vendors = Vendor::orderBy('name', 'asc');

        if(Input::has('search') && !empty(Input::get('search'))) {
            $vendors = $vendors->where('name', 'like', '%'.Input::get('search').'%');
        }

        foreach ($filters as $key => $value) {
            if (!in_array($key, $nonFilterKeys)) {
                $vendors = $vendors->where($key, '=', $value);
            }
        }

        if ($per_page) {
            $vendor_pagination = $vendors->paginate($per_page);
            $vendors = $vendor_pagination->items();
            $total_pages = $vendor_pagination->lastPage();
        } else if($filters) {
            $vendors = $vendors->get();
        } else {
            $vendors = $vendors->get();
        }

        return Response::json(array(
            'errors' => $errors,
            'vendors' => $vendors,
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
     * @return Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $vendor = Vendor::find($id);
        
        return Response::json(array(
            'errors' => [],
            'vendor' => $vendor
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
     * @param  int  $id
     * @return Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();
     
        return Response::json(array(
            'errors' => [],
        ), 200);
    }
}
