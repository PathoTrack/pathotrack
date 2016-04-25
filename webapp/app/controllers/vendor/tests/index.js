import Ember from 'ember';
import config from '../../../config/environment';

export default Ember.Controller.extend({
    actions: {
        delete: function(test) {
            test.deleteRecord();
            test.save();
            return false;
        }
    }
});
