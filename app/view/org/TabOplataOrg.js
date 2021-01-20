/*
 * File: app/view/org/TabOplataOrg.js
 * Date: Fri Jun 19 2015 15:55:53 GMT+0300 (EEST)
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

Ext.define('Ykis.view.org.TabOplataOrg', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.taboplataorg',

    requires: [
        'Ykis.view.org.TabOplataOrgViewModel',
        'Ext.grid.Panel',
        'Ext.view.Table',
        'Ext.toolbar.Toolbar',
        'Ext.button.Button',
        'Ext.toolbar.Separator',
        'Ext.form.field.Date',
        'Ext.form.field.Hidden',
        'Ext.grid.plugin.BufferedRenderer',
        'Ext.grid.column.Action',
        'Ext.grid.column.Number',
        'Ext.grid.column.Date',
        'Ext.grid.feature.Summary',
        'Ext.grid.feature.GroupingSummary',
        'Ext.XTemplate',
        'Ext.selection.CheckboxModel'
    ],

    viewModel: {
        type: 'taboplataorg'
    },
    height: 759,
    id: 'tabOplataOrg',
    scrollable: true,
    layout: 'fit',
    closable: true,
    title: 'Ввод оплаты',
    defaultListenerScope: true,

    initConfig: function(instanceConfig) {
        var me = this,
            config = {
                items: [
                    {
                        xtype: 'gridpanel',
                        id: 'grOplataOrg',
                        scrollable: true,
                        title: '',
                        store: 'StOplataOrg',
                        viewConfig: {
                            getRowClass: function(record, rowIndex, rowParams, store) {
                                if(record.get('org_id') === 0 ){
                                    return 'change_color_yellow';
                                } else if(record.get('org_id') === 9999 ){
                                    return 'change_color_red';
                                } else if(record.get('opl') === 1 ) {
                                    return  'change_color_green';
                                } else  {
                                    return  'change_color';
                                }

                            },
                            emptyText: 'Нет записей '
                        },
                        dockedItems: [
                            {
                                xtype: 'toolbar',
                                dock: 'top',
                                height: 45,
                                items: [
                                    {
                                        xtype: 'button',
                                        handler: function(button, event) {
                                            var grid = button.findParentByType('grid');
                                            var gr = grid.getView().getFeature('groupOplataOrg');


                                            if (gr.isAllCollapsed() ) {

                                                //  gr.expandAll();
                                            } else {
                                                var myMask= Ext.Msg.show({
                                                    title:'Свернуть...',
                                                    msg: 'Свпрачивание таблиці по группам.Ожидайте...',
                                                    buttons: Ext.Msg.CANCEL,
                                                    wait: true,
                                                    modal: true,
                                                    icon: Ext.Msg.INFO
                                                });
                                                gr.collapseAll();
                                                myMask.close();
                                            }

                                        },
                                        id: 'btnOplataOrgCollExpand',
                                        icon: 'resources/css/images/ico/sprav.png',
                                        text: '',
                                        tooltip: 'Свернуть Развернуть'
                                    },
                                    {
                                        xtype: 'tbseparator'
                                    },
                                    {
                                        xtype: 'button',
                                        handler: function(button, event) {
                                            //in use
                                            var winImport = Ext.ClassManager.instantiateByAlias('widget.winimport');
                                            var form = Ext.getCmp('fmImport');
                                            var vibor =  'debetBank';
                                            winImport.setTitle('Загрузка оплаты из банка Дебет Плюс)');

                                            winImport.show();

                                            form.getForm().findField('vibor').setValue(vibor);


                                        },
                                        id: 'btnImportOplataBank',
                                        width: 124,
                                        icon: 'resources/css/images/ico/door_in.png',
                                        text: 'Импорт банк'
                                    },
                                    {
                                        xtype: 'button',
                                        handler: function(button, event) {
                                            //in use
                                            var winImport = Ext.ClassManager.instantiateByAlias('widget.winimport');
                                            var form = Ext.getCmp('fmImport');
                                            var vibor =  'debetKassa';
                                            winImport.setTitle('Загрузка оплаты из кассы Дебет Плюс)');

                                            winImport.show();

                                            form.getForm().findField('vibor').setValue(vibor);


                                        },
                                        id: 'btnImportOplataKassa',
                                        width: 124,
                                        icon: 'resources/css/images/ico/door_in.png',
                                        text: 'Импорт касса'
                                    },
                                    {
                                        xtype: 'button',
                                        handler: function(button, event) {
                                            //in use
                                            var winImport = Ext.ClassManager.instantiateByAlias('widget.winimport');
                                            var form = Ext.getCmp('fmImport');
                                            var vibor =  'Predoplata';
                                            winImport.setTitle('Загрузка предоплаты Дебет Плюс)');

                                            winImport.show();

                                            form.getForm().findField('vibor').setValue(vibor);


                                        },
                                        id: 'btnImportPredoplata',
                                        width: 156,
                                        icon: 'resources/css/images/ico/door_in.png',
                                        text: 'Импорт предоплата'
                                    },
                                    {
                                        xtype: 'tbseparator'
                                    },
                                    {
                                        xtype: 'datefield',
                                        id: 'dataNachOplataOrg',
                                        width: 193,
                                        fieldLabel: 'Дата',
                                        labelWidth: 55,
                                        format: 'F,Y',
                                        startDay: 1,
                                        submitFormat: 'Ymd',
                                        listeners: {
                                            select: 'onDataNachOplataOrgSelect'
                                        }
                                    },
                                    {
                                        xtype: 'button',
                                        handler: function(button, event) {

                                            var grid = button.findParentByType('grid');
                                            var store = grid.store;

                                            //STORE
                                            var stUser = Ext.data.StoreManager.get("StUser");
                                            var values =stUser.getAt(0);

                                            //LOGIKA
                                            var params = {
                                                login:values.get('login'),
                                                password:values.get('password'),
                                                what:'chekOrgImport'
                                            };


                                            //LOGIKA
                                            var myMask= Ext.Msg.show({
                                                title:'Проверка организаций...',
                                                msg: 'Контроль оплаты по организациям.Ожидайте...',
                                                buttons: Ext.Msg.CANCEL,
                                                wait: true,
                                                modal: true,
                                                icon: Ext.Msg.INFO
                                            });

                                            QueryAddress.updateRecords(params,function(results){
                                                if(results.success==="1"){

                                                    store.load({
                                                        params: {
                                                            what:'getOplataOrg',
                                                            login:values.get('login'),
                                                            password:values.get('password')
                                                        }
                                                    });
                                                    myMask.close();
                                                    Ext.MessageBox.show({
                                                        title: 'Проверка организаций',
                                                        msg: results.msg,
                                                        buttons: Ext.MessageBox.OK,
                                                        icon: Ext.MessageBox.INFO
                                                    });
                                                } else {
                                                    myMask.close();
                                                    Ext.MessageBox.show({
                                                        title: 'Проверка организаций',
                                                        msg: results.msg,
                                                        buttons: Ext.MessageBox.OK,
                                                        icon: Ext.MessageBox.ERROR
                                                    });

                                                }

                                            });
                                        },
                                        id: 'btnCheckOplataOrg',
                                        width: 175,
                                        icon: 'resources/css/images/ico/xsldbg_refresh.png',
                                        text: 'Контроль организаций',
                                        tooltip: 'Свернуть Развернуть'
                                    },
                                    {
                                        xtype: 'tbseparator'
                                    },
                                    {
                                        xtype: 'button',
                                        handler: function(button, event) {
                                            var grid = button.findParentByType('grid');
                                            var store = grid.store;
                                            //STORE
                                            var stUser = Ext.data.StoreManager.get("StUser");
                                            var values =stUser.getAt(0);

                                            //LOGIKA


                                            var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();
                                            var size = Ext.Object.getSize(gridRowSelectedRecords) ;

                                            if (size >= 1){
                                                var  params = {
                                                    login:values.get('login'),
                                                    password:values.get('password'),
                                                    what:"addOplataAllOrg"
                                                };

                                                ///LOGIKA
                                                var myMask= Ext.Msg.show({
                                                    title:'Ввод оплаты по организациям...',
                                                    msg: 'Ввод оплаты по организациям.Ожидайте...',
                                                    buttons: Ext.Msg.CANCEL,
                                                    wait: true,
                                                    modal: true,
                                                    icon: Ext.Msg.INFO
                                                });

                                                Ext.Object.each(gridRowSelectedRecords, function(key, val, myself) {
                                                    Ext.Object.merge(val.data, params);
                                                    QueryAddress.updateRecords(val.data,function(results){
                                                        if(results.res){
                                                            // console.log(results.res);
                                                            return  true;
                                                        }  else {
                                                            return  false;
                                                        }
                                                    });
                                                });

                                                setTimeout(function(){
                                                    store.load({
                                                        params: {
                                                            what:'getOplataOrg',
                                                            login:values.get('login'),
                                                            password:values.get('password')
                                                        }
                                                    });
                                                    myMask.close();
                                                    Ext.MessageBox.show({
                                                        title: 'Ввод оплаты по организациям',
                                                        msg:"Оплата введена",
                                                        buttons: Ext.MessageBox.OK,
                                                        icon: Ext.MessageBox.INFO
                                                    });


                                                }, 1000);
                                            }





                                        },
                                        id: 'btnAddOplataAllOrg',
                                        width: 140,
                                        icon: 'resources/css/images/ico/xsldbg_refresh.png',
                                        text: 'Ввод оплаты',
                                        tooltip: 'Свернуть Развернуть'
                                    },
                                    {
                                        xtype: 'tbseparator'
                                    },
                                    {
                                        xtype: 'tbseparator'
                                    },
                                    {
                                        xtype: 'hiddenfield',
                                        fieldLabel: 'Label',
                                        name: 'usluga'
                                    }
                                ]
                            }
                        ],
                        plugins: [
                            Ext.create('Ext.grid.plugin.BufferedRenderer', {
                                pluginId: 'bufferPort'
                            })
                        ],
                        columns: [
                            {
                                xtype: 'actioncolumn',
                                maxWidth: 25,
                                minWidth: 25,
                                width: 25,
                                menuDisabled: true,
                                items: [
                                    {
                                        getClass: function(v, metadata, r, rowIndex, colIndex, store) {
                                            var out = r.get('opl');
                                            if (out === 0 ) {
                                                metadata = 'x-hide-display';
                                            } else if (out === 1   ){
                                                metadata = 'x-grid-center-icon';
                                            }
                                            return metadata;
                                        },
                                        handler: function(view, rowIndex, colIndex, item, e, record, row) {

                                            var stUser = Ext.data.StoreManager.get("StUser");
                                            var StFilialOpl = Ext.data.StoreManager.get("StFilialOpl");

                                            var values =stUser.getAt(0);

                                            StFilialOpl.load({
                                                params: {
                                                    what:'getFilialOrg',
                                                    login:values.get('login'),
                                                    password:values.get('password'),
                                                    org_id:record.get('org_id')

                                                },
                                                scope:this
                                            });
                                            var winaddoplataorg = Ext.ClassManager.instantiateByAlias('widget.winaddoplataorg');
                                            var form = winaddoplataorg.down('#fmAddOplataOrg');
                                            var value = record;

                                            //console.log(value);
                                            view.getSelectionModel().select(rowIndex);
                                            form.loadRecord(value);
                                            winaddoplataorg.show();
                                        },
                                        icon: 'resources/css/images/ico/edit.png',
                                        tooltip: 'Редактировать оплату'
                                    },
                                    {
                                        getClass: function(v, metadata, r, rowIndex, colIndex, store) {
                                            //console.log(r);
                                            var out = r.get('opl');
                                            //console.log(out);
                                            if (out === 1 ) {
                                                metadata = 'x-hide-display';
                                                //console.log(1);
                                            } else if (out === 0   ){
                                                metadata = 'x-grid-center-icon';
                                                // console.log(0);
                                            }
                                            return metadata;
                                        },
                                        handler: function(view, rowIndex, colIndex, item, e, record, row) {
                                            var stUser = Ext.data.StoreManager.get("StUser");
                                            var StFilialOpl = Ext.data.StoreManager.get("StFilialOpl");

                                            var values =stUser.getAt(0);

                                            StFilialOpl.load({
                                                params: {
                                                    what:'getFilialOrg',
                                                    login:values.get('login'),
                                                    password:values.get('password'),
                                                    org_id:record.get('org_id')

                                                },
                                                scope:this
                                            });
                                            var winaddoplataorg = Ext.ClassManager.instantiateByAlias('widget.winaddoplataorg');
                                            var form = winaddoplataorg.down('#fmAddOplataOrg');
                                            var value = record;

                                            //console.log(value);
                                            view.getSelectionModel().select(rowIndex);
                                            form.loadRecord(value);
                                            winaddoplataorg.show();

                                        },
                                        icon: 'resources/css/images/ico/door_out.png',
                                        tooltip: 'Ввод оплаты'
                                    }
                                ]
                            },
                            {
                                xtype: 'actioncolumn',
                                editRenderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                    var val="";
                                    return val;
                                },
                                width: 30,
                                menuDisabled: true,
                                altText: 'Удалить запись',
                                icon: 'css/images/ico/no.png',
                                items: [
                                    {
                                        handler: function(view, rowIndex, colIndex, item, e, record, row) {
                                            var grid = view.findParentByType('grid');
                                            var store = view.getStore();

                                            Ext.MessageBox.show({
                                                title: 'Внимание!',
                                                msg: 'Вы удаляете запись ! Подтвердите или отмените свои действия!',
                                                buttons: Ext.MessageBox.OKCANCEL,
                                                icon: Ext.MessageBox.WARNING,

                                                buttonText:{
                                                    ok: "Удалить!",
                                                    cancel: "Отмена"
                                                },
                                                fn:function(btn){
                                                    if(btn=='ok'){
                                                        store.remove(record);

                                                        store.sync({
                                                            success: function(){
                                                                Ext.MessageBox.show({title: 'Удаление записи',
                                                                    msg:'Запись удалена',
                                                                    buttons: Ext.MessageBox.OK,
                                                                    icon: Ext.MessageBox.INFO
                                                                });
                                                            },
                                                            failure: function(){
                                                                Ext.MessageBox.show({title: 'Удаление записи',
                                                                    msg:'Запись не удалена',
                                                                    buttons: Ext.MessageBox.OK,
                                                                    icon: Ext.MessageBox.ERROR
                                                                });

                                                            },
                                                            scope: this
                                                        });
                                                    }
                                                }

                                            });
                                        },
                                        icon: 'resources/css/images/ico/no.png'
                                    }
                                ]
                            },
                            {
                                xtype: 'numbercolumn',
                                hidden: true,
                                width: 60,
                                dataIndex: 'rec_id',
                                menuDisabled: true,
                                text: 'Запись',
                                format: '0'
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 90,
                                dataIndex: 'nomer',
                                menuDisabled: true,
                                text: '№ док'
                            },
                            {
                                xtype: 'datecolumn',
                                dataIndex: 'data',
                                menuDisabled: true,
                                text: 'Дата',
                                format: 'd-m-Y',
                                editor: {
                                    xtype: 'datefield',
                                    format: 'd-m-Y',
                                    submitFormat: 'Ymd'
                                }
                            },
                            {
                                xtype: 'numbercolumn',
                                summaryRenderer: function(val, params, data) {
                                    var n =Ext.util.Format.number(val,'0,000.00');
                                    if (val >= 0) {
                                        return '<span style="color:#000; font-weight:bold;">' + n + '</span>';
                                    } else  {
                                        return '<span style="color:red; font-weight:bold;">' + n + '</span>';
                                    }
                                },
                                summaryType: 'sum',
                                width: 85,
                                dataIndex: 'summa',
                                menuDisabled: true,
                                text: 'Оплата'
                            },
                            {
                                xtype: 'gridcolumn',
                                renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                    metaData.style = 'color:#D10000;font-weight:bold;';
                                    var retValue = '';
                                    switch (value) {
                                        case 1:
                                        retValue ='<span><img clas="icon" src="resources/css/images/ico/yes.png"/></span>';
                                        break;
                                        case 0:
                                        retValue ='<span><img clas="icon" src="resources/css/images/ico/delete.png"/></span>';
                                    }
                                    return retValue;
                                },
                                width: 50,
                                dataIndex: 'opl',
                                menuDisabled: true,
                                text: 'опл'
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 55,
                                dataIndex: 'iorg_id',
                                menuDisabled: true,
                                text: 'код'
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 231,
                                dataIndex: 'iname',
                                menuDisabled: true,
                                text: 'Импортируемая организация'
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 55,
                                dataIndex: 'org_id',
                                menuDisabled: true,
                                text: 'код'
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 231,
                                dataIndex: 'sname',
                                menuDisabled: true,
                                text: 'Организация в базе'
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 79,
                                dataIndex: 'edrpou',
                                menuDisabled: true,
                                text: 'ЕДРПОУ'
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 79,
                                dataIndex: 'mfo',
                                menuDisabled: true,
                                text: 'МФО'
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 143,
                                dataIndex: 'rs',
                                menuDisabled: true,
                                text: 'Расч.счет'
                            },
                            {
                                xtype: 'numbercolumn',
                                width: 39,
                                dataIndex: 'pr',
                                menuDisabled: true,
                                text: 'Пр',
                                format: '0'
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 212,
                                dataIndex: 'note',
                                text: 'назначение платежа'
                            }
                        ],
                        features: [
                            {
                                ftype: 'summary'
                            },
                            {
                                ftype: 'groupingsummary',
                                id: 'groupOplataOrg',
                                groupHeaderTpl: [
                                    '{[Ext.Date.format(values.name,"d-m-Y")]}'
                                ]
                            }
                        ],
                        selModel: Ext.create('Ext.selection.CheckboxModel', {
                            selType: 'checkboxmodel'
                        })
                    }
                ]
            };
        if (instanceConfig) {
            me.getConfigurator().merge(me, config, instanceConfig);
        }
        return me.callParent([config]);
    },

    onDataNachOplataOrgSelect: function(field, value, eOpts) {
        //in use

        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StOplataOrg = Ext.data.StoreManager.get("StOplataOrg");

        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');

        //LOGIKA

        if (value) {
            StOplataOrg.load({
                params: {
                    what:'getOplataData',
                    login:login,
                    password:password,
                    data: value
                },
                scope:this
            });
        }
    }

});