/*
 * File: app/view/sprav/TabTemp.js
 * Date: Mon Feb 03 2020 23:06:54 GMT+0200 (EET)
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

Ext.define('Ykis.view.sprav.TabTemp', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.tabtemp',

    requires: [
        'Ykis.view.sprav.TabTempViewModel',
        'Ext.grid.Panel',
        'Ext.view.Table',
        'Ext.panel.Tool',
        'Ext.grid.plugin.RowEditing',
        'Ext.grid.column.Date',
        'Ext.form.field.Date',
        'Ext.grid.column.Number',
        'Ext.form.field.Number',
        'Ext.grid.column.Boolean',
        'Ext.form.field.Checkbox',
        'Ext.grid.feature.Grouping'
    ],

    viewModel: {
        type: 'tabtemp'
    },
    id: 'tabTemp',
    closable: true,
    title: 'Температура',
    defaultListenerScope: true,

    listeners: {
        activate: 'onTabTempActivate'
    },

    initConfig: function(instanceConfig) {
        var me = this,
            config = {
                items: [
                    {
                        xtype: 'gridpanel',
                        id: 'grTemp',
                        collapseDirection: 'top',
                        title: 'Средняя расчетная температура нарухного воздуха за период',
                        store: 'StTemp',
                        tools: [
                            {
                                xtype: 'tool',
                                id: 'btnGrTempAdd',
                                tooltip: 'Добавить запись',
                                tooltipType: 'title',
                                type: 'plus',
                                listeners: {
                                    click: 'onBtnGrTempAddClick'
                                }
                            },
                            {
                                xtype: 'tool',
                                id: 'btnGrTempRemove',
                                tooltip: 'Удалить запись',
                                type: 'minus',
                                listeners: {
                                    click: 'onBtnGrTempRemoveClick'
                                }
                            }
                        ],
                        plugins: [
                            Ext.create('Ext.grid.plugin.RowEditing', {
                                pluginId: 'rowEditTemperature',
                                listeners: {
                                    edit: 'onRowEditingEdit'
                                }
                            })
                        ],
                        columns: [
                            {
                                xtype: 'datecolumn',
                                dataIndex: 'god',
                                menuDisabled: true,
                                text: 'Год',
                                format: 'Y'
                            },
                            {
                                xtype: 'datecolumn',
                                width: 120,
                                dataIndex: 'data',
                                menuDisabled: true,
                                text: 'Период',
                                format: 'F,Y',
                                editor: {
                                    xtype: 'datefield',
                                    format: 'd-m-Y',
                                    submitFormat: 'Ymd'
                                }
                            },
                            {
                                xtype: 'numbercolumn',
                                summaryType: 'average',
                                width: 120,
                                dataIndex: 'temp',
                                menuDisabled: true,
                                text: 'Температура',
                                format: '0.00',
                                editor: {
                                    xtype: 'numberfield',
                                    step: 0.1
                                }
                            },
                            {
                                xtype: 'booleancolumn',
                                dataIndex: 'otoplenie',
                                menuDisabled: true,
                                text: 'Отопление',
                                falseText: 'отключено',
                                trueText: 'Включено',
                                editor: {
                                    xtype: 'checkboxfield',
                                    boxLabel: 'Вкл',
                                    inputValue: '1'
                                }
                            },
                            {
                                xtype: 'numbercolumn',
                                width: 130,
                                dataIndex: 'day_ot',
                                menuDisabled: true,
                                text: 'Дней с отопл',
                                format: '0',
                                editor: {
                                    xtype: 'numberfield'
                                }
                            },
                            {
                                xtype: 'numbercolumn',
                                dataIndex: 'day_gv',
                                menuDisabled: true,
                                text: 'Дней с Гв ',
                                format: '0',
                                editor: {
                                    xtype: 'numberfield'
                                }
                            }
                        ],
                        listeners: {
                            selectionchange: 'onGrTempSelectionChange'
                        },
                        features: [
                            {
                                ftype: 'grouping',
                                id: 'groupTemp'
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

    onBtnGrTempAddClick: function(tool, e, owner, eOpts) {
        var me = this;
        var grid = tool.findParentByType('grid');
        var gr = grid.getView().getFeature('groupTemp');
        //console.log(gr);
        var store = grid.store;
        //store.proxy.setExtraParam('what', 'insTemperature');
        var sm = grid.getSelectionModel();
        var plugin = grid.getPlugin('rowEditTemperature');
        var dt = new Date();
        plugin.cancelEdit();
        gr.disable();

        var what = "insTemperature";
        var dataNew = Ext.Date.format(dt, 'Ymd');
        var god = Ext.Date.format(dt, 'Y');
        var newRecord = store.model.create();

        var mec =  Ext.Date.format(dt, 'n');
        var otopl = 0;
        var qty_day = 0;

        if(mec > 5 && mec < 10){
            otopl = 0;
            qty_day = 0;
        } else {
            otopl = 1;
            qty_day = Ext.Date.format(dt, 't');
        }
        newRecord = {god:god,data:dataNew,temp:0,otoplenie:otopl,day_ot:qty_day,day_gv:qty_day,what:what};
        store.insert(0, newRecord);
        plugin.startEdit(0,0);
    },

    onBtnGrTempRemoveClick: function(tool, e, owner, eOpts) {
        var grid = tool.findParentByType('grid');
        var plugin = grid.getPlugin('rowEditTemperature');
        plugin.cancelEdit();
        var store = grid.store;
        store.proxy.setExtraParam('what', 'getTemperature');
        var selected = grid.getSelectionModel().getSelection();

        Ext.MessageBox.show({
            title: 'Внимание!',
            msg: 'Вы удаляете данные ! Подтвердите свои действия!',
            buttons: Ext.MessageBox.OKCANCEL,
            icon: Ext.MessageBox.WARNING,

            buttonText:{
                ok: "Удалить!",
                cancel: "Отмена"
            },
            fn:function(btn){
                if(btn=='ok'){
                    store.remove(selected);

                    store.sync({
                        success: function(){
                            Ext.MessageBox.show({title: 'Удаление записи',
                                msg:'Запись удалена',
                                buttons: Ext.MessageBox.OK,
                                icon: Ext.MessageBox.INFO
                            });
                        },
                        failure: function(){



                        },
                        scope: this
                    });
                }
            }

        });
    },

    onRowEditingEdit: function(editor, context, eOpts) {

        var grid = editor.grid;
        var gr = grid.getView().getFeature('groupTemp');
        var store = grid.getStore();
        //store.proxy.setExtraParam('what', 'getTemperature');

        var sm = store.getUpdatedRecords();
        var data = grid.getSelectionModel();

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
                    gr.enable();
                }
            });

        }

    },

    onGrTempSelectionChange: function(model, selected, eOpts) {
        var btn  = this.down('#btnGrTempRemove');
        btn.setDisabled(false);
    },

    onTabTempActivate: function(component, eOpts) {
        /*
        //console.log('---');

        var login = Ext.data.StoreManager.get("StUser").getAt(0).get('login');
        var password = Ext.data.StoreManager.get("StUser").getAt(0).get('password');

        var StTemp = Ext.data.StoreManager.get("StTemp");

        StTemp.proxy.setExtraParam('what_id', '');
        StTemp.proxy.setExtraParam('login', login);
        StTemp.proxy.setExtraParam('password', password);
        StTemp.load();
        */
    }

});