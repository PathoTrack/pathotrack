import Ember from 'ember';

export default Ember.Controller.extend({
    actions: {
        delete: function(vendor) {
            var _this = this;
            
            vendor.deleteRecord();
            vendor.save().then(function() {
                _this.send('refreshModel');
            });
            return false;
        }
    }
});
