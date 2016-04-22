import Ember from 'ember';
import DS from 'ember-data';
import config from '../config/environment';
import BaseModel from '../models/base-model';

export default DS.RESTAdapter.extend({
    host: config.APP.API_HOST,
    namespace: 'v1',
    pathForType: function(type) {
        var camelized = Ember.String.camelize(type);
        return [(BaseModel.namespace || 'open'), Ember.String.pluralize(camelized)].join('/');
    }
});
