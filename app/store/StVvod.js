/*
 * File: app/store/StVvod.js
 * Date: Tue Mar 17 2020 16:55:32 GMT+0200 (EET)
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

Ext.define('Ykis.store.StVvod', {
    extend: 'Ext.data.Store',
    alias: 'store.stVvod',

    requires: [
        'Ext.data.field.String',
        'Ext.data.proxy.Memory'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'stVvod',
            autoLoad: true,
            data: [
                {
                    vvod: 'Ввод 1'
                },
                {
                    vvod: 'Ввод 2'
                },
                {
                    vvod: 'Ввод 3'
                },
                {
                    vvod: 'Ввод 4'
                },
                {
                    vvod: 'Ввод 5'
                },
                {
                    vvod: 'Ввод 6'
                },
                {
                    vvod: 'Ввод 7'
                },
                {
                    vvod: 'Ввод 8'
                },
                {
                    vvod: 'Ввод 9'
                },
                {
                    vvod: 'Ввод 10'
                }
            ],
            fields: [
                {
                    type: 'string',
                    name: 'vvod'
                }
            ],
            proxy: {
                type: 'memory'
            }
        }, cfg)]);
    }
});