import Ember from 'ember';
import InfinityRoute from 'ember-infinity/mixins/route';

export default Ember.Route.extend(InfinityRoute, {
	queryParams: {
        search: {
            refreshModel: true
        }
    },
    model: function(params) {
        return this.infinityModel('package', Ember.$.extend({ 
            perPage: 10,
        }, params));
    }
});
