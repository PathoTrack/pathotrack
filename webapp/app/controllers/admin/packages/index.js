import Ember from 'ember';

export default Ember.Controller.extend({
	queryParams: ['search'],
    search: null,
    searchField: Ember.computed.oneWay('search'),
    
    actions: {
        delete: function(pack) {
            var _this = this;

            pack.deleteRecord();
            pack.save().then(function() {
                _this.send('refreshModel');
            });
            return false;
        },
        search: function() {
          this.set('search', this.get('searchField'));
        }
    }
});
