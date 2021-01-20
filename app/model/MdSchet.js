/*
 * File: app/model/MdSchet.js
 * Date: Tue Jul 19 2016 11:46:31 GMT+0300 (EEST)
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

Ext.define('Ykis.model.MdSchet', {
    extend: 'Ext.data.Model',
    alias: 'model.mdSchet',

    requires: [
        'Ext.data.field.String',
        'Ext.data.field.Date',
        'Ext.data.field.Number'
    ],

    fields: [
        {
            type: 'int',
            name: 'rec_id'
        },
        {
            type: 'int',
            name: 'golovnoe'
        },
        {
            type: 'int',
            name: 'ind'
        },
        {
            type: 'int',
            name: 'nom'
        },
        {
            type: 'string',
            name: 'edrpou'
        },
        {
            type: 'string',
            name: 'nomer'
        },
        {
            type: 'date',
            name: 'data'
        },
        {
            type: 'int',
            name: 'org_id'
        },
        {
            type: 'int',
            name: 'filial_id'
        },
        {
            type: 'string',
            name: 'oname'
        },
        {
            type: 'string',
            name: 'fname'
        },
        {
            type: 'string',
            name: 'sname'
        },
        {
            type: 'string',
            name: 'edizm'
        },
        {
            type: 'float',
            name: 'tarif_xv'
        },
        {
            type: 'float',
            name: 'tarif_st'
        },
        {
            type: 'float',
            name: 'kub_xv'
        },
        {
            type: 'float',
            name: 'kub_st'
        },
        {
            type: 'float',
            name: 'pkub_xv'
        },
        {
            type: 'float',
            name: 'pkub_st'
        },
        {
            type: 'float',
            name: 'xvoda'
        },
        {
            type: 'float',
            name: 'pxvoda'
        },
        {
            type: 'float',
            name: 'stoki'
        },
        {
            type: 'float',
            name: 'pstoki'
        },
        {
            type: 'float',
            name: 'nds'
        },
        {
            type: 'float',
            name: 'nachisleno'
        },
        {
            type: 'float',
            name: 'zadol'
        },
        {
            type: 'float',
            name: 'dolg'
        },
        {
            type: 'float',
            name: 'oplacheno'
        },
        {
            type: 'int',
            name: 'out'
        },
        {
            type: 'string',
            name: 'mfo'
        },
        {
            type: 'string',
            name: 'boss'
        },
        {
            type: 'string',
            name: 'buhgalter'
        },
        {
            type: 'date',
            name: 'sdata'
        },
        {
            type: 'string',
            name: 'rs'
        },
        {
            type: 'string',
            name: 'address'
        },
        {
            type: 'int',
            name: 'osn'
        },
        {
            type: 'float',
            name: 'itogo'
        },
        {
            name: 'golova'
        },
        {
            type: 'string',
            name: 'vosobi'
        },
        {
            type: 'int',
            name: 'pr'
        },
        {
            name: 'sobstv_id'
        },
        {
            type: 'string',
            name: 'sobstv'
        },
        {
            type: 'string',
            name: 'dogovor'
        }
    ]
});