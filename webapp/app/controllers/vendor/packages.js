import Ember from 'ember';
import config from '../../config/environment';

export default Ember.Controller.extend({
	queryParams: ['search'],
    search: null,
    searchField: Ember.computed.oneWay('search'),
    
    actions: {
        search: function() {
          this.set('search', this.get('searchField'));
        }
    }
});
