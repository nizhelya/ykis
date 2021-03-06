/*
 * File: app/store/StBanks.js
 * Date: Mon May 25 2015 00:25:01 GMT+0300 (EEST)
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

Ext.define('Ykis.store.StBanks', {
    extend: 'Ext.data.Store',
    alias: 'store.stBanks',

    requires: [
        'Ykis.model.MdBanks',
        'Ext.data.proxy.Direct',
        'Ykis.DirectAPI',
        'Ext.data.reader.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'stBanks',
            autoLoad: true,
            model: 'Ykis.model.MdBanks',
            proxy: {
                type: 'direct',
                extraParams: {
                    what: 'Bank'
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