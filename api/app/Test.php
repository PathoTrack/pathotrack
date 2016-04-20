<?php

namespace PathoTrack;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = ['name', 'description', 'price', 'is_half_day_fasting_applicable', 'special_instructions', 'number_of_visits_required', 'is_profile_test'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tests';
}
