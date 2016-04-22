import Ember from 'ember';

export default Ember.Controller.extend({

    isLoading : false,

    actions: {
        goToUrl: function(url, name, specs, replace) {
            name = name || '_self';
            specs = specs || '';
            replace = replace || false;
            if(specs.includeHash === true && window.location.hash) {
                url += '/' + window.location.hash;
            }
            window.open(url, name, specs, replace);
        }
    }
    
});