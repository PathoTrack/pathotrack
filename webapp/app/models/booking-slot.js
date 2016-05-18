import DS from 'ember-data';
import BaseModel from './base-model';

export default BaseModel.extend({
	day: DS.attr('string'),
    start_time: DS.attr('number'),
	end_time: DS.attr('number'),
	is_active: DS.attr('boolean'),

    // Validations
    validations: {
        day: { 
        	presence: true
        },
        start_time: { 
            presence: true
        },
        is_active: { 
            presence: true
        }
    }
});