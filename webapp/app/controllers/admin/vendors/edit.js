import Ember from 'ember';
import config from '../../../config/environment';

export default Ember.Controller.extend({
    actions: {
        save: function() {
            var _this = this;
            var vendor = this.get('model.vendor');
            vendor.save().then(function() {
                _this.transitionToRoute('admin.vendors');
            });
            return false;
        },
        cancel: function() {
            this.transitionToRoute('admin.vendors');
            return false;
        }
    }
});