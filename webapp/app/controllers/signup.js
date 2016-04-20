import Ember from 'ember';
import LoginControllerMixin from 'simple-auth/mixins/login-controller-mixin';

export default Ember.Controller.extend(LoginControllerMixin, {
  authenticator: 'simple-auth-authenticator:oauth2-password-grant',

  // Computed
  identification: function() {
    return this.get('model.email');
  }.property('model.email'),

  password: function() {
    return this.get('model.password');
  }.property('model.password'),

  actions: {
    save: function() {
      var _this = this;
      this.get('model').save().then(function() {
        _this.send('authenticate');
      }, function(error) {
        _this.set('errorMessage', error.title);
      });
    },
    authenticate: function() {
      var _this = this;
      this.set('isLoading', true);
      this._super().then(function() {
        _this.set('isLoading', false);
        _this.notify.success('Welcome to prsntly, we have mailed you a link to verify your email address.', {
          closeAfter: 5000
        });
      }, function() {
        _this.set('isLoading', false);
      });
    }
  }
});
