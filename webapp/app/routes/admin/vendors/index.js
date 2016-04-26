import Ember from 'ember';
import InfinityRoute from 'ember-infinity/mixins/route';

export default Ember.Route.extend(InfinityRoute, {
    model: function(params) {
        return this.infinityModel('vendor', Ember.$.extend({ 
            perPage: 10,
        }, params));
    }
});
