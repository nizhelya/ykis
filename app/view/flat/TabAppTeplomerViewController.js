/*
 * File: app/view/flat/TabAppTeplomerViewController.js
 * Date: Sat Mar 28 2020 02:33:16 GMT+0200 (EET)
 *
 * This file was generated by Sencha Architect version 3.2.0.
 * http://www.sencha.com/products/architect/
 *
 * This file requires use of the Ext JS 5.1.x library, under independent license.
 * License of Sencha Architect does not include license for Ext JS 5.1.x. For more
 * details see http://www.sencha.com/license or contact license@sencha.com.
 *
 * This file will be auto-generated each and everytime you save your project.
 *
 * Do NOT hand edit this file.
 */

Ext.define('Ykis.view.flat.TabAppTeplomerViewController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.tabappteplomer',

    onGrAppTeplomerSelect: function(rowmodel, record, index, eOpts) {
        var stUser = Ext.data.StoreManager.get("StUser");
        var stTekPokTeplomera = Ext.data.StoreManager.get("StTekPokTeplomera");
        var stAllPokTeplomera = Ext.data.StoreManager.get("StAllPokTeplomera");

        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');
        var address_id = values.get('address_id');
        var house_id = values.get('house_id');

        var fmTeplomer = Ext.getCmp('fmAppTeplomer');
        var dt = new Date();
        var d = Ext.Date.getDaysInMonth(dt);
        fmTeplomer.getForm().findField('date_new').setValue(Ext.Date.format(dt, 'Y-m-d'));

        if (record){

            fmTeplomer.getForm().findField('fmAppTeplomer_id').setValue(record.data.teplomer_id);
            fmTeplomer.getForm().findField('AppT_pok_id').setValue(record.data.pok_id);
            var insTekPokAppTeplomer = fmTeplomer.down('#insTekPokAppTeplomer');
            var aktOplombirovkiTeplomer = fmTeplomer.down('#aktOplombirovkiTeplomer');
            var aktRasplombirovkiTeplomer = fmTeplomer.down('#aktRasplombirovkiTeplomer');
            var newValue = fmTeplomer.getForm().findField('newValue');

            var AddMeedlePokVod = fmTeplomer.down('#AddMeedlePokTeplomer');
            var insMeedlePokVod = fmTeplomer.down('#insMeedlePokTeplomer');
            var date_ot = fmTeplomer.getForm().findField('date_ot');
            var date_do = fmTeplomer.getForm().findField('date_do');
            var date_ao = fmTeplomer.getForm().findField('date_ao');
            var date_ar = fmTeplomer.getForm().findField('date_ar');
            var pok_ot = fmTeplomer.getForm().findField('pok_ot');
            var pok_do = fmTeplomer.getForm().findField('pok_do');
            var rday = fmTeplomer.getForm().findField('rday');
            var days = fmTeplomer.getForm().findField('days');
            var kub_day = fmTeplomer.getForm().findField('kub_day');
            var qty_kub = fmTeplomer.getForm().findField('qty_kub');
            var newKubov = fmTeplomer.getForm().findField('newKubov');


            stTekPokTeplomera.load({
                params: {
                    login:login,
                    password:password,
                    address_id: address_id,
                    what:'TekPokTeplomera',
                    what_id: record.data.teplomer_id,
                    teplomer_id: record.data.teplomer_id,
                    nomer: record.data.nomer
                },
                callback: function(records,operation,success){
                    if(success && records.length){
                        fmTeplomer.getForm().loadRecord(records[0]);

                    }
                },
                scope:this
            });



            stAllPokTeplomera.load({
                params: {
                    login:login,
                    password:password,
                    address_id: address_id,
                    what:'AllPokTeplomera',
                    what_id: record.data.teplomer_id,
                    teplomer_id: record.data.teplomer_id,
                    nomer: record.data.nomer
                },
                scope:this
            });

            if (record.data.out===1){
                AddMeedlePokVod.setDisabled(true);
                insMeedlePokVod.setDisabled(true);
                insTekPokAppTeplomer.setDisabled(true);
                aktRasplombirovkiTeplomer.setDisabled(true);
                aktOplombirovkiTeplomer.setDisabled(true);

                date_ao.setDisabled(false);
                date_ar.setDisabled(false);
                date_ot.setDisabled(true);
                date_do.setDisabled(true);
                qty_kub.setDisabled(true);
                pok_do.setDisabled(true);
                pok_ot.setDisabled(true);
                rday.setDisabled(true);
                days.setDisabled(true);
                qty_kub.setDisabled(true);
                kub_day.setDisabled(true);
                newKubov.setDisabled(true);
                newValue.setDisabled(true);

            } else {
                AddMeedlePokVod.setDisabled(true);
                insMeedlePokVod.setDisabled(true);
                insTekPokAppTeplomer.setDisabled(false);
                aktRasplombirovkiTeplomer.setDisabled(false);
                aktOplombirovkiTeplomer.setDisabled(false);

                date_ao.setDisabled(true);
                date_ar.setDisabled(true);
                date_ot.setDisabled(true);
                date_do.setDisabled(true);
                pok_do.setDisabled(true);
                pok_ot.setDisabled(true);
                days.setDisabled(true);
                rday.setDisabled(true);
                qty_kub.setDisabled(true);
                kub_day.setDisabled(true);
                newKubov.setDisabled(true);
                newValue.setDisabled(false);
            }

        }

    },

    onDatefieldChange: function(field, newValue, oldValue, eOpts) {
        Ext.getCmp('AddMeedlePokTeplomer').setDisabled(false);

    },

    onDatefieldSelect1: function(field, value, eOpts) {
        var form = field.findParentByType('form');
        var dt = new Date();
        var d = Ext.Date.getDaysInMonth(dt);
        var  date_ot = form.getForm().findField('date_ot');
        var  date_do = form.getForm().findField('date_do');
        date_do.setDisabled(false);
        date_ot.setDisabled(false);
        date_ot.setValue(value);
        date_do.setValue(Ext.Date.format(dt, 'Y-m-d'));



    },

    onDatefieldSelect: function(field, value, eOpts) {
        var form = field.findParentByType('form');

        var  date_do = form.getForm().findField('date_do');
        Ext.getCmp('AddMeedlePokTeplomer').setDisabled(false);

        date_do.setDisabled(false);
        date_do.setValue(value);

    }

});
