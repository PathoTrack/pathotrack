<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'description', 'price', 'discount', 'is_half_day_fasting_applicable', 'special_instructions', 'number_of_visits_required'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'packages';
}
