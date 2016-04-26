import Ember from 'ember';
import UnauthenticatedRouteMixin from 'simple-auth/mixins/unauthenticated-route-mixin';
import BaseModel from '../models/base-model';

export default Ember.Route.extend(UnauthenticatedRouteMixin, {
	beforeModel: function(transition) {
        this._super(transition);
        BaseModel.reopenClass({
            namespace: 'open' 
        });
    }
});
