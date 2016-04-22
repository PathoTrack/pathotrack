import DS from 'ember-data';

export default DS.Model.extend({
    name: DS.attr('string'),
    email: DS.attr('string'),
    password: DS.attr('string'),

    // Relationships
    roles: DS.hasMany('role', { inverse : 'users' })
});