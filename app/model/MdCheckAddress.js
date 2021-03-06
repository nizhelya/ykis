/*
 * File: app/model/MdCheckAddress.js
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

Ext.define('Ykis.model.MdCheckAddress', {
    extend: 'Ext.data.Model',

    requires: [
        'Ext.data.field.Number'
    ],

    fields: [
        {
            type: 'int',
            name: 'address_id'
        },
        {
            type: 'float',
            name: 'oplata'
        },
        {
            type: 'float',
            name: 'voda'
        },
        {
            type: 'float',
            name: 'stoki'
        },
        {
            type: 'float',
            name: 'podogrev'
        },
        {
            type: 'float',
            name: 'otoplenie'
        },
        {
            type: 'float',
            name: 'kvartplata'
        },
        {
            type: 'float',
            name: 'tbo'
        }
    ]
});