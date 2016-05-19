import Ember from 'ember';

export default Ember.Route.extend({
    model: function(params) {
    	return Ember.RSVP.hash({
            booking: this.store.fetch('booking', params.booking_id),
            bookingSlots: this.store.find('booking-slot'),
            users: this.store.find('user'),
            tests: this.store.find('test'),
            packages: this.store.find('package')
        });
    }
});