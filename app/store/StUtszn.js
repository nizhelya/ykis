/*
 * File: app/store/StUtszn.js
 * Date: Sat Feb 01 2020 20:38:24 GMT+0200 (EET)
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

Ext.define('Ykis.store.StUtszn', {
    extend: 'Ext.data.Store',

    requires: [
        'Ykis.model.MdOplata',
        'Ext.data.proxy.Direct',
        'Ykis.DirectAPI',
        'Ext.data.writer.Json',
        'Ext.data.reader.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            groupField: 'god',
            storeId: 'StUtszn',
            model: 'Ykis.model.MdOplata',
            proxy: {
                type: 'direct',
                api: {
                    read: 'QuerySprav.getResults',
                    update: 'QuerySprav.updateRecords',
                    destroy: 'QuerySprav.destroyRecord'
                },
                extraParams: {
                    what: 'utszn'
                },
                writer: {
                    type: 'json',
                    writeAllFields: true
                },
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            },
            listeners: {
                update: {
                    fn: me.onDirectstoreUpdate,
                    scope: me
                },
                remove: {
                    fn: me.onDirectstoreRemove,
                    scope: me
                }
            }
        }, cfg)]);
    },

    onDirectstoreUpdate: function(store, record, operation, modifiedFieldNames, details, eOpts) {
        record.data.what = "utszn";

    },

    onDirectstoreRemove: function(store, records, index, isMove, eOpts) {
        records[0].data.what = "utszn";

    }

});