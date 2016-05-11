import Ember from 'ember';

export default Ember.Controller.extend({
	queryParams: ['search'],
    search: null,
    searchField: Ember.computed.oneWay('search'),
    
    actions: {
        delete: function(contact) {
            var _this = this;

            contact.deleteRecord();
            contact.save().then(function() {
                _this.send('refreshModel');
            });
            return false;
        },
        search: function() {
          this.set('search', this.get('searchField'));
        }
    }
});
