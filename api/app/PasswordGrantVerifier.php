<?php 

namespace PathoTrack;

use Illuminate\Support\Facades\Auth;

class PasswordGrantVerifier
{
  public function verify($username, $password)
  {
      if( Auth::validate([
                    'email'    => $username,
                    'password' => $password,
                ])) {
                        $user = User::where('email', $username)->first();
                        return $user->id;
                  }
      
      return false;
  }
}
