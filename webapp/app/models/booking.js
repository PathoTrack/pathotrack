import DS from 'ember-data';
import BaseModel from './base-model';

export default BaseModel.extend({
    booking_slot_id: DS.attr('number'),
    user_id: DS.attr('number'),
	vendor_id: DS.attr('number'),
    date: DS.attr('string'),
    test_ids: DS.attr(''),
    package_ids: DS.attr(''),

    // Relationships
    booking_slot: DS.belongsTo('booking-slot'),
    vendor: DS.belongsTo('vendor'),
    user: DS.belongsTo('user'),

    // Validations
    validations: {
        booking_slot_id: { 
        	presence: true
        },
        user_id: { 
            presence: true
        },
        date: { 
            presence: true
        },
        vendor_id: {
            Vendor_id: {
                watchArray : [
                    'namespace'
                ] 
            }
        }
    }
});