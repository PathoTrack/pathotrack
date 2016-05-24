import Ember from 'ember';

export default Ember.Controller.extend({
    actions: {
        save: function() {
            var _this = this;
            var vendor = this.get('model.vendor');

            if (vendor.get('isValid')) {
                vendor.save().then(function() {
                    _this.transitionToRoute('admin.vendors');
                });
            } else {
                _this.notify.alert('Please provide all the necessary information!');
            }
            return false;
        },
        cancel: function() {
            this.get('model.vendor').deleteRecord();
            this.transitionToRoute('admin.vendors');
            return false;
        }
    }
});