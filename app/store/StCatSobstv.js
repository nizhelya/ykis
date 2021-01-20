/*
 * File: app/store/StCatSobstv.js
 * Date: Fri May 22 2015 20:22:24 GMT+0300 (EEST)
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

Ext.define('Ykis.store.StCatSobstv', {
    extend: 'Ext.data.Store',
    alias: 'store.stCatSobstv',

    requires: [
        'Ykis.model.MdCatSobstv',
        'Ext.data.proxy.Direct',
        'Ykis.DirectAPI',
        'Ext.data.reader.Json',
        'Ext.data.writer.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'stCatSobstv',
            autoLoad: true,
            model: 'Ykis.model.MdCatSobstv',
            proxy: {
                type: 'direct',
                api: {
                    create: 'QuerySprav.createRecord',
                    read: 'QuerySprav.getResults',
                    update: 'QuerySprav.updateRecords',
                    destroy: 'QuerySprav.destroyRecord'
                },
                extraParams: {
                    what: 'getCatSobstv'
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
              record.data.what = "getCatSobstv";

    },

    onDirectstoreRemove: function(store, records, index, isMove, eOpts) {
        records[0].data.what = "getCatSobstv";
        //console.log(records[0].data);
    }

});