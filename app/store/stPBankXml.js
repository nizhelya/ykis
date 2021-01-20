/*
 * File: app/store/stPBankXml.js
 * Date: Sun Apr 19 2020 15:05:19 GMT+0300 (EEST)
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

Ext.define('Ykis.store.stPBankXml', {
    extend: 'Ext.data.TreeStore',
    alias: 'store.stPBankXml',

    requires: [
        'Ykis.model.MdPBankXml',
        'Ext.data.proxy.Rest',
        'Ext.data.reader.Xml'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'stPBankXml',
            model: 'Ykis.model.MdPBankXml',
            proxy: {
                type: 'rest',
                api: {
                    read: 'QueryPBXml.getResults'
                },
                extraParams: {
                    what: 'xmlData'
                },
                url: '/pb/pb.php',
                reader: {
                    type: 'xml',
                    rootProperty: 'Transfer',
                    record: 'Data'
                }
            }
        }, cfg)]);
    }
});