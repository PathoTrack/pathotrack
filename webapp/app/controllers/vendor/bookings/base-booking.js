import Ember from 'ember';

export default Ember.Controller.extend({

    bookingSlots: null,

    dateChanged: function() {
        if (this.get('model.booking.date')) {

            if (!!this.get('model.booking.booking_slot_id') && this.get('model.booking.isDirty')) {
                this.set('bookingSlots', null);
                this.get('model.booking').set('booking_slot_id', null);
            }

            var day = moment(this.get('model.booking.date')).format('dddd');
            this.set('bookingSlots', this.get('model.bookingSlots').filterBy('day', day));

            this.get('bookingSlots').forEach(function(slot) {
                slot.set('slot_time', slot.get('start_time') + '-' + slot.get('end_time'));
            });
        }
    }.observes('model.booking.date')
});