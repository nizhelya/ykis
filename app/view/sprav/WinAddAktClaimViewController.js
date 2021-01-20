/*
 * File: app/view/sprav/WinAddAktClaimViewController.js
 * Date: Fri Feb 21 2020 13:09:24 GMT+0200 (EET)
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

Ext.define('Ykis.view.sprav.WinAddAktClaimViewController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.winaddaktclaim',

    onComboboxSelect: function(combo, record, eOpts) {
        var form = combo.findParentByType('form');
        var square = form.getForm().findField('square');
        var address = form.getForm().findField('address');
        //var dteplomer_id = form.getForm().findField('dteplomer_id');

        var stUser = Ext.data.StoreManager.get("StUser");
        var StFilialOpl = Ext.data.StoreManager.get("StFilialOpl");
        var values =stUser.getAt(0);

        //console.log(record);
        if (record ) {
            address.setValue(record.get("address"));
            square.setValue(record.get("area_otopl"));
            // dteplomer_id.setValue(record.get("dteplomer_id"));
        }

    }

});
