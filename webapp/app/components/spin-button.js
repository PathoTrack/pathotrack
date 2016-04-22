import Ember from 'ember';
export default Ember.Component.extend({
    tagName: 'button',
    type:' submit',
    buttonText:' Submit',
    externalLink: false,
    attributeBindings: ['type'],
    isLoading: false,
    click: function() {
        this.sendAction();
    }
});
