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
        inactivate: function(slot) {
            var _this = this;

            if (confirm("This slot won't be accessible anymore, are you sure you want to deactivate this slot?")) {
                slot.set('is_active', false);
                slot.save().then(function() {
                    _this.notify.success('Slot inactivated successfully!');
                    _this.send('refreshModel');
                });
            }
            return false;
        }
    }
});
