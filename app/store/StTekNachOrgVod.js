/*
 * File: app/store/StTekNachOrgVod.js
 * Date: Sun May 10 2015 10:35:48 GMT+0300 (EEST)
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

Ext.define('Ykis.store.StTekNachOrgVod', {
    extend: 'Ext.data.Store',
    alias: 'store.stTekNachOrgVod',

    requires: [
        'Ykis.model.MdTekNach',
        'Ext.data.proxy.Direct',
        'Ykis.DirectAPI',
        'Ext.data.reader.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'stTekNachOrgVod',
            model: 'Ykis.model.MdTekNach',
            proxy: {
                type: 'direct',
                extraParams: {
                    what: 'TekNachOrgVodomera'
                },
                directFn: 'QueryVodomer.getResults',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }, cfg)]);
    }
});