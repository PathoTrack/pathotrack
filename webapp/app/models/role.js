import DS from 'ember-data';
import BaseModel from './base-model';

export default BaseModel.extend({
    description: DS.attr('string'),
    display_name: DS.attr('string'),
    name: DS.attr('string'),

    // Computed
    isStaff: function() {
        return this.get('name') === 'staff';
    }.property('name'),

    isVendor: function() {
        return this.get('name') === 'vendor';
    }.property('name')
    
});
