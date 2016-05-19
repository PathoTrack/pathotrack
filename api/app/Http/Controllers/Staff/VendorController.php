<?php namespace PathoTrack\Http\Controllers\Staff;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\BaseVendorController;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Vendor;
use PathoTrack\User;

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

        $vendors = Vendor::orderBy('user_id', 'asc');

        if(Input::has('search') && !empty(Input::get('search'))) {
            $user_ids = User::where('name', 'like', '%'.Input::get('search').'%')->lists('id');
            $vendors = $vendors->whereIn('user_id', $user_ids);
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

        foreach ($vendors as $vendor) {
            $vendor->user;
            $vendor->name = $vendor->user->name;
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
