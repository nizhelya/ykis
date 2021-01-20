/*
 * File: app/store/StAktClaim.js
 * Date: Tue Feb 04 2020 00:58:04 GMT+0200 (EET)
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

Ext.define('Ykis.store.StAktClaim', {
    extend: 'Ext.data.Store',

    requires: [
        'Ykis.model.MdPriborUcheta',
        'Ext.data.proxy.Direct',
        'Ykis.DirectAPI',
        'Ext.data.reader.Json',
        'Ext.data.writer.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StAktClaim',
            model: 'Ykis.model.MdPriborUcheta',
            proxy: {
                type: 'direct',
                api: {
                    create: 'QuerySprav.createRecord',
                    read: 'QuerySprav.getResults',
                    update: 'QuerySprav.updateRecords',
                    destroy: 'QuerySprav.destroyRecord'
                },
                extraParams: {
                    what: 'getAktClaim'
                },
                directFn: 'QuerySprav.getResults',
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
                remove: {
                    fn: me.onDirectstoreRemove,
                    scope: me
                },
                update: {
                    fn: me.onDirectstoreUpdate,
                    scope: me
                }
            }
        }, cfg)]);
    },

    onDirectstoreRemove: function(store, records, index, isMove, eOpts) {
        records[0].data.what = "getAktClaim";

    },

    onDirectstoreUpdate: function(store, record, operation, modifiedFieldNames, details, eOpts) {
        record.data.what = "getAktClaim";

    }

});