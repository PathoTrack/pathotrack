<?php namespace PathoTrack\Http\Controllers\Admin;

use Illuminate\Http\Requests;
use PathoTrack\Http\Controllers\BasePatientController;

use Request;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PatientController extends BasePatientController
{
    public function index()
    {
        $errors = [];
        $patients = collect([]);
        $inputs = Input::get();

        $patients = BasePatientController::getPatients($inputs);
        BasePatientController::getPatientsData($patients);

        return Response::json(array(
            'errors' => $errors,
            'patients' => $patients,
            'meta' => array(
                'total_pages' => BasePatientController::$total_pages
            )
        ), empty($errors) ? 200 : 400);
    }
}
