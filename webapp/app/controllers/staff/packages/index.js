import Ember from 'ember';
import config from '../../../config/environment';

export default Ember.Controller.extend({
	queryParams: ['search'],
    search: null,
    searchField: Ember.computed.oneWay('search'),
    
    actions: {
        delete: function(pack) {
            pack.deleteRecord();
            pack.save();
            return false;
        },
        search: function() {
          this.set('search', this.get('searchField'));
        }
    }
});
