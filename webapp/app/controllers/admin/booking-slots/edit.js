import Ember from 'ember';

export default Ember.Controller.extend({
    actions: {
        save: function() {
            var _this = this;
            var bookingSlot = this.get('model.bookingSlot');

            if (bookingSlot.get('isValid')) {
                bookingSlot.save().then(function() {
                    _this.transitionToRoute('admin.booking-slots');
                });
            } else {
                _this.notify.alert('Please provide all the necessary information!');
            }
            return false;
        },
        cancel: function() {
            this.transitionToRoute('admin.booking-slots');
            return false;
        }
    }
});