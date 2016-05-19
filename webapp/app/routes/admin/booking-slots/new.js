import Ember from 'ember';
import DAYS from '../../../constants/days';

export default Ember.Route.extend({
	beforeModel: function() {
		this.store.pushPayload('day', {
            'days' : DAYS
        });
	},
    model: function() {
        return Ember.RSVP.hash({
            bookingSlot: this.store.createRecord('booking-slot'),
            days: this.store.all('day')
        });
    }
});
