/*
 * File: app/store/StVsubsidia.js
 * Date: Mon Jun 05 2017 23:17:07 GMT+0300 (EEST)
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

Ext.define('Ykis.store.StVsubsidia', {
    extend: 'Ext.data.Store',
    alias: 'store.stVsubsidia',

    requires: [
        'Ykis.model.MdVsubsidia',
        'Ext.data.proxy.Direct',
        'Ykis.DirectAPI',
        'Ext.data.reader.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            groupField: 'address',
            storeId: 'StVsubsidia',
            model: 'Ykis.model.MdVsubsidia',
            proxy: {
                type: 'direct',
                directFn: 'QuerySprav.getResults',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }, cfg)]);
    }
});