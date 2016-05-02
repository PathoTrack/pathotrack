<?php namespace PathoTrack\Http\Controllers;

use PathoTrack\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;
use DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

use Authorizer;
use PathoTrack\User;

class BaseAuthenticatedUserController extends Controller
{
    public function update(Request $request, $id)
    {
        $input = Input::json()->get('authenticatedUser');

        $user = User::find($id);
        $user->update();
                    
        return Response::json(array(
            'errors' => [],
            'user' => [$user]
        ), 200);
    }

    public function destroy() {
        Auth::logout();
        return Response::json(array(
            'errors' => [],
        ), 200);
    }
}
