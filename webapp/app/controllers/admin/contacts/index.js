import Ember from 'ember';
import config from '../../../config/environment';

export default Ember.Controller.extend({
    actions: {
        delete: function(contact) {
            contact.deleteRecord();
            contact.save();
            return false;
        }
    }
});
