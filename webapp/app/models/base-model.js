import DS from 'ember-data';
import EmberValidations from 'ember-validations';

export default DS.Model.extend(EmberValidations.Mixin, {
    namespace: DS.attr('string'),
    created_at: DS.attr('date', { defaultValue: new Date() }),
    updated_at: DS.attr('date', { defaultValue: new Date() }),
});