<?php

use PathoTrack\Email;
use PathoTrack\Connection;
use PathoTrack\User;
use PathoTrack\Company;
use PathoTrack\VisaRequest;

use Illuminate\Support\Facades\Auth;

function sendVerificationMail($user) {

    if (!$user->activation_code) {
        $user->activation_code = bin2hex(openssl_random_pseudo_bytes(16));
        $user->update();
    }

    // Data required in email
    $email_verification_data = array (
        'user_name'         => $user->name,
        'activation_code'   => $user->activation_code
    );

    // Send email verification mail
    $status = Mail::send('emails.email-verification', ['datas' => $email_verification_data], function($message) use ($user) {
        $message->setSender('info@visa.guide', 'Visa Guide');
        $message->to($user->email, $user->name);
        $message->subject('Verify your email address');
    });

    $email = new Email();
    $email->email_type = 'EMAIL_VERIFICATION';
    $email->to_email = $user->email;
    $email->user_id = $user->id;
    $email->save();

    return $email;
}

function sendAgentServiceRequestedMail($company_id, $visa_request_id, $connection, $user) {
    $company = Company::find($company_id);
    $visa_request = VisaRequest::find($visa_request_id);

    // Visa Information
    $from_country = $visa_request->fromCountry->name;
    $to_country = $visa_request->toCountry->name;
    $purpose = $visa_request->purpose->name;

    // User Information
    $user_name = $user->name;
    $user_email = $user->email;
    $user_phone = $user->phone_number;

    // Agent Information
    $company_name = $company->name;
    $company_email = $company->user->email;

    // Connection Info
    $message_from_user = $connection->message;

    // Data required in email
    $email_verification_data = array (
        'from_country'          => $from_country,
        'to_country'            => $to_country,
        'purpose'               => $purpose,
        'user_name'             => $user_name,
        'user_email'            => $user_email,
        'user_phone'            => $user_phone,
        'message_from_user'     => $message_from_user
    );

    // Send email verification mail

    if ($connection->is_resend == TRUE) {
        Mail::send('emails.agent-service-request', ['datas' => $email_verification_data], function($message) use ($user, $company_name, $company_email) {
            $message->setSender('request@visa.guide', 'Visa Guide');
            $message->to($company_email, $company_name);
            $message->replyTo($user->email, $user->name);
            $message->bcc('request@visa.guide', 'Visa Guide');
            $message->subject('Your service is requested');
        });
    } else {
        Mail::send('emails.agent-service-request', ['datas' => $email_verification_data], function($message) use ($user, $company_name, $company_email) {
            $message->setSender('request@visa.guide', 'Visa Guide');
            $message->to($company_email, $company_name);
            $message->replyTo($user->email, $user->name);
            $message->bcc('request@visa.guide', 'Visa Guide');
            $message->subject('Your service is requested');
        });
    }

    $email = new Email();
    $email->email_type = 'AGENT_SERVICE_REQUEST_MAIL';
    $email->to_email = $company_email;
    $email->user_id = $user->id;
    $email->save();
}

function sendPartnerServiceRequestedMail($visa_request_id, $connection, $user) {
    $visa_request = VisaRequest::find($visa_request_id);

    // Visa Information
    $from_country = $visa_request->fromCountry->name;
    $to_country = $visa_request->toCountry->name;
    $purpose = $visa_request->purpose->name;

    // User Information
    $user_name = $user->name;
    $user_email = $user->email;
    $user_phone = $user->phone_number;

    // Connection Info
    $message_from_user = $connection->message;

    // Data required in email
    $email_verification_data = array (
        'from_country'          => $from_country,
        'to_country'            => $to_country,
        'purpose'               => $purpose,
        'user_name'             => $user_name,
        'user_email'            => $user_email,
        'user_phone'            => $user_phone,
        'message_from_user'     => $message_from_user
    );

    // Send email verification mail

    Mail::send('emails.agent-service-request', ['datas' => $email_verification_data], function($message) use ($user) {
        $message->setSender('request@visa.guide', 'Visa Guide');
        $message->to('request@visa.guide', 'Visa Guide');
        $message->subject('Partner service is requested');
    });

    $email = new Email();
    $email->email_type = 'AGENT_SERVICE_REQUEST_MAIL';
    $email->to_email = 'request@visa.guide';
    $email->user_id = $user->id;
    $email->save();
}