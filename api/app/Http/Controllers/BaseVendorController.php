<?php namespace PathoTrack\Http\Controllers;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Vendor;
use PathoTrack\User;
use PathoTrack\Role;
use Hash;

class BaseVendorController extends Controller
{
    public function store()
    {
        $input = Input::json()->get('vendor');

        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->save();

        $user->attachRole(Role::where('name', '=', 'vendor')->pluck('id'));

        unset($input['name']);
        unset($input['email']);
        unset($input['password']);

        $vendor = new Vendor($input);
        $vendor->user_id = $user->id;
        $vendor->key = bin2hex(openssl_random_pseudo_bytes(16));
        $vendor->save();

        $vendor->user;

        return Response::json(array(
            'errors' => [],
            'user' => [$user],
            'vendor' => [$vendor],
        ), 200);
    }

    public function show($id)
    {
        $vendor = Vendor::find($id);

        if ($vendor->user) {
            $vendor->name = $vendor->user->name;
            $vendor->email = $vendor->user->email;
        }
        
        return Response::json(array(
            'errors' => [],
            'vendor' => $vendor
        ), 200);
    }

    public function update($id)
    {
        $input = Input::json()->get('vendor');

        $vendor = Vendor::find($id);
        $vendor->update($input);

        $user = User::find($vendor->user_id);

        $user->name = $input['name'];
        $user->email = $input['email'];
        if (isset($input['password']) && $input['password'] != '') {
            $user->password = Hash::make($input['password']);
        }
        $user->update();
                    
        return Response::json(array(
            'errors' => [],
            'vendor' => [$vendor]
        ), 200);
    }

    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();
     
        return Response::json(array(
            'errors' => [],
        ), 200);
    }
}
