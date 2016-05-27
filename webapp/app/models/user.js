import DS from 'ember-data';

export default DS.Model.extend({
    name: DS.attr('string'),
    email: DS.attr('string'),
    password: DS.attr('string'),
    phone_number: DS.attr('string'),
    dob: DS.attr('string'),
    sex: DS.attr('string'),
    address_data: DS.attr(''),
    
    // Relationships
    roles: DS.hasMany('role', { inverse : 'users' }),
    vendor: DS.belongsTo('vendor', { inverse : 'user' }),
    address: DS.belongsTo('address'),

    // Validations
    validations: {
        name: { 
        	presence: true
        },
        email: { 
            presence: true
        },
        phone_number: { 
            presence: true
        },
        dob: { 
            presence: true
        },
        sex: { 
            presence: true
        }
    }
    
});