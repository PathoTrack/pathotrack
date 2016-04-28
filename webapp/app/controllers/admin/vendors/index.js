import Ember from 'ember';
import config from '../../../config/environment';

export default Ember.Controller.extend({
	queryParams: ['search'],
    search: null,
    searchField: Ember.computed.oneWay('search'),

    actions: {
        delete: function(vendor) {
            var _this = this;
            
            vendor.deleteRecord();
            vendor.save().then(function() {
                _this.send('refreshModel');
            });
            return false;
        },
        search: function() {
          this.set('search', this.get('searchField'));
        }
    }
});
