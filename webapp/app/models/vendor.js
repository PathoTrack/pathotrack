import DS from 'ember-data';
import BaseModel from './base-model';

export default BaseModel.extend({
	name: DS.attr('string'),
	discount: DS.attr('number'),
	service_fee: DS.attr('number'),
	minimum_amount_for_free_visit: DS.attr('number'),
	single_visit_fee: DS.attr('number'),
	double_visit_fee: DS.attr('number'),
	email: DS.attr('string'),
    password: DS.attr('string'),
	key: DS.attr('string'),

	// Relationships
    contacts: DS.hasMany('contact', { inverse : 'vendor' }),
    user: DS.belongsTo('user', { inverse : 'vendor' }),

    // Validations
    validations: {
        discount: { 
        	numericality: { 
        		lessThanOrEqualTo : 100 
        	}
        },
        service_fee: { 
            numericality: { 
                lessThanOrEqualTo : 100 
            }
        }
    }

});