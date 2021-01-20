/*
 * File: app/store/StUsluga.js
 * Date: Tue Apr 23 2019 00:22:35 GMT+0300 (EEST)
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

Ext.define('Ykis.store.StUsluga', {
    extend: 'Ext.data.Store',
    alias: 'store.stUsluga',

    requires: [
        'Ext.data.field.String',
        'Ext.data.field.Integer',
        'Ext.data.proxy.Memory'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'stUsluga',
            autoLoad: true,
            data: [
                {
                    usluga: 'Квартплата',
                    usluga_id: 1
                },
                {
                    usluga: 'Теплоснабжение',
                    usluga_id: 2
                },
                {
                    usluga: 'П.Т.Н.',
                    usluga_id: 7
                },
                {
                    usluga: 'Водоснабжение',
                    usluga_id: 3
                },
                {
                    usluga: 'Водоотведение',
                    usluga_id: 4
                },
                {
                    usluga: 'Т.Б.О.',
                    usluga_id: 5
                }
            ],
            fields: [
                {
                    type: 'string',
                    name: 'usluga'
                },
                {
                    type: 'int',
                    name: 'usluga_id'
                }
            ],
            proxy: {
                type: 'memory'
            }
        }, cfg)]);
    }
});