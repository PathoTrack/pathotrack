import Ember from 'ember';
import ApplicationRouteMixin from 'simple-auth/mixins/application-route-mixin';
import config from '../config/environment';

export default Ember.Route.extend(ApplicationRouteMixin, {
    model: function() {
        return this.store.all('authenticated-user');
    },
    actions: {
        // Authetication
        sessionAuthenticationFailed: function(error) {
            this.controllerFor(config['simple-auth'].authenticationRoute).set('errorMessage', error.error_description);
        },
        sessionInvalidationSucceeded: function() {
            this.transitionTo(config['simple-auth'].authenticationRoute);
        },
        invalidateSession: function() {
            var authenticatedUser = this.store.all('authenticated-user').get('firstObject');
            authenticatedUser.deleteRecord();
            authenticatedUser.save();
            this._super('invalidateSession');
        }
    }
});
