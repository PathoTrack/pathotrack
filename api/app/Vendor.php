<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['name', 'discount', 'service_fee', 'minimum_amount_for_free_visit', 'single_visit_fee', 'double_visit_fee', 'email'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vendors';

    public function contacts() {
        return $this->belongsToMany('PathoTrack\Contact');
    }
}