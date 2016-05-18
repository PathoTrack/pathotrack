import DS from 'ember-data';
import BaseModel from './base-model';

export default BaseModel.extend({
    booking_slot_id: DS.attr('number'),
    user_id: DS.attr('number'),
	vendor_id: DS.attr('number'),

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