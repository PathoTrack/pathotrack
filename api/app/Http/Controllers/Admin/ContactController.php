<?php namespace PathoTrack\Http\Controllers\Admin;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
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
            $contacts = $contacts->where('name', 'like', '%'.Input::get('search').'%');
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

        return Response::json(array(
            'errors' => $errors,
            'contacts' => $contacts,
            'meta' => array(
                'total_pages' => $total_pages
            )
        ), empty($errors) ? 200 : 400);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::json()->get('contact');

        $contact = new Contact($input);
        $contact->save();

        return Response::json(array(
            'errors' => [],
            'contact' => [$contact]
        ), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        
        return Response::json(array(
            'errors' => [],
            'contact' => $contact
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::json()->get('contact');

        $contact = Contact::find($id);
        $contact->update($input);
                    
        return Response::json(array(
            'errors' => [],
            'contact' => [$contact]
        ), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
     
        return Response::json(array(
            'errors' => [],
        ), 200);
    }
}
