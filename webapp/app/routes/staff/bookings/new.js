import Ember from 'ember';

export default Ember.Route.extend({
    model: function() {
        return Ember.RSVP.hash({
            booking: this.store.createRecord('booking'),
            bookingSlots: this.store.find('booking-slot'),
            vendors: this.store.find('vendor'),
            users: this.store.find('user'),
            tests: this.store.find('test'),
            packages: this.store.find('package')
        });
    }
});