import Ember from 'ember';
import config from '../../../config/environment';

export default Ember.Controller.extend({
    actions: {
        save: function() {
            var _this = this;
            var test = this.get('model.test');
            test.save().then(function() {
                _this.transitionToRoute('staff.tests');
            });
            return false;
        },
        cancel: function() {
            this.transitionToRoute('staff.tests');
            return false;
        }
    }
});