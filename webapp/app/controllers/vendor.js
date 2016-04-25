import BaseController from './base-controller';

export default BaseController.extend({
    authenticatedUser: function() {
        return this.get('model.firstObject');
    }.property('model.firstObject')
});