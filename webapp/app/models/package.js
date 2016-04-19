import DS from 'ember-data';

export default DS.Model.extend({
	name: DS.attr('string'),
	description: DS.attr('string'),
	price: DS.attr('float'),
	discount: DS.attr('float'),
	is_half_day_fasting_applicable: DS.attr('boolean'),
	special_instructions: DS.attr('text'),
	number_of_visits_required: DS.attr('number'),
	is_profile_test: DS.attr('boolean'),
});
