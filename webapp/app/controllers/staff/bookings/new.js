import BaseBooking from '../../base-booking';

export default BaseBooking.extend({

    patients: [],

    patientsData: function() {
        return this.get('patients').pushObject(this.get('model.patient').set('address_data', this.get('model.address')));
    }.observes('model.patient'),

    actions: {
        save: function() {
            var _this = this,
                booking = this.get('model.booking');
            
            if (booking.get('isValid')) {
                // Set patients data on booking model 
                booking.patients = this.get('patients');
                booking.save().then(function() {
                    _this.transitionToRoute('staff.bookings');
                }, function(errors) {
                    _this.notify.alert(errors.responseJSON.errors.get('firstObject.title'));
                });
            }
            return false;
        },
        addNewPatient: function() {
            this.get('patients').pushObject(this.store.createRecord('patient', {sex: 'Male', address_data: this.store.createRecord('address')}));
        },
        deletePatient: function(patient) {
            this.get('patients').splice(this.get('patients').indexOf(patient), 1);
            this.set('patients',  this.get('patients'));
            patient.rollback();
        },
        cancel: function() {
            this.get('model.booking').deleteRecord();
            this.set('patients', []);
            this.transitionToRoute('staff.bookings');
            return false;
        }
    }
});
