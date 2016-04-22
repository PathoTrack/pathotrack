import DS from 'ember-data';
import User from './user';

export default User.extend({

	roles: DS.hasMany('roles', { inverse : 'authenticatedUser' }),
	
    // Computed
    isStaff: function() {
        return this.get('roles').isAny('isStaff');
    }.property('roles'),
    
    isVendor: function() {
        return this.get('roles').isAny('isVendor');
    }.property('roles')
    
});
