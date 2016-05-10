/* jshint node: true */

module.exports = function(environment) {
  var ENV = {
    modulePrefix: 'webapp',
    environment: environment,
    // baseURL: '/',
    locationType: 'hash',
    EmberENV: {
      FEATURES: {
        // Here you can enable experimental features on an ember canary build
        // e.g. 'with-controller': true
      }
    },

    APP: {
      // Here you can pass flags/options to your application instance
      // when it is created
      API_HOST: 'https://api.pathotrack.com',
      WEBAPP_HOST: 'https://web.pathotrack.com',
      API_CLIENT_ID: 'zgisIxWAehLZ4mvr',
      API_CLIENT_SECRET: 'fGXnEsBQFqxNgxIIpWqNUiBw7VdDv0oK',
      ENV: environment || 'local',
    },
    contentSecurityPolicy: {
      'default-src': "'none'",
      'script-src': "'self' 'unsafe-eval' 'unsafe-inline' https://www.google-analytics.com https://*.errorception.com", // Allow scripts from https://cdn.mxpnl.com
      'font-src': "'self' https://fonts.gstatic.com", // Allow fonts to be loaded from https://fonts.gstatic.com
      'connect-src': "'self' https://api.pathotrack.com https://api-local.pathotrack.com https://api.trello.com https://*.errorception.com https://api.aylien.com ws://localhost:35729 ws://0.0.0.0:35729", // Allow data (ajax/websocket) from api.mixpanel.com and custom-api.local
      'img-src': "'self' 'unsafe-inline' *",
      'style-src': "'self' 'unsafe-inline' https://fonts.googleapis.com", // Allow inline styles and loaded CSS from https://fonts.googleapis.com 
      'media-src': "'self'"
    },
    'simple-auth': {
      authenticationRoute: 'index',
      routeAfterAuthentication: 'loggedin',
      routeIfAlreadyAuthenticated: 'loggedin',
      authorizer: 'simple-auth-authorizer:oauth2-bearer',
      crossOriginWhitelist: ['https://api.pathotrack.com']
    },
    'simple-auth-oauth2': {
      serverTokenEndpoint: 'https://api.pathotrack.com/oauth/access_token'
    },
    googleAnalyticsId: 'UA-12823615-39'
  };

  if(environment === 'local') {
      ENV.APP.LOG_RESOLVER = true;
      /*ENV.APP.LOG_ACTIVE_GENERATION = true;
      ENV.APP.LOG_TRANSITIONS = true;
      ENV.APP.LOG_TRANSITIONS_INTERNAL = true;
      ENV.APP.LOG_VIEW_LOOKUPS = true;*/

      ENV.APP.API_HOST = 'https://api-local.pathotrack.com';
      ENV.APP.WEBAPP_HOST = 'https://localhost:4200/';
      ENV['simple-auth'].crossOriginWhitelist = ['https://api-local.pathotrack.com'];
      ENV['simple-auth-oauth2'].serverTokenEndpoint = ['https://api-local.pathotrack.com/oauth/access_token'];
  }

  if (environment === 'development') {
      ENV.APP.LOG_RESOLVER = true;

      ENV.APP.API_HOST = 'https://api-dev.visa-guide';
      ENV.APP.WEBAPP_HOST = 'https://web-dev.visa-guide';
  }

  if (environment === 'test-local') {
      // Testem prefers this...
      ENV.baseURL = '/';
      ENV.locationType = 'none';
      ENV.APP.rootElement = '#ember-testing';

      ENV.APP.API_HOST = 'https://api.visa.dev';
  }

  return ENV;
};
