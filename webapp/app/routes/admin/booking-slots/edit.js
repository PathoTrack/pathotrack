import Ember from 'ember';
import DAYS from '../../../constants/days';

export default Ember.Route.extend({
	beforeModel: function() {
		this.store.pushPayload('day', {
            'days' : DAYS
        });
	},
    model: function(params) {
    	return Ember.RSVP.hash({
            bookingSlot: this.store.fetch('booking-slot', params.booking_slot_id),
            days: this.store.all('day')
        });
    }
});
