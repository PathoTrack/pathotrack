<?php

namespace PathoTrack\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Response;

use PathoTrack\Http\Requests;

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

        $tests = DB::table('tests')->get();

        return Response::json(array(
            'errors' => $errors,
            'tests' => $tests
        ), empty($errors) ? 200 : 400);
    }
}
