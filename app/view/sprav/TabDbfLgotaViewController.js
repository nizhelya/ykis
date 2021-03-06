/*
 * File: app/view/sprav/TabDbfLgotaViewController.js
 * Date: Sat Nov 30 2019 11:59:41 GMT+0200 (EET)
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

Ext.define('Ykis.view.sprav.TabDbfLgotaViewController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.tabdbflgota',

    onDataNachLgotaChange: function(field, newValue, oldValue, eOpts) {

        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');

        var stSubsidia = Ext.data.StoreManager.get("StDbfLgota");
        var usluga_id =  Ext.getCmp('orgOshadBankLgota').getValue();

        var btnGetSubsidiaOshadBank =  Ext.getCmp('btnGetLgotaOshadBank');
        var btnPrintReestrToOshadBank =  Ext.getCmp('btnPrintReestrToOshadBank');
        var btnPrintReestrFromOshadBank =  Ext.getCmp('btnPrintReestrFromOshadBank');
        var btnImportOshadBank =  Ext.getCmp('btnImportOshadBankLgota');
        var btnExportOshadBank =  Ext.getCmp('btnExportOshadBankLgota');
        var btnImportOplataOshad =  Ext.getCmp('btnImportOplataOshadLgota');
        var btnImportOplataYkis =  Ext.getCmp('btnImportOplataYkisLgota');
        var btnSubsidiaOtkat =  Ext.getCmp('btnLgotaOtkat');


        if (usluga_id){
            btnGetSubsidiaOshadBank.setDisabled(false);
            btnPrintReestrToOshadBank.setDisabled(false);
            btnPrintReestrFromOshadBank.setDisabled(false);
            btnImportOshadBank.setDisabled(false);
            btnExportOshadBank.setDisabled(false);
            btnImportOplataOshad.setDisabled(false);
            btnImportOplataYkis.setDisabled(false);
            btnSubsidiaOtkat.setDisabled(false);


            stSubsidia.load({
                params: {
                    what:'getDbfLgota',
                    login:login,
                    password:password,
                    data:newValue,
                    usluga_id: usluga_id
                },
                scope:this
            });
        } else {
            btnGetSubsidiaOshadBank.setDisabled(true);
            btnPrintReestrToOshadBank.setDisabled(true);
            btnPrintReestrFromOshadBank.setDisabled(true);
            btnImportOshadBank.setDisabled(true);
            btnExportOshadBank.setDisabled(true);
            btnImportOplataOshad.setDisabled(true);
            btnImportOplataYkis.setDisabled(true);
            btnSubsidiaOtkat.setDisabled(true);


        }

    }

});
