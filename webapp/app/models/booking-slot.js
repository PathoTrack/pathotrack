import DS from 'ember-data';
import BaseModel from './base-model';

export default BaseModel.extend({
	day: DS.attr('string'),
    start_time: DS.attr('number'),
	end_time: DS.attr('number'),
	is_active: DS.attr('boolean', { defaultValue: true }),
    no_of_booking: DS.attr('number', { defaultValue: 1 }),

    // Validations
    validations: {
        day: { 
        	presence: true
        },
        start_time: { 
            presence: true
        },
        no_of_booking: { 
            presence: true
        }
    }
});