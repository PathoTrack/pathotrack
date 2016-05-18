import Ember from 'ember';

export default Ember.Route.extend({
    model: function() {
        return Ember.RSVP.hash({
            bookingSlot: this.store.createRecord('booking-slot')
        });
    }
});
