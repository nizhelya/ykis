/*
 * File: app/model/MdHouses.js
 * Date: Sat Sep 19 2020 13:28:37 GMT+0300 (EEST)
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

Ext.define('Ykis.model.MdHouses', {
    extend: 'Ext.data.Model',
    alias: 'model.mdHouses',

    requires: [
        'Ext.data.field.String',
        'Ext.data.field.Number'
    ],

    fields: [
        {
            type: 'int',
            name: 'raion_id'
        },
        {
            type: 'int',
            name: 'street_id'
        },
        {
            type: 'int',
            name: 'house_id'
        },
        {
            type: 'int',
            name: 'address_id'
        },
        {
            type: 'string',
            name: 'house'
        },
        {
            type: 'string',
            name: 'raion'
        },
        {
            type: 'string',
            name: 'street'
        },
        {
            type: 'string',
            name: 'item'
        },
        {
            type: 'string',
            name: 'address'
        },
        {
            type: 'string',
            name: 'appartment'
        },
        {
            type: 'string',
            name: 'abbr'
        },
        {
            type: 'int',
            name: 'osmd'
        },
        {
            type: 'int',
            name: 'edrpou'
        },
        {
            type: 'int',
            name: 'org_id'
        },
        {
            type: 'string',
            name: 'boss'
        },
        {
            type: 'string',
            name: 'glavbuh'
        },
        {
            type: 'string',
            name: 'uaddress'
        },
        {
            type: 'string',
            name: 'account'
        },
        {
            type: 'string',
            name: 'bank'
        },
        {
            type: 'string',
            name: 'mfo'
        },
        {
            type: 'string',
            name: 'dogovor'
        },
        {
            type: 'int',
            name: 'osmd_id'
        },
        {
            type: 'string',
            name: 'name'
        },
        {
            type: 'int',
            name: 'storeys_id'
        },
        {
            type: 'int',
            name: 'itp_id'
        },
        {
            type: 'int',
            name: 'gvs'
        },
        {
            type: 'float',
            name: 'mop'
        },
        {
            type: 'int',
            name: 'enaudit'
        },
        {
            type: 'int',
            name: 'temp'
        },
        {
            type: 'int',
            name: 'enaudit_id'
        },
        {
            type: 'float',
            name: 'enaudit_area'
        }
    ]
});