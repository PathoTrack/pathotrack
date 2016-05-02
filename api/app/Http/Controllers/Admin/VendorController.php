<?php namespace PathoTrack\Http\Controllers\Admin;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\BaseVendorController;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Vendor;

class VendorController extends BaseVendorController
{
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
}
