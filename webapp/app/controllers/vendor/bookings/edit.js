import BaseBooking from './base-booking';

export default BaseBooking.extend({
    actions: {
        save: function() {
            var _this = this,
                booking = this.get('model.booking');
                
            booking.save().then(function() {
                _this.transitionToRoute('vendor.bookings');
            });
            return false;
        },
        cancel: function() {
            this.transitionToRoute('vendor.bookings');
            return false;
        }
    }
});