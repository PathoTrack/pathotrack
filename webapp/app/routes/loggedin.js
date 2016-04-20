import Ember from 'ember';
import AuthenticatedRouteMixin from 'simple-auth/mixins/authenticated-route-mixin';

export default Ember.Route.extend(AuthenticatedRouteMixin, {
    model: function() {
        return this.store.find('authenticated-user');
    },
    afterModel: function(model) {
        if (model.get('firstObject.roles')) {
            if (model.get('firstObject.roles').isAny('isStaff')) {
                this.transitionTo('staff.dashboard');
            } else if (model.get('firstObject.roles').isAny('isVendor')) {
                this.transitionTo('vedor.dashboard');
            }
        }
    }
});
