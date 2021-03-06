/*
 * File: app/view/menu/TabPnCenter.js
 * Date: Tue Oct 06 2020 01:39:31 GMT+0300 (EEST)
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

Ext.define('Ykis.view.menu.TabPnCenter', {
    extend: 'Ext.tab.Panel',
    alias: 'widget.tabpncenter',

    requires: [
        'Ykis.view.menu.TabPnCenterViewModel',
        'Ykis.view.flat.TabKassa',
        'Ykis.view.flat.TabAppBti',
        'Ykis.view.flat.TabNachAppVoda',
        'Ykis.view.flat.TabNachApp',
        'Ykis.view.flat.TabAppVodomer',
        'Ykis.view.flat.TabNachAppTeplo',
        'Ykis.view.flat.TabAppTeplomer',
        'Ykis.view.org.TabOrg',
        'Ykis.view.org.TabFilial',
        'Ykis.view.org.TabOrgVodomer',
        'Ykis.view.org.TabOrgTeplomer',
        'Ykis.view.org.TabNachFilial',
        'Ykis.view.flat.TabOplata',
        'Ykis.view.sprav.TabDteplomer',
        'Ykis.view.sprav.TabDvodomer',
        'Ykis.view.sprav.TabLogin',
        'Ext.tab.Tab',
        'Ext.tab.Panel',
        'Ext.form.Panel'
    ],

    viewModel: {
        type: 'tabpncenter'
    },
    border: false,
    id: 'tabPnCenter',
    activeTab: 15,

    items: [
        {
            xtype: 'tabkassa'
        },
        {
            xtype: 'tabappbti'
        },
        {
            xtype: 'tabnachappvoda',
            title: 'Водопостачання'
        },
        {
            xtype: 'tabnachapp'
        },
        {
            xtype: 'tabappvodomer'
        },
        {
            xtype: 'tabnachappteplo',
            title: 'Теплопостачання'
        },
        {
            xtype: 'tabappteplomer'
        },
        {
            xtype: 'taborg'
        },
        {
            xtype: 'tabfilial'
        },
        {
            xtype: 'taborgvodomer'
        },
        {
            xtype: 'taborgteplomer'
        },
        {
            xtype: 'tabnachfilial',
            title: 'Начисления'
        },
        {
            xtype: 'taboplata',
            title: 'Оплата'
        },
        {
            xtype: 'tabdteplomer'
        },
        {
            xtype: 'tabdvodomer'
        },
        {
            xtype: 'tabLogin',
            title: 'My Tab'
        }
    ]

});