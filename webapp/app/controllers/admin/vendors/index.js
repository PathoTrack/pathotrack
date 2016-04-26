import Ember from 'ember';
import config from '../../../config/environment';

export default Ember.Controller.extend({
    actions: {
        delete: function(vendor) {
            vendor.deleteRecord();
            vendor.save();
            return false;
        }
    }
});
