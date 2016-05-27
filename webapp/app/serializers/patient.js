import DS from 'ember-data';

export default DS.RESTSerializer.extend(DS.EmbeddedRecordsMixin, {
    attrs: {
        roles: { deserialize: 'records' },
        address: { deserialize: 'records' },
    }
});