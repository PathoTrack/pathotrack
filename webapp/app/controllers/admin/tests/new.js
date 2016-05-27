import Ember from 'ember';

export default Ember.Controller.extend({
    actions: {
        save: function() {
            var _this = this;
            var test = this.get('model.test');
            test.save().then(function() {
                _this.transitionToRoute('admin.tests');
            });
            return false;
        },
        cancel: function() {
            this.get('model.test').deleteRecord();
            this.transitionToRoute('admin.tests');
            return false;
        }
    }
});
