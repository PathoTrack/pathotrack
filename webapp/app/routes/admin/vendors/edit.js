import Ember from 'ember';

export default Ember.Route.extend({
    model: function(params) {
    	return Ember.RSVP.hash({
            vendor: this.store.find('vendor', params.vendor_id)
        });
    }
});
