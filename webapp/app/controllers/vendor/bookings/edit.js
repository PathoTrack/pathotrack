import BaseBooking from './base-booking';

export default BaseBooking.extend({
    actions: {
        save: function() {
            var _this = this,
                booking = this.get('model.booking');

            if (booking.get('isValid')) {
                // Set patients data on booking model 
                booking.save().then(function() {
                    _this.transitionToRoute('vendor.bookings');
                }, function(errors) {
                    _this.notify.alert(errors.responseJSON.errors.get('firstObject.title'));
                });
            }
            return false;
        },
        cancel: function() {
            this.transitionToRoute('vendor.bookings');
            return false;
        }
    }
});