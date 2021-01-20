/*
 * File: app/view/sprav/TabOsmdHouses.js
 * Date: Tue Jul 28 2020 00:20:14 GMT+0300 (EEST)
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

Ext.define('Ykis.view.sprav.TabOsmdHouses', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.tabosmdhouses',

    requires: [
        'Ykis.view.sprav.TabOsmdHousesViewModel',
        'Ext.form.Panel',
        'Ext.form.field.ComboBox',
        'Ext.grid.Panel',
        'Ext.view.Table',
        'Ext.toolbar.Toolbar',
        'Ext.button.Button',
        'Ext.toolbar.Separator',
        'Ext.form.field.Date',
        'Ext.selection.CheckboxModel',
        'Ext.grid.column.RowNumberer',
        'Ext.grid.column.Number',
        'Ext.form.field.Number',
        'Ext.grid.plugin.RowEditing'
    ],

    viewModel: {
        type: 'tabosmdhouses'
    },
    id: 'tabOsmdHouses',
    scrollable: true,
    layout: 'fit',
    bodyBorder: false,
    closable: true,
    title: 'Договора организаций  на РКО с ОСМД',
    defaultListenerScope: true,

    initConfig: function(instanceConfig) {
        var me = this,
            config = {
                items: [
                    {
                        xtype: 'form',
                        height: 705,
                        id: 'fmOsmdHouses',
                        scrollable: true,
                        layout: 'absolute',
                        bodyPadding: 10,
                        title: '',
                        standardSubmit: true,
                        items: [
                            {
                                xtype: 'combobox',
                                width: 300,
                                fieldLabel: 'Организация',
                                name: 'org_id',
                                displayField: 'sname',
                                queryMode: 'local',
                                store: 'StCompany',
                                valueField: 'org_id',
                                listeners: {
                                    select: 'onComboboxSelect2'
                                }
                            },
                            {
                                xtype: 'gridpanel',
                                x: 5,
                                y: 40,
                                height: 710,
                                id: 'grHousesOsmdRko',
                                scrollable: true,
                                width: 760,
                                bodyBorder: true,
                                title: 'Список ОСМД включенных в РКО для организации',
                                store: 'StOsmdRko',
                                viewConfig: {
                                    height: 607
                                },
                                dockedItems: [
                                    {
                                        xtype: 'toolbar',
                                        dock: 'top',
                                        items: [
                                            {
                                                xtype: 'button',
                                                handler: function(button, event) {
                                                    // in use
                                                    var form = button.findParentByType('form');
                                                    var org_id = form.getForm().findField('org_id').getValue();

                                                    var stUser = Ext.data.StoreManager.get("StUser");
                                                    var StOsmdRko = Ext.data.StoreManager.get("StOsmdRko");
                                                    var StOsmd = Ext.data.StoreManager.get("StOsmd");

                                                    //LOGIN & PASSWORD

                                                    //LOGIKA
                                                    var grid = Ext.getCmp('grHousesOsmdRko');
                                                    var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();
                                                    var size = Ext.Object.getSize(gridRowSelectedRecords) ;
                                                    var values =stUser.getAt(0);
                                                    var login = values.get('login');
                                                    var password = values.get('password');
                                                    var params =[];
                                                    if (size >= 1){
                                                        params = {
                                                            login:values.get('login'),
                                                            password:values.get('password'),
                                                            what:"del_osmd_rko",
                                                            org_id:org_id

                                                        };
                                                        Ext.Object.each(gridRowSelectedRecords, function(key, val, myself) {
                                                            Ext.Object.merge(val.data, params);
                                                            QueryAddress.updateRecords(val.data,function(results){
                                                                if(results.res){
                                                                    return  true;
                                                                }  else {
                                                                    return  false;
                                                                }
                                                            });

                                                        });

                                                        setTimeout(function(){
                                                            StOsmdRko.load({
                                                                params: {
                                                                    what:'getOsmdRko',
                                                                    login:login,
                                                                    password:password,
                                                                    org_id: org_id
                                                                },
                                                                scope:this
                                                            });
                                                            StOsmd.load({
                                                                params: {
                                                                    what:'OsmdAll',
                                                                    login:login,
                                                                    password:password,
                                                                    org_id: org_id
                                                                },
                                                                scope:this
                                                            });

                                                        }, 1000);

                                                    }else {
                                                        Ext.MessageBox.show({
                                                            title: 'Ошибка ',
                                                            msg: 'Не выбраны дома для удаления из базу РКО',
                                                            buttons: Ext.MessageBox.OK,
                                                            icon: Ext.MessageBox.ERROR
                                                        });
                                                    }
                                                },
                                                disabled: true,
                                                id: 'btnDelHousesRko',
                                                width: 200,
                                                icon: 'resources/css/images/ico/no.png',
                                                text: 'Удалтить ОСМД из  РКО '
                                            },
                                            {
                                                xtype: 'tbseparator',
                                                width: 87
                                            },
                                            {
                                                xtype: 'datefield',
                                                width: 201,
                                                fieldLabel: 'Период',
                                                labelWidth: 55,
                                                name: 'data_nach',
                                                format: 'd-m-Y',
                                                startDay: 1,
                                                submitFormat: 'Ymd'
                                            },
                                            {
                                                xtype: 'button',
                                                handler: function(button, event) {
                                                    // in use
                                                    var form = button.findParentByType('form');
                                                    var org_id = form.getForm().findField('org_id').getValue();
                                                    var tabPnCenter =  Ext.getCmp('tabPnCenter');

                                                    var stUser = Ext.data.StoreManager.get("StUser");
                                                    var StOsmdRko = Ext.data.StoreManager.get("StOsmdRko");
                                                    var StOsmd = Ext.data.StoreManager.get("StOsmd");
                                                    var data_nach = form.getForm().findField('data_nach').getValue();
                                                    //console.log(data_nach);
                                                    //LOGIN & PASSWORD

                                                    //LOGIKA
                                                    if (data_nach !== null){

                                                        var grid = Ext.getCmp('grHousesOsmdRko');
                                                        var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();
                                                        var size = Ext.Object.getSize(gridRowSelectedRecords) ;
                                                        var values =stUser.getAt(0);
                                                        var login = values.get('login');
                                                        var password = values.get('password');
                                                        var params =[];
                                                        if (size >= 1){
                                                            params = {
                                                                login:values.get('login'),
                                                                password:values.get('password'),
                                                                what:"PrintSchetRko",
                                                                org_id:org_id

                                                            };
                                                            Ext.Object.each(gridRowSelectedRecords, function(key, val, myself) {
                                                                Ext.Object.merge(val.data, params);
                                                                QueryAddress.updateRecords(val.data,function(results){
                                                                    if(results.res){
                                                                        return  true;
                                                                    }  else {
                                                                        return  false;
                                                                    }
                                                                });

                                                            });


                                                            setTimeout(function(){
                                                                var report = 'PrintSchetRko';
                                                                var namereport = 'Акт сверки';
                                                                var value = {
                                                                    login:values.get('login'),
                                                                    password:values.get('password'),
                                                                    org_id:org_id,
                                                                    data:data_nach,

                                                                    report:report,
                                                                    what:report
                                                                };

                                                                var tab = tabPnCenter.child('#'+report);
                                                                if (!tab) {
                                                                    tab  = tabPnCenter.add({
                                                                        xtype:'tabreportorg',
                                                                        title:namereport,
                                                                        id:''+report+''
                                                                    });

                                                                }
                                                                tabPnCenter.setActiveTab(tab);
                                                                var reppan = tab.getComponent(0);
                                                                // Basic mask:
                                                                var myMask = Ext.Msg.show({
                                                                    title:'Выписка счета...',
                                                                    msg: 'Выписка ...',
                                                                    buttons: Ext.Msg.CANCEL,
                                                                    wait: true,
                                                                    modal: true,
                                                                    icon: Ext.Msg.INFO
                                                                });

                                                                QueryKassa.getRaspechatka(value,function(data){
                                                                    if (data){
                                                                        reppan.update(data.content);
                                                                        Ext.REPORTCONTENT =data.content;
                                                                        Ext.REPORTSQL =data.sql;
                                                                        Ext.REPORTTITLE =report;
                                                                        myMask.close();

                                                                    } else {
                                                                        myMask.close();
                                                                        Ext.MessageBox.show({
                                                                            title: 'Ошибка ',
                                                                            msg: 'Документ не создан',
                                                                            buttons: Ext.MessageBox.OK,
                                                                            icon: Ext.MessageBox.ERROR
                                                                        });
                                                                    }
                                                                });

                                                            }, 1000);
                                                        }else {
                                                            Ext.MessageBox.show({
                                                                title: 'Ошибка ',
                                                                msg: 'Не выбраны ОСМД для печати счета',
                                                                buttons: Ext.MessageBox.OK,
                                                                icon: Ext.MessageBox.ERROR
                                                            });
                                                        }
                                                    }else {
                                                        Ext.MessageBox.show({
                                                            title: 'Ошибка ',
                                                            msg: 'Не выбран период для печатисчета',
                                                            buttons: Ext.MessageBox.OK,
                                                            icon: Ext.MessageBox.ERROR
                                                        });
                                                    }
                                                },
                                                id: 'btnPrintSchetRko',
                                                width: 166,
                                                icon: 'resources/css/images/ico/yes.png',
                                                text: 'Выписать счет'
                                            }
                                        ]
                                    }
                                ],
                                selModel: Ext.create('Ext.selection.CheckboxModel', {
                                    selType: 'checkboxmodel',
                                    mode: 'SIMPLE',
                                    showHeaderCheckbox: true
                                }),
                                columns: [
                                    {
                                        xtype: 'rownumberer'
                                    },
                                    {
                                        xtype: 'numbercolumn',
                                        hidden: true,
                                        width: 50,
                                        dataIndex: 'house_id',
                                        menuDisabled: true,
                                        text: 'ид',
                                        format: '0'
                                    },
                                    {
                                        xtype: 'numbercolumn',
                                        width: 50,
                                        dataIndex: 'osmd_id',
                                        menuDisabled: true,
                                        text: 'ид',
                                        format: '0'
                                    },
                                    {
                                        xtype: 'gridcolumn',
                                        width: 120,
                                        dataIndex: 'house',
                                        menuDisabled: true,
                                        text: 'Дом'
                                    },
                                    {
                                        xtype: 'gridcolumn',
                                        width: 229,
                                        dataIndex: 'abbr',
                                        menuDisabled: true,
                                        text: 'ОСМД',
                                        editor: {
                                            xtype: 'textfield'
                                        }
                                    },
                                    {
                                        xtype: 'numbercolumn',
                                        width: 88,
                                        dataIndex: 'edrpou',
                                        menuDisabled: true,
                                        text: 'ЕДРПОУ',
                                        format: '0',
                                        editor: {
                                            xtype: 'numberfield'
                                        }
                                    },
                                    {
                                        xtype: 'gridcolumn',
                                        width: 120,
                                        dataIndex: 'account',
                                        menuDisabled: true,
                                        text: 'расч. счет',
                                        editor: {
                                            xtype: 'textfield'
                                        }
                                    },
                                    {
                                        xtype: 'gridcolumn',
                                        width: 70,
                                        dataIndex: 'mfo',
                                        menuDisabled: true,
                                        text: 'МФО',
                                        editor: {
                                            xtype: 'textfield'
                                        }
                                    },
                                    {
                                        xtype: 'gridcolumn',
                                        width: 350,
                                        dataIndex: 'uaddress',
                                        menuDisabled: true,
                                        text: 'Юридический адрес',
                                        editor: {
                                            xtype: 'textfield'
                                        }
                                    },
                                    {
                                        xtype: 'gridcolumn',
                                        width: 121,
                                        dataIndex: 'boss',
                                        menuDisabled: true,
                                        text: 'босс',
                                        editor: {
                                            xtype: 'textfield'
                                        }
                                    },
                                    {
                                        xtype: 'gridcolumn',
                                        width: 121,
                                        dataIndex: 'glavbuh',
                                        menuDisabled: true,
                                        text: 'главбух',
                                        editor: {
                                            xtype: 'textfield'
                                        }
                                    },
                                    {
                                        xtype: 'gridcolumn',
                                        width: 180,
                                        dataIndex: 'dogovor',
                                        menuDisabled: true,
                                        text: 'Договор на РКО',
                                        editor: {
                                            xtype: 'textfield'
                                        }
                                    }
                                ],
                                plugins: [
                                    {
                                        ptype: 'rowediting',
                                        pluginId: 'editOsmd',
                                        listeners: {
                                            edit: 'onRowEditingEdit'
                                        }
                                    }
                                ]
                            },
                            {
                                xtype: 'gridpanel',
                                x: 770,
                                y: 40,
                                height: 710,
                                id: 'grHousesOsmdAll',
                                scrollable: true,
                                width: 380,
                                bodyBorder: true,
                                title: 'Список ОСМД не включенных в РКО ',
                                store: 'StOsmd',
                                dockedItems: [
                                    {
                                        xtype: 'toolbar',
                                        dock: 'top',
                                        items: [
                                            {
                                                xtype: 'button',
                                                handler: function(button, event) {
                                                    // in use
                                                    var form = button.findParentByType('form');
                                                    var org_id = form.getForm().findField('org_id').getValue();

                                                    var stUser = Ext.data.StoreManager.get("StUser");
                                                    var StOsmdRko = Ext.data.StoreManager.get("StOsmdRko");
                                                    var StOsmd = Ext.data.StoreManager.get("StOsmd");

                                                    //LOGIN & PASSWORD

                                                    //LOGIKA
                                                    var grid = Ext.getCmp('grHousesOsmdAll');
                                                    var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();
                                                    var size = Ext.Object.getSize(gridRowSelectedRecords) ;
                                                    var values =stUser.getAt(0);
                                                    var login = values.get('login');
                                                    var password = values.get('password');
                                                    var params =[];
                                                    if (size >= 1){
                                                        params = {
                                                            login:values.get('login'),
                                                            password:values.get('password'),
                                                            what:"vvod_osmd_rko",
                                                            org_id:org_id

                                                        };
                                                        Ext.Object.each(gridRowSelectedRecords, function(key, val, myself) {
                                                            Ext.Object.merge(val.data, params);
                                                            QueryAddress.updateRecords(val.data,function(results){
                                                                if(results.res){
                                                                    return  true;
                                                                }  else {
                                                                    return  false;
                                                                }
                                                            });

                                                        });

                                                        setTimeout(function(){
                                                            StOsmdRko.load({
                                                                params: {
                                                                    what:'getOsmdRko',
                                                                    login:login,
                                                                    password:password,
                                                                    org_id: org_id
                                                                },
                                                                scope:this
                                                            });
                                                            StOsmd.load({
                                                                params: {
                                                                    what:'OsmdAll',
                                                                    login:login,
                                                                    password:password,
                                                                    org_id: org_id
                                                                },
                                                                scope:this
                                                            });

                                                        }, 1000);
                                                    }else {
                                                        Ext.MessageBox.show({
                                                            title: 'Ошибка ',
                                                            msg: 'Не выбраны дома для добавления в базу РКО',
                                                            buttons: Ext.MessageBox.OK,
                                                            icon: Ext.MessageBox.ERROR
                                                        });
                                                    }
                                                },
                                                disabled: true,
                                                id: 'btnAddHousesRko',
                                                width: 218,
                                                icon: 'resources/css/images/ico/yes.png',
                                                text: 'Добавить ОСМД для РКО '
                                            }
                                        ]
                                    }
                                ],
                                selModel: Ext.create('Ext.selection.CheckboxModel', {
                                    selType: 'checkboxmodel',
                                    mode: 'SIMPLE',
                                    showHeaderCheckbox: true
                                }),
                                columns: [
                                    {
                                        xtype: 'rownumberer'
                                    },
                                    {
                                        xtype: 'numbercolumn',
                                        hidden: true,
                                        width: 50,
                                        dataIndex: 'house_id',
                                        menuDisabled: true,
                                        text: 'ид',
                                        format: '0'
                                    },
                                    {
                                        xtype: 'numbercolumn',
                                        width: 50,
                                        dataIndex: 'osmd_id',
                                        menuDisabled: true,
                                        text: 'ид',
                                        format: '0'
                                    },
                                    {
                                        xtype: 'gridcolumn',
                                        hidden: true,
                                        width: 120,
                                        dataIndex: 'house',
                                        menuDisabled: true,
                                        text: 'Дом'
                                    },
                                    {
                                        xtype: 'gridcolumn',
                                        width: 230,
                                        dataIndex: 'abbr',
                                        menuDisabled: true,
                                        text: 'ОСМД'
                                    },
                                    {
                                        xtype: 'numbercolumn',
                                        hidden: true,
                                        width: 90,
                                        dataIndex: 'edrpou',
                                        text: 'ЕДРПОУ',
                                        format: '0'
                                    }
                                ]
                            }
                        ]
                    }
                ]
            };
        if (instanceConfig) {
            me.getConfigurator().merge(me, config, instanceConfig);
        }
        return me.callParent([config]);
    },

    onComboboxSelect2: function(combo, record, eOpts) {
        //in use

        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StOsmd = Ext.data.StoreManager.get("StOsmd");
        var StOsmdRko = Ext.data.StoreManager.get("StOsmdRko");
        var btnAddHousesRko = Ext.getCmp('btnAddHousesRko');
        var btnDelHousesRko = Ext.getCmp('btnDelHousesRko');


        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');

        //LOGIKA
        if (record) {
            StOsmd.load({
                params: {
                    what:'OsmdAll',
                    login:login,
                    password:password,
                    org_id: record.get('org_id')
                },
                callback: function(records,operation,success){
                    if(success){
                        switch (values.get('role')){
                            case "2":
                            case "5":
                            case "3":
                            case "4":
                                btnAddHousesRko.setDisabled(true);
                                btnDelHousesRko.setDisabled(true);
                                break;
                            case "7":
                                btnAddHousesRko.setDisabled(false);
                                btnDelHousesRko.setDisabled(false);
                                break;
                        }
                    }
                },
                scope:this
            });
        }
        if (record) {
            StOsmdRko.load({
                params: {
                    what:'getOsmdRko',
                    login:login,
                    password:password,
                    org_id: record.get('org_id')
                },
                scope:this
            });
        }
    },

    onRowEditingEdit: function(editor, context, eOpts) {

        var grid = editor.grid;
        var store = grid.getStore();
        var sm = store.getUpdatedRecords();
        var data = grid.getSelectionModel();
        var org_id = sm[0].data.org_id;
        store.proxy.setExtraParam('org_id', org_id);
        //console.log(org_id);
        if(sm.length) {
            store.sync({
                success: function(){

                    store.load();

                }
            });

        } else {
            store.sync({
                success: function(){
                    Ext.MessageBox.show({
                        title: 'Добавление записи',
                        msg: 'Запись добавлена',
                        buttons: Ext.MessageBox.OK,
                        icon: Ext.MessageBox.INFO
                    });

                    store.load();
                }
            });

        }

    }

});