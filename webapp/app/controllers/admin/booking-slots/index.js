import Ember from 'ember';

export default Ember.Controller.extend({

    slotsForMonday: function() {
        return this.get('model').filterBy('day', 'Monday').sortBy('start_time', 'asc');
    }.property('model'),

    slotsForTuesday: function() {
        return this.get('model').filterBy('day', 'Tuesday').sortBy('start_time', 'asc');
    }.property('model'),

    slotsForWednesday: function() {
        return this.get('model').filterBy('day', 'Wednesday').sortBy('start_time', 'asc');
    }.property('model'),

    slotsForThursday: function() {
        return this.get('model').filterBy('day', 'Thursday').sortBy('start_time', 'asc');
    }.property('model'),

    slotsForFriday: function() {
        return this.get('model').filterBy('day', 'Friday').sortBy('start_time', 'asc');
    }.property('model'),

    slotsForSaturday: function() {
        return this.get('model').filterBy('day', 'Saturday').sortBy('start_time', 'asc');
    }.property('model'),

    slotsForSunday: function() {
        return this.get('model').filterBy('day', 'Sunday').sortBy('start_time', 'asc');
    }.property('model'),

    actions: {
        delete: function(slot) {
            var _this = this;
            
            slot.deleteRecord();
            slot.save().then(function() {
                _this.send('refreshModel');
            });
            return false;
        }
    }
});
