import DS from 'ember-data';

export default DS.Model.extend({
    namespace: DS.attr('string', { defaultValue : 'open' }),
    created_at: DS.attr('date', { defaultValue: new Date() }),
    updated_at: DS.attr('date', { defaultValue: new Date() }),
});