import Ember from 'ember';

export default Ember.Route.extend({
    model: function(params) {
    	return Ember.RSVP.hash({
            contact: this.store.find('contact', params.contact_id)
        });
    }
});
