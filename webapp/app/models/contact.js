import DS from 'ember-data';
import BaseModel from './base-model';

export default BaseModel.extend({
	name: DS.attr('string'),
	number: DS.attr('string'),
	vendor_id: DS.attr('number'),

	// Relationships
    vendor: DS.belongsTo('vendor', { inverse : 'contacts' }),

});