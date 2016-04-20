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
      API_HOST: 'http://api.visa.guide',
      WEBAPP_HOST: 'http://web.visa.guide',
      ENV: environment || 'local',
    },
    contentSecurityPolicy: {
      'default-src': "'none'",
      'script-src': "'self' 'unsafe-eval' 'unsafe-inline' http://www.google-analytics.com http://*.errorception.com", // Allow scripts from https://cdn.mxpnl.com
      'font-src': "'self' http://fonts.gstatic.com", // Allow fonts to be loaded from http://fonts.gstatic.com
      'connect-src': "'self' http://api.pathotrack.dev http://api.visa.guide https://api.trello.com http://*.errorception.com https://api.aylien.com ws://localhost:35729 ws://0.0.0.0:35729", // Allow data (ajax/websocket) from api.mixpanel.com and custom-api.local
      'img-src': "'self' 'unsafe-inline' *",
      'style-src': "'self' 'unsafe-inline' http://fonts.googleapis.com", // Allow inline styles and loaded CSS from http://fonts.googleapis.com 
      'media-src': "'self'"
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
      ENV.APP.WEBAPP_HOST = 'http://localhost:4200/';
  }

  if (environment === 'development') {
      ENV.APP.LOG_RESOLVER = true;

      ENV.APP.API_HOST = 'http://api-dev.visa-guide';
      ENV.APP.WEBAPP_HOST = 'http://web-dev.visa-guide';
  }

  if (environment === 'test-local') {
      // Testem prefers this...
      ENV.baseURL = '/';
      ENV.locationType = 'none';
      ENV.APP.rootElement = '#ember-testing';

      ENV.APP.API_HOST = 'http://api.visa.dev';
  }

  return ENV;
};
