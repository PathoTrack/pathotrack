import Ember from 'ember';
import config from './config/environment';

Ember.Route.reopen({
  activate: function() {
    var cssClass = this.toCssClass();
    // you probably don't need the application class
    // to be added to the body
    if (cssClass !== 'application') {
      Ember.$('body').addClass(cssClass);
      Ember.$('html').addClass(cssClass + '-html');
    }
    if (!('ontouchstart' in document.documentElement)) {
      Ember.$('body').addClass('no-touch');
    }
  },
  deactivate: function() {
    Ember.$('body').removeClass(this.toCssClass());
  },
  toCssClass: function() {
    return this.routeName.replace(/\./g, '-').dasherize();
  }
});

var Router = Ember.Router.extend({
  location: config.locationType
});

Router.map(function() {

  this.route('staff', function() {
    this.route('dashboard');

    this.route('packages', function() {
      this.route('new');
      this.route('edit', { path: ':package_id/edit' });
    });

    this.route('tests', function() {
      this.route('new');
      this.route('edit', { path: ':test_id/edit' });
    });
  });

  this.route('vendor', function() {
    this.route('dashboard');

    this.route('packages');
    this.route('tests');
  });

  // Auhtentication
  this.route('login');
  this.route('signup');
  this.route('loggedin');
  this.route('reset-password');
});

export default Router;