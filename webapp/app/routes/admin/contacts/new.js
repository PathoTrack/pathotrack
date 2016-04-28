import Ember from 'ember';

export default Ember.Route.extend({
    model: function() {
        return Ember.RSVP.hash({
            contact: this.store.createRecord('contact'),
            vendors: this.store.find('vendor')
        });
    }
});
