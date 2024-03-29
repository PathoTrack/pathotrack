import Ember from 'ember';

export default Ember.Route.extend({
    model: function() {
        return Ember.RSVP.hash({
            vendor: this.store.createRecord('vendor')
        });
    }
});
