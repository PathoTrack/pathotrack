import Ember from 'ember';

export default Ember.Controller.extend({
	queryParams: ['search'],
    search: null,
    searchField: Ember.computed.oneWay('search'),

    actions: {
        delete: function(booking) {
            booking.deleteRecord();
            booking.save();
            return false;
        },
        search: function() {
          this.set('search', this.get('searchField'));
        }
    }
});
