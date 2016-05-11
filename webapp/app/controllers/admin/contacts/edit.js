import Ember from 'ember';

export default Ember.Controller.extend({
    actions: {
        save: function() {
            var _this = this;
            var contact = this.get('model.contact');
            contact.save().then(function() {
                _this.transitionToRoute('admin.contacts');
            });
            return false;
        },
        cancel: function() {
            this.transitionToRoute('admin.contacts');
            return false;
        }
    }
});