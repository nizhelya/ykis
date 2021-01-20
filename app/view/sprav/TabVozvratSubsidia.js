/*
 * File: app/view/sprav/TabVozvratSubsidia.js
 * Date: Tue May 12 2020 01:39:10 GMT+0300 (EEST)
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

Ext.define('Ykis.view.sprav.TabVozvratSubsidia', {
    extend: 'Ext.form.Panel',
    alias: 'widget.tabvozvratsubsidia',

    requires: [
        'Ykis.view.sprav.TabVozvratSubsidiaViewModel',
        'Ext.grid.Panel',
        'Ext.toolbar.Toolbar',
        'Ext.form.field.ComboBox',
        'Ext.form.field.Date',
        'Ext.button.Button',
        'Ext.grid.column.Date',
        'Ext.grid.column.Number',
        'Ext.view.Table',
        'Ext.grid.feature.Grouping',
        'Ext.XTemplate',
        'Ext.grid.filters.Filters'
    ],

    viewModel: {
        type: 'tabvozvratsubsidia'
    },
    height: 826,
    id: 'tabVozvratSubsidia',
    width: 1117,
    layout: 'fit',
    closable: true,
    title: 'Возврат субсидий',
    defaultListenerScope: true,

    items: [
        {
            xtype: 'gridpanel',
            split: true,
            lockedGridConfig: {
                header: false,
                collapsible: true,
                width: 160,
                forceFit: true
            },
            lockedViewConfig: {
                scroll: 'horizontal'
            },
            height: 746,
            title: '',
            store: 'StVsubsidia',
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'top',
                    style: 'background-color: #e0e0e0;',
                    items: [
                        {
                            xtype: 'combobox',
                            width: 241,
                            fieldLabel: 'услуга',
                            labelWidth: 60,
                            name: 'usluga_id',
                            displayField: 'usluga',
                            queryMode: 'local',
                            store: 'StUsluga',
                            valueField: 'usluga_id',
                            listeners: {
                                select: 'onComboboxSelect211'
                            }
                        },
                        {
                            xtype: 'datefield',
                            disabled: true,
                            id: 'sdate_subsidia',
                            width: 227,
                            fieldLabel: 'Период  от',
                            labelWidth: 70,
                            name: '',
                            format: 'F,Y'
                        },
                        {
                            xtype: 'datefield',
                            disabled: true,
                            id: 'fdate_subsidia',
                            width: 201,
                            fieldLabel: 'до',
                            labelWidth: 40,
                            format: 'F,Y'
                        },
                        {
                            xtype: 'button',
                            handler: function(button, e) {
                                //COMBO

                                var stUser = Ext.data.StoreManager.get("StUser");
                                var values =stUser.getAt(0);
                                var grid = button.findParentByType('grid');
                                var store = grid.store;
                                var sdate_subsidia =  Ext.getCmp('sdate_subsidia').getValue();
                                var fdate_subsidia =  Ext.getCmp('fdate_subsidia').getValue();

                                //  console.log(fdate_subsidia);


                                if (sdate_subsidia !== null  &&  fdate_subsidia !== null ) {

                                    //STORE

                                    //LOGIKA
                                    var params = {
                                        login:values.get('login'),
                                        password:values.get('password'),
                                        usluga_id:values.get('usluga_id'),
                                        sdate:sdate_subsidia,
                                        fdate:fdate_subsidia,
                                        what:'update_vozvrat_subsidia'
                                    };
                                    //console.log(params);

                                    //LOGIKA
                                    var myMask= Ext.Msg.show({
                                        title:'Обновление записи...',
                                        msg: 'Обновление записей в базе Ожидайте...',
                                        buttons: Ext.Msg.CANCEL,
                                        wait: true,
                                        modal: true,
                                        icon: Ext.Msg.INFO
                                    });

                                    QueryAddress.updateRecords(params,function(results){
                                        if(results.success==="1"){
                                            store.load({
                                                params: {
                                                    what:'getSubsidiaVozvrat',
                                                    login:values.get('login'),
                                                    password:values.get('password')
                                                }
                                            });

                                            myMask.close();
                                            Ext.MessageBox.show({
                                                title: 'Обновление базы Субсидия',
                                                msg: results.msg,
                                                buttons: Ext.MessageBox.OK,
                                                icon: Ext.MessageBox.INFO
                                            });
                                        } else {
                                            myMask.close();
                                            Ext.MessageBox.show({
                                                title: 'Обновление базы Субсидия',
                                                msg: results.msg,
                                                buttons: Ext.MessageBox.OK,
                                                icon: Ext.MessageBox.ERROR
                                            });

                                        }

                                    });

                                }else{
                                    Ext.MessageBox.show({
                                        title: 'Ошибка ',
                                        msg: 'Не выбраны даты для загрузки',
                                        buttons: Ext.MessageBox.OK,
                                        icon: Ext.MessageBox.ERROR
                                    });
                                }
                            },
                            disabled: true,
                            id: 'btnInsVozvratSubsidia',
                            width: 95,
                            text: 'Загрузить'
                        },
                        {
                            xtype: 'button',
                            handler: function(button, e) {
                                //in use
                                var me = this;
                                var StUser = Ext.data.StoreManager.get("StUser");
                                var values =StUser.getAt(0);
                                var sdate_subsidia =  Ext.getCmp('sdate_subsidia').getValue();
                                var fdate_subsidia =  Ext.getCmp('fdate_subsidia').getValue();
                                if (sdate_subsidia !== null  &&  fdate_subsidia !== null ) {

                                    var tabPnCenter =  Ext.getCmp('tabPnCenter');//me.getTabPnCenter();

                                    var report = 'ReportVozvratSubsidia';
                                    var namereport = 'Отчет субсидий';
                                    var value = {
                                        login:values.get('login'),
                                        password:values.get('password'),
                                        sdate:sdate_subsidia,
                                        fdate:fdate_subsidia,
                                        usluga_id:values.get('usluga_id'),
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
                                    //console.log(value);

                                    tabPnCenter.setActiveTab(tab);
                                    var reppan = tab.getComponent(0);
                                    // Basic mask:
                                    var myMask= Ext.Msg.show({
                                        title:'Загрузка...',
                                        msg: 'Загрузка отчета .Ожидайте...',
                                        buttons: Ext.Msg.CANCEL,
                                        wait: true,
                                        modal: true,
                                        icon: Ext.Msg.INFO
                                    });
                                    QueryReport.getResults(value,function(data){
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
                                }else{
                                    Ext.MessageBox.show({
                                        title: 'Ошибка ',
                                        msg: 'Не выбраны даты для загрузки',
                                        buttons: Ext.MessageBox.OK,
                                        icon: Ext.MessageBox.ERROR
                                    });
                                }

                            },
                            disabled: true,
                            id: 'btnReportVozvratSubsidia',
                            width: 95,
                            text: 'Отчет'
                        },
                        {
                            xtype: 'button',
                            handler: function(button, e) {
                                //COMBO

                                var stUser = Ext.data.StoreManager.get("StUser");
                                var values =stUser.getAt(0);
                                var params = {
                                    login:values.get('login'),
                                    password:values.get('password'),
                                    usluga_id:values.get('usluga_id'),
                                    what:'insOplataSubsidiaVozvrat'
                                };
                                //console.log(params);

                                //LOGIKA
                                var myMask= Ext.Msg.show({
                                    title:'Возврат субсидий...',
                                    msg: 'Возврат субсидий в базу оплаты Ожидайте...',
                                    buttons: Ext.Msg.CANCEL,
                                    wait: true,
                                    modal: true,
                                    icon: Ext.Msg.INFO
                                });

                                QueryAddress.updateRecords(params,function(results){
                                    if(results.success==="1"){


                                        myMask.close();
                                        Ext.MessageBox.show({
                                            title: 'Возврат субсидий в базу оплаты',
                                            msg: results.msg,
                                            buttons: Ext.MessageBox.OK,
                                            icon: Ext.MessageBox.INFO
                                        });
                                    } else {
                                        myMask.close();
                                        Ext.MessageBox.show({
                                            title: 'Возврат субсидий в базу оплаты',
                                            msg: results.msg,
                                            buttons: Ext.MessageBox.OK,
                                            icon: Ext.MessageBox.ERROR
                                        });

                                    }

                                });


                            },
                            disabled: true,
                            id: 'btnInsOplataVozvratSubsidia',
                            width: 179,
                            text: 'Возврат субсидий'
                        }
                    ]
                }
            ],
            columns: [
                {
                    xtype: 'gridcolumn',
                    hidden: true,
                    dataIndex: 'address',
                    text: 'адрес'
                },
                {
                    xtype: 'datecolumn',
                    width: 120,
                    dataIndex: 'data',
                    hideable: false,
                    locked: true,
                    menuDisabled: true,
                    text: 'Адрес',
                    flex: 1,
                    format: 'F,Y'
                },
                {
                    xtype: 'numbercolumn',
                    items: {
                        xtype: 'textfield',
                        flex: 1,
                        margin: 2,
                        enableKeyEvents: true,
                        listeners: {
                            keyup: function() {
                                            var store = this.up('tablepanel').store;
                                            store.clearFilter();
                                            if (this.value) {
                                                store.filter({
                                                    property     : 'address_id',
                                                    value         : this.value,
                                                    anyMatch      : true,
                                                    caseSensitive : false
                                                });
                                            }
                                        },
                            buffer: 1000
                        }
                    },
                    width: 64,
                    dataIndex: 'address_id',
                    menuDisabled: true,
                    text: 'Ид',
                    format: '0'
                },
                {
                    xtype: 'gridcolumn',
                    menuDisabled: true,
                    text: 'Начисление и оплата в периоде',
                    columns: [
                        {
                            xtype: 'numbercolumn',
                            width: 140,
                            dataIndex: 'oplacheno',
                            menuDisabled: true,
                            text: 'Оплата в периоде',
                            format: '0.00'
                        },
                        {
                            xtype: 'numbercolumn',
                            width: 162,
                            dataIndex: 'subs',
                            menuDisabled: true,
                            text: 'Субсидия(об платеж)',
                            format: '0.00'
                        },
                        {
                            xtype: 'numbercolumn',
                            width: 111,
                            dataIndex: 'subsidia',
                            menuDisabled: true,
                            text: 'Субсидия(Ст)',
                            format: '0.00'
                        },
                        {
                            xtype: 'numbercolumn',
                            width: 127,
                            sortable: true,
                            dataIndex: 'nachisleno',
                            menuDisabled: true,
                            text: 'Начислено(Нт)',
                            format: '0.00'
                        }
                    ]
                },
                {
                    xtype: 'gridcolumn',
                    menuDisabled: true,
                    text: 'Возврат(Nт = Ст - Нт + От)',
                    columns: [
                        {
                            xtype: 'numbercolumn',
                            width: 69,
                            dataIndex: 'dolg',
                            menuDisabled: true,
                            text: 'От',
                            format: '0.00'
                        },
                        {
                            xtype: 'numbercolumn',
                            width: 80,
                            dataIndex: 'vozvrat',
                            menuDisabled: true,
                            text: 'Nт',
                            format: '0.00'
                        },
                        {
                            xtype: 'numbercolumn',
                            width: 92,
                            dataIndex: 'koplate',
                            menuDisabled: true,
                            text: 'к возврату',
                            format: '0.00'
                        }
                    ]
                }
            ],
            viewConfig: {
                getRowClass: function(record, rowIndex, rowParams, store) {
                    if(record.get('gr') === 1 )
                    {
                        return 'change_color_green';
                    } else if(record.get('gr') === 2 ){
                        return 'change_color_red';
                    }
                }
            },
            features: [
                {
                    ftype: 'grouping',
                    id: 'groupVozvrat',
                    groupHeaderTpl: [
                        '{name}'
                    ]
                }
            ],
            plugins: [
                {
                    ptype: 'gridfilters'
                }
            ]
        }
    ],

    onComboboxSelect211: function(combo, record, eOpts) {
        var stUser = Ext.data.StoreManager.get("StUser");
        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');

        var btnInsVozvratSubsidia =  Ext.getCmp('btnInsVozvratSubsidia');
        var btnReportVozvratSubsidia =  Ext.getCmp('btnReportVozvratSubsidia');
        var btnInsOplataVozvratSubsidia =  Ext.getCmp('btnInsOplataVozvratSubsidia');
        var sdate_subsidia =  Ext.getCmp('sdate_subsidia');
        var fdate_subsidia =  Ext.getCmp('fdate_subsidia');
        // var usluga_id = form.getForm().findField('usluga_id').getValue();
        // console.log(usluga_id);
        if (record) {
            values.set({'usluga_id':record.get('usluga_id')});
            stUser.sync();
            fdate_subsidia.setDisabled(false);
            sdate_subsidia.setDisabled(false);
            btnInsVozvratSubsidia.setDisabled(false);
            btnReportVozvratSubsidia.setDisabled(false);
            btnInsOplataVozvratSubsidia.setDisabled(false);


        }
    }

});