import DS from 'ember-data';

export default DS.RESTSerializer.extend(DS.EmbeddedRecordsMixin, {
    attrs: {
        vendor: { deserialize: 'records' },
        user: { deserialize: 'records' },
        booking_slot: { deserialize: 'records' }
    }
});