<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'number'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contacts';
}
