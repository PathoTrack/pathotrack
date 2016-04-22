import Ember from 'ember';
import BaseModel from '../models/base-model';

export default Ember.Route.extend({
    beforeModel: function(transition) {
        BaseModel.reopenClass({
            namespace: 'staff' 
        });
    }
});
