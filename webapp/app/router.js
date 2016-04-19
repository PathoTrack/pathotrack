import Ember from 'ember';
import config from './config/environment';

var Router = Ember.Router.extend({
  location: config.locationType
});

Router.map(function() {
	this.route('packages', function() {
    	this.route('new');
    	this.route('show', { path: ':package_id' });
    	this.route('edit', { path: ':package_id/edit' });
  	});
});

export default Router;
