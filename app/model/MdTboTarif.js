/*
 * File: app/model/MdTboTarif.js
 * Date: Sun May 10 2015 09:50:19 GMT+0300 (EEST)
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

Ext.define('Ykis.model.MdTboTarif', {
    extend: 'Ext.data.Model',

    requires: [
        'Ext.data.field.String',
        'Ext.data.proxy.Memory'
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
        type: 'memory',
        data: [
            {
                usluga: 'ТБО',
                tarif: 'tbo'
            },
            {
                usluga: 'пер ТБО',
                tarif: 'ch_tbo'
            },
            {
                usluga: 'Тариф 1куб',
                tarif: 'tbo_kub'
            },
            {
                usluga: 'Кубов 1чел',
                tarif: 'tbo_kub_man'
            },
            {
                usluga: 'Кубов 1льг',
                tarif: 'tbo_kub_lg'
            }
        ]
    }
});