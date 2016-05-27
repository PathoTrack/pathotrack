import DS from 'ember-data';
import BaseModel from './base-model';

export default BaseModel.extend({
    address_line_1: DS.attr('string'),
    address_line_2: DS.attr('string'),
    pincode: DS.attr('number'),
    special_instructions: DS.attr('string'),
    suburb: DS.attr('string'),
    city: DS.attr('string'),
    latitude: DS.attr('string'),
    longitude: DS.attr('string')
});