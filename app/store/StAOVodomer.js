/*
 * File: app/store/StAOVodomer.js
 * Date: Fri Mar 20 2020 12:00:24 GMT+0200 (EET)
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

Ext.define('Ykis.store.StAOVodomer', {
    extend: 'Ext.data.Store',
    alias: 'store.StAOVodomer',

    requires: [
        'Ykis.model.MdPriborUcheta',
        'Ext.data.proxy.Direct',
        'Ykis.DirectAPI',
        'Ext.data.reader.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StAOVodomer',
            model: 'Ykis.model.MdPriborUcheta',
            proxy: {
                type: 'direct',
                directFn: 'QueryVodomer.getResults',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }, cfg)]);
    }
});