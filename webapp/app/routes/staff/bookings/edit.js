import Ember from 'ember';

export default Ember.Route.extend({
    model: function(params) {
    	return Ember.RSVP.hash({
            booking: this.store.fetch('booking', params.booking_id),
            bookingSlots: this.store.find('booking-slot'),
            vendors: this.store.find('vendor'),
            tests: this.store.find('test'),
            packages: this.store.find('package'),
            booking_patients: this.store.find('booking-patient', {
                booking_id: params.booking_id
            }),
        });
    }
});