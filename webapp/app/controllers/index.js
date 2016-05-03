import BaseController from './base-controller';
import LoginControllerMixin from 'simple-auth/mixins/login-controller-mixin';
import config from '../config/environment';

export default BaseController.extend(LoginControllerMixin, {
  authenticator: 'simple-auth-authenticator:oauth2-password-grant',
  host: config.APP.API_HOST,

  forgotPasswordURL: function() {
    return this.get('host') + '/password/email';
  }.property('host'),

  identification: function() {
    return this.get('email');
  }.property('email'),

  actions: {
    authenticate: function() {
      var _this = this;
      this.set('isLoading', true);

      if (this.get('identification') && this.get('password')) {
        this._super().then(function() {
          _this.set('isLoading', false);
        }, function(error) {
          _this.notify.alert(error.error_description);
          _this.set('isLoading', false);
        });
      } else {
        this.set('isLoading', false);
        this.notify.alert('Please provide all the informations!');
      }
    }
  }
});
