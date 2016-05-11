import Ember from 'ember';

export default Ember.Controller.extend({
    actions: {
        save: function() {
            var _this = this;
            var pack = this.get('model.pack');
            pack.save().then(function() {
                _this.transitionToRoute('staff.packages');
            });
            return false;
        },
        cancel: function() {
            this.get('model.pack').deleteRecord();
            this.transitionToRoute('staff.packages');
            return false;
        }
    }
});
