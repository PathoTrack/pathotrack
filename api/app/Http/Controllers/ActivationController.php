<?php namespace PathoTrack\Http\Controllers;

use PathoTrack\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;
use View;
use Config;

use PathoTrack\User;

class ActivationController extends Controller {

	public function confirm($activation_code)
    {
        if( ! $activation_code) {
            return view('verified-user')->with('message', 'invalid');
        }

        $user = User::where('activation_code', '=', $activation_code)->first();

        if ( ! $user) {
            return view('verified-user')->with('message', 'expired');
        }

        $user->active = 1;
        $user->activation_code = null;
        $user->activated_at = date("Y/m/d H:i:s");
        $user->save();

        return view('verified-user')->with('message', 'success');
    }
}
