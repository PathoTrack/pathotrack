import Ember from 'ember';
import BaseModel from '../models/base-model';
import AuthenticatedRouteMixin from 'simple-auth/mixins/authenticated-route-mixin';

export default Ember.Route.extend(AuthenticatedRouteMixin, {
    beforeModel: function(transition) {
        BaseModel.reopenClass({
            namespace: 'vendor' 
        });
    },
    model: function() {
        return this.store.find('authenticated-user');

    }
});