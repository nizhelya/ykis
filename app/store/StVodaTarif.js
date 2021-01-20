/*
 * File: app/store/StVodaTarif.js
 * Date: Fri Mar 27 2020 01:27:46 GMT+0200 (EET)
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

Ext.define('Ykis.store.StVodaTarif', {
    extend: 'Ext.data.Store',
    alias: 'store.stVodaTarif',

    requires: [
        'Ext.data.field.String',
        'Ext.data.proxy.Memory'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'stVodaTarif',
            autoLoad: true,
            data: [
                {
                    usluga: 'Вода',
                    tarif: 'voda'
                },
                {
                    usluga: 'Стоки',
                    tarif: 'stoki'
                },
                {
                    usluga: 'Абонплата',
                    tarif: 'abonplata'
                },
                {
                    usluga: 'Куб_чел',
                    tarif: 'xvkub'
                },
                {
                    usluga: 'Куб_чел_мес',
                    tarif: 'kub_mec'
                }
            ],
            fields: [
                {
                    type: 'string',
                    name: 'usluga'
                },
                {
                    type: 'string',
                    name: 'tarif'
                }
            ],
            proxy: {
                type: 'memory'
            }
        }, cfg)]);
    }
});