<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'number', 'vendor_id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    public function vendor() {
        return $this->belongsTo('PathoTrack\Vendor');
    }
}
