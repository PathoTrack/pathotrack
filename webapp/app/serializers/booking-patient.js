import DS from 'ember-data';

export default DS.RESTSerializer.extend(DS.EmbeddedRecordsMixin, {
    attrs: {
        booking: { deserialize: 'records' },
        patient: { deserialize: 'records' }
    }
});