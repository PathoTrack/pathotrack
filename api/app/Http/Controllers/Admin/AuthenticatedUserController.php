<?php namespace PathoTrack\Http\Controllers\Admin;

use PathoTrack\Http\Requests;
use PathoTrack\Http\Controllers\BaseAuthenticatedUserController;

use Request;
use Response;
use DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

use Authorizer;
use PathoTrack\User;

class AuthenticatedUserController extends BaseAuthenticatedUserController {

    public function index() {
        $user = null;
        $errors = [];
        $role_ids = [];

        if(Auth::guest()) {
            $user = Auth::loginUsingId(Authorizer::getResourceOwnerId());
        } else {
            $user = Auth::user();
        } 

        if(empty($user)) {
            return Response::json(array(
                'error' => array([
                    'title'     => 'You do not seem to be logged in',
                    'status'    => 'BAD_REQUEST',
                    'code'      => 400
                ]),
            ), 400);
        }

        return Response::json(array(
            'authenticatedUsers' => [$user]
        ), 200);
    }
}
