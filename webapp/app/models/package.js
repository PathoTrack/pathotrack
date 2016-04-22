import DS from 'ember-data';
import BaseModel from './base-model';

export default BaseModel.extend({
	name: DS.attr('string'),
	description: DS.attr('string'),
	price: DS.attr('number'),
	discount: DS.attr('number'),
	is_half_day_fasting_applicable: DS.attr('boolean'),
	special_instructions: DS.attr('string'),
	number_of_visits_required: DS.attr('number'),
	is_profile_test: DS.attr('boolean'),
});
