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

  this.route('admin', function() {
    this.route('dashboard');

    this.route('vendors', function() {
      this.route('new');
      this.route('edit', { path: ':vendor_id/edit' });
    });

    this.route('contacts', function() {
      this.route('new');
      this.route('edit', { path: ':contact_id/edit' });
    });

    this.route('booking-slots', function() {
      this.route('new');
      this.route('edit', { path: ':booking_slot_id/edit' });
    });
    
  });

  // Auhtentication
  this.route('login');
  this.route('signup');
  this.route('loggedin');
  this.route('reset-password');
});

export default Router;