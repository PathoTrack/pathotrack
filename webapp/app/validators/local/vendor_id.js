import Base from 'ember-validations/validators/base';

export default Base.extend({
  init: function() {
    // this call is necessary, don't forget it!
    this._super();
    this.dependentValidationKeys.pushObjects(this.options.watchArray);
  },
  call: function() {
    if (this.model.get('namespace') === 'staff') {
      this.errors.pushObject('can not be blank');
    }
  }
});