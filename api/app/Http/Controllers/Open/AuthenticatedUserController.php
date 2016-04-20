<?php namespace Prsntly\Http\Controllers\Open;

use Prsntly\Http\Requests;
use Prsntly\Http\Controllers\Controller;

use Request;
use Response;
use DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

use Authorizer;
use Prsntly\User;

class AuthenticatedUserController extends Controller {

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
            $user->no_of_flagged_logs = DB::table('logs')->where('user_id', '=', $user->id)->where('is_flagged', '=', true)->count();
            foreach ($user->roles as $role) {
                if ($role->department_id) {
                    $role_ids = DB::table('roles')->where('department_id', '=', $role->department_id)->lists('id');
                }
            }
            $user_ids = DB::table('role_user')->whereIn('role_id', $role_ids)->groupBy('user_id')->lists('user_id');
            $user->no_of_logs_needs_review = DB::table('logs')->whereIn('user_id', $user_ids)->where('needs_review', '=', true)->count();
            $user->gravatar_img_url = 'https://www.gravatar.com/avatar/'.md5( strtolower( trim( Auth::user()->email ) ) ).'?d=mm';
        }

        return Response::json(array(
            'errors' => $errors,
            'authenticatedUsers' => [$user]
        ), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = Input::json()->get('authenticatedUser');

        $user = User::find($id);
        $user->reg_id = $input['reg_id'];
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
