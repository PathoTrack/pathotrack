<?php namespace PathoTrack\Http\Controllers;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\Controller;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PathoTrack\Contact;

class BaseContactController extends Controller
{
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

    public function show($id)
    {
        $contact = Contact::find($id);
        
        return Response::json(array(
            'errors' => [],
            'contact' => $contact
        ), 200);
    }

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

    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
     
        return Response::json(array(
            'errors' => [],
        ), 200);
    }
}
