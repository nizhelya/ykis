/*
 * File: app/view/VpKommuna.js
 * Date: Fri May 08 2020 21:10:58 GMT+0300 (EEST)
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

Ext.define('Ykis.view.VpKommuna', {
    extend: 'Ext.container.Viewport',
    alias: 'widget.vpkommuna',

    requires: [
        'Ykis.view.VpKommunaViewModel',
        'Ykis.view.menu.TabPnCenter',
        'Ykis.view.menu.TabPnLeft',
        'Ext.tab.Panel'
    ],

    viewModel: {
        type: 'vpkommuna'
    },
    layout: 'border',

    items: [
        {
            xtype: 'tabpncenter',
            height: 714,
            flex: 1,
            region: 'center',
            split: true
        },
        {
            xtype: 'panel',
            region: 'south',
            height: 21,
            html: '<center><span style="color:#04468C;text-shadow: 2px 3px 5px #bfbfbf;position:absolute;\ndisplay:block;top:3px;letter-spacing:-.05em;font-family:serif;left:0;height:60%;width:100%;\nbackground-color:#FFFFFF;filter:alpha(opacity=65);\n-moz-opacity: 0.65;opacity: 0.65;">&copy;2004 -2012 <span>Южненская Коммунальная Информационная Система\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ITX&nbsp;&amp;&nbsp;Нижельский С.А.</span></center>',
            title: ''
        },
        {
            xtype: 'panel',
            region: 'west',
            maxWidth: 250,
            width: 250,
            title: '',
            layout: {
                type: 'vbox',
                align: 'stretch'
            },
            items: [
                {
                    xtype: 'container',
                    border: false,
                    height: 66,
                    html: '<h6 class="header"><span>Южненская Коммунальная<br>Информационная Система</span></h6>',
                    style: 'background-color: #f3f3f3;',
                    layout: 'fit'
                },
                {
                    xtype: 'tabpnleft',
                    flex: 3
                }
            ]
        }
    ]

});