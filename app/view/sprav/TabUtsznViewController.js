/*
 * File: app/view/sprav/TabUtsznViewController.js
 * Date: Sun Feb 02 2020 13:48:13 GMT+0200 (EET)
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

Ext.define('Ykis.view.sprav.TabUtsznViewController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.tabutszn',

    onComboboxSelect: function(combo, record, eOpts) {

        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');
        var org_id = values.get('org_id');
        var StUtszn = Ext.data.StoreManager.get("StUtszn");
        var lgota =  Ext.getCmp('lgota').getValue();

        var btnImportUtszn =  Ext.getCmp('btnImportUtszn');
        var btnUpdateReestrUtszn =  Ext.getCmp('btnUpdateReestrUtszn');
        var btnPrintReestrToUtszn =  Ext.getCmp('btnPrintReestrToUtszn');

        if (org_id){
            btnImportUtszn.setDisabled(false);
            btnUpdateReestrUtszn.setDisabled(false);
            btnPrintReestrToUtszn.setDisabled(false);


            StUtszn.load({
                params: {
                    what:'utszn',
                    login:login,
                    password:password,
                    data:newValue,
                    org_id: org_id,
                    lgota:lgota
                },
                scope:this
            });
        } else {
            btnImportUtszn.setDisabled(true);
            btnUpdateReestrUtszn.setDisabled(true);
            btnPrintReestrToUtszn.setDisabled(true);
        }

    }

});
