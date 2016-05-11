<?php namespace PathoTrack\Http\Controllers\Admin;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\BaseContactController;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Contact;
use PathoTrack\Vendor;
use PathoTrack\User;

class ContactController extends BaseContactController
{
    public function index()
    {
        $errors = [];
        $contacts = [];
        $total_pages = null;
        $filters = Input::get();
        $per_page = Input::get('per_page');

        $nonFilterKeys = array('per_page', 'page', 'search');

        $contacts = Contact::orderBy('name', 'asc');

        if(Input::has('search') && !empty(Input::get('search'))) {
            $user_ids = User::where('name', 'like', '%'.Input::get('search').'%')->lists('id');
            $vendor_ids = Vendor::whereIn('user_id', $user_ids)->lists('id');
            $contacts = $contacts->whereIn('vendor_id', $vendor_ids);
        }

        foreach ($filters as $key => $value) {
            if (!in_array($key, $nonFilterKeys)) {
                $contacts = $contacts->where($key, '=', $value);
            }
        }

        if ($per_page) {
            $contact_pagination = $contacts->paginate($per_page);
            $contacts = $contact_pagination->items();
            $total_pages = $contact_pagination->lastPage();
        } else if($filters) {
            $contacts = $contacts->get();
        } else {
            $contacts = $contacts->get();
        }

        foreach ($contacts as $contact) {
            $contact->vendor->user;
        }
        
        return Response::json(array(
            'errors' => $errors,
            'contacts' => $contacts,
            'meta' => array(
                'total_pages' => $total_pages
            )
        ), empty($errors) ? 200 : 400);
    }
}
