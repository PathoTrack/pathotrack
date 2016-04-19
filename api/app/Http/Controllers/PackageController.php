<?php

namespace PathoTrack\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Response;

use PathoTrack\Http\Requests;

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

        $packages = DB::table('packages')->get();

        return Response::json(array(
            'errors' => $errors,
            'packages' => $packages
        ), empty($errors) ? 200 : 400);
    }
}
