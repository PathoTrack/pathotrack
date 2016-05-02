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
            $errors = [
                'title' => 'You do not seem to be logged in',
                'code' => 400,
                'status' => 'BAD_REQUEST'
            ];
        } else {
            $user->gravatar_img_url = 'https://www.gravatar.com/avatar/'.md5( strtolower( trim( Auth::user()->email ) ) ).'?d=mm';
        }

        return Response::json(array(
            'errors' => $errors,
            'authenticatedUsers' => [$user]
        ), 200);
    }
}
