import DS from 'ember-data';
import BaseModel from './base-model';

export default BaseModel.extend({
	name: DS.attr('string'),
	number: DS.attr('string'),
});