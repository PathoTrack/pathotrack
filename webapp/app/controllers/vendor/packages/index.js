import Ember from 'ember';
import config from '../../../config/environment';

export default Ember.Controller.extend({
    actions: {
        delete: function(pack) {
            pack.deleteRecord();
            pack.save();
            return false;
        }
    }
});
