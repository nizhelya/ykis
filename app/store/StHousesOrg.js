/*
 * File: app/store/StHousesOrg.js
 * Date: Thu Jan 30 2020 15:34:36 GMT+0200 (EET)
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

Ext.define('Ykis.store.StHousesOrg', {
    extend: 'Ext.data.Store',
    alias: 'store.StHousesOrg',

    requires: [
        'Ykis.model.MdHouses',
        'Ext.data.proxy.Direct',
        'Ykis.DirectAPI',
        'Ext.data.reader.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StHousesOrg',
            autoLoad: true,
            model: 'Ykis.model.MdHouses',
            proxy: {
                type: 'direct',
                extraParams: {
                    what: 'house'
                },
                directFn: 'QueryLoad.getResults',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }, cfg)]);
    }
});