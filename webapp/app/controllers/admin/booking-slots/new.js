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
                _this.notify.alert('Please make the discount less than or equal to 100');
            }
            return false;
        },
        cancel: function() {
            this.get('model.bookingSlot').deleteRecord();
            this.transitionToRoute('admin.booking-slots');
            return false;
        }
    }
});
