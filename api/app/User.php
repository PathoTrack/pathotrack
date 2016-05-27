<?php

namespace PathoTrack;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use PathoTrack\Address;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'phone_number', 'dob', 'sex'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function roles() {
        return $this->belongsToMany('PathoTrack\Role', 'role_user');
    }

    public function address() {
        return $this->belongsTo('PathoTrack\Address');
    }

    public function hasAtleastOneRole() {
        if (sizeof($this->roles) > 0) {
            return true;
        }
        return false;
    } 

    public function isVendor() {
        return $this->hasRole('vendor');
    }

    public function isStaff() {
        return $this->hasRole('staff');
    }

    public function isAdmin() {
        return $this->hasRole('admin');
    }

    public static function getExistingUser($email) {
        return User::where('email', '=', $email)->first();
    }

    public static function storeUser($input, $role_id = null) {
        
        $address_id = null;
        $existing_user = User::where('email', '=', $input['email'])->first();

        if (sizeof($existing_user) > 0) {
            $existing_user->update(array_merge((array)$existing_user, (array)$input));
            $user = $existing_user;

            if ($user->address_id) {
                $address = Address::find($user->address_id);
                $address->update(array_merge((array)$address, (array)$input['address_data']));
            } else {
                if (isset($input['address_data'])) {
                    $user->address_id = Address::storeAddress($input['address_data'])->id;
                    $user->save();
                }
            }
        } else {
            $user = new User($input);
            if (isset($new_user['password'])) {
                $user->password = Hash::make($new_user['password']);
            }
            if (isset($input['address_data'])) {
                $address_id = Address::storeAddress($input['address_data'])->id;
            }
            $user->address_id = $address_id;
            $user->save();
        }

        if ($role_id && !$user->hasRole('patient')) {
            $user->attachRole($role_id);
        }

        return $user;
    }

    
    /**
     * Detach all roles from a user
     * 
     * @return object
     */
    public function detachAllRoles()
    {
        DB::table('role_user')->where('user_id', $this->id)->delete();

        return $this;
    }

}
