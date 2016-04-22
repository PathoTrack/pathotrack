import Ember from 'ember';
import config from './config/environment';

var Router = Ember.Router.extend({
  location: config.locationType
});

Router.map(function() {

  	this.route('staff', function() {

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
    	this.route('packages');
	  	this.route('tests');
    });
});

export default Router;
