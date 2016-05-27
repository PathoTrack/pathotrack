import Ember from 'ember';

export default Ember.Route.extend({
    model: function() {
        return Ember.RSVP.hash({
            booking: this.store.createRecord('booking'),
            bookingSlots: this.store.find('booking-slot'),
            tests: this.store.find('test'),
            packages: this.store.find('package'),
            patient: this.store.createRecord('patient'),
            address: this.store.createRecord('address')
        });
    },
    afterModel: function(model) {
    	model.patient.set('sex', 'Male');
    }
});