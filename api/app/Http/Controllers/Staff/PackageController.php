<?php namespace PathoTrack\Http\Controllers\Staff;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\BasePackageController;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Package;

class PackageController extends BasePackageController
{
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
}
