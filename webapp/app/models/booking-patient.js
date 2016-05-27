import DS from 'ember-data';
import BaseModel from './base-model';

export default BaseModel.extend({
	booking_id: DS.attr('number'),
	patient_id: DS.attr('number'),

	// Relationships
    booking: DS.hasMany('booking'),
    patient: DS.belongsTo('user'),

});