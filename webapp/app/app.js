import Ember from 'ember';
import Resolver from 'ember/resolver';
import loadInitializers from 'ember/load-initializers';
import config from './config/environment';
import OAuth2 from 'simple-auth-oauth2/authenticators/oauth2';

var App;

Ember.MODEL_FACTORY_INJECTIONS = true;

App = Ember.Application.extend({
  modulePrefix: config.modulePrefix,
  podModulePrefix: config.podModulePrefix,
  Resolver: Resolver
});

loadInitializers(App, config.modulePrefix);

// Authentication
OAuth2.reopen({
  makeRequest: function(url, data) {
    data.client_id = config.APP.API_CLIENT_ID;
    data.client_secret = config.APP.API_CLIENT_SECRET;
    return this._super(url, data);
  }
});


export default App;