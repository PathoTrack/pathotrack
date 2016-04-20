import Ember from 'ember';
import LoginControllerMixin from 'simple-auth/mixins/login-controller-mixin';
import config from '../config/environment';

export default Ember.Controller.extend(LoginControllerMixin, {
  authenticator: 'simple-auth-authenticator:oauth2-password-grant',
  host: config.APP.API_HOST,
  
  forgotPasswordURL: function() {
    return this.get('host') + '/password/email';
  }.property('host'),
  
  actions: {
    authenticate: function() {
      var _this = this;
      this.set('isLoading', true);
      this._super().then(function() {
        _this.set('isLoading', false);
      }, function() {
        _this.set('isLoading', false);
      });
    }
  }
});
