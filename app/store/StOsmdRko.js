/*
 * File: app/store/StOsmdRko.js
 * Date: Sun Mar 12 2017 13:45:41 GMT+0200 (EET)
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

Ext.define('Ykis.store.StOsmdRko', {
    extend: 'Ext.data.Store',

    requires: [
        'Ykis.model.MdHouses',
        'Ext.data.proxy.Direct',
        'Ykis.DirectAPI',
        'Ext.data.reader.Json',
        'Ext.data.writer.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StOsmdRko',
            model: 'Ykis.model.MdHouses',
            proxy: {
                type: 'direct',
                api: {
                    read: 'QuerySprav.getResults',
                    update: 'QuerySprav.updateRecords'
                },
                extraParams: {
                    what: 'getOsmdRko'
                },
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                },
                writer: {
                    type: 'json',
                    writeAllFields: true
                }
            },
            listeners: {
                update: {
                    fn: me.onDirectstoreUpdate,
                    scope: me
                }
            }
        }, cfg)]);
    },

    onDirectstoreUpdate: function(store, record, operation, modifiedFieldNames, details, eOpts) {
        record.data.what = "getOsmdRko";

    }

});