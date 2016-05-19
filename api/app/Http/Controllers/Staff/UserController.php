<?php namespace PathoTrack\Http\Controllers\Staff;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\User;

class UserController extends Controller
{
    public function index()
    {
        $errors = [];
        $users = [];
        $total_pages = null;
        $filters = Input::get();
        $per_page = Input::get('per_page');

        $nonFilterKeys = array('per_page', 'page', 'search');

        $users = User::orderBy('name', 'asc');

        foreach ($filters as $key => $value) {
            if (!in_array($key, $nonFilterKeys)) {
                $users = $users->where($key, '=', $value);
            }
        }

        if ($per_page) {
            $user_pagination = $users->paginate($per_page);
            $users = $user_pagination->items();
            $total_pages = $user_pagination->lastPage();
        } else if($filters) {
            $users = $users->get();
        } else {
            $users = $users->get();
        }


        return Response::json(array(
            'errors' => $errors,
            'users' => $users,
            'meta' => array(
                'total_pages' => $total_pages
            )
        ), empty($errors) ? 200 : 400);
    }
}
