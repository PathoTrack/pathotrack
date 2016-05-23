import BaseBooking from './base-booking';

export default BaseBooking.extend({
    actions: {
        save: function() {
            var _this = this,
                booking = this.get('model.booking');
                
            booking.save().then(function() {
                _this.transitionToRoute('staff.bookings');
            }, function(errors) {
                _this.notify.alert(errors.responseJSON.errors.get('firstObject.title'));
            });
            return false;
        },
        cancel: function() {
            this.get('model.booking').deleteRecord();
            this.transitionToRoute('staff.bookings');
            return false;
        }
    }
});