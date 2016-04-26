import DS from 'ember-data';
import BaseModel from './base-model';

export default BaseModel.extend({
    description: DS.attr('string'),
    display_name: DS.attr('string'),
    name: DS.attr('string'),

    // Relationships
    users: DS.hasMany('user', { inverse: 'roles' }),
    authenticatedUser: DS.belongsTo('authenticated-user', { inverse: 'roles' }),

    // Computed
    isStaff: function() {
        return this.get('name') === 'staff';
    }.property('name'),

    isAdmin: function() {
        return this.get('name') === 'admin';
    }.property('name'),

    isVendor: function() {
        return this.get('name') === 'vendor';
    }.property('name')
    
});
