/*
 * File: app/view/sprav/TabWorkGrafik.js
 * Date: Fri Oct 09 2015 01:02:11 GMT+0300 (EEST)
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

Ext.define('Ykis.view.sprav.TabWorkGrafik', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.tabworkgrafik',

    requires: [
        'Ykis.view.sprav.TabWorkGrafikViewModel',
        'Ext.grid.Panel',
        'Ext.view.Table',
        'Ext.panel.Tool',
        'Ext.grid.plugin.RowEditing',
        'Ext.grid.column.Date',
        'Ext.form.field.Date',
        'Ext.grid.column.Number',
        'Ext.form.field.Number',
        'Ext.grid.feature.Grouping'
    ],

    viewModel: {
        type: 'tabworkgrafik'
    },
    id: 'tabWorkGrafik',
    layout: 'fit',
    closable: true,
    title: 'График работы',
    defaultListenerScope: true,

    listeners: {
        activate: 'onTabWorkGrafikActivate'
    },

    initConfig: function(instanceConfig) {
        var me = this,
            config = {
                items: [
                    {
                        xtype: 'gridpanel',
                        id: 'grWorkGrafik',
                        collapseDirection: 'top',
                        title: 'График работы дневного персонала',
                        store: 'StGrafikWork',
                        tools: [
                            {
                                xtype: 'tool',
                                id: 'btnGrWorkGrafikAdd',
                                tooltip: 'Добавить запись',
                                type: 'plus',
                                listeners: {
                                    click: 'onBtnGrWorkGrafikAddClick'
                                }
                            },
                            {
                                xtype: 'tool',
                                disabled: true,
                                id: 'btnGrWorkGrafikRemove',
                                tooltip: 'Удалить запись',
                                type: 'minus',
                                listeners: {
                                    click: 'onBtnGrWorkGrafikRemoveClick'
                                }
                            }
                        ],
                        plugins: [
                            Ext.create('Ext.grid.plugin.RowEditing', {
                                pluginId: 'rowEditGrafik',
                                listeners: {
                                    edit: 'onRowEditingEdit'
                                }
                            })
                        ],
                        columns: [
                            {
                                xtype: 'datecolumn',
                                width: 74,
                                dataIndex: 'god',
                                menuDisabled: true,
                                text: 'Год',
                                format: 'Y'
                            },
                            {
                                xtype: 'datecolumn',
                                width: 123,
                                dataIndex: 'data',
                                menuDisabled: true,
                                text: 'Период',
                                format: 'Y,F',
                                editor: {
                                    xtype: 'datefield',
                                    altFormats: 'm/d/Y|n/j/Y|n/j/y|m/j/y|n/d/y|m/j/Y|n/d/Y|m-d-y|m-d-Y|m/d|m-d|md|mdy|mdY|d|Y-m-d|n-j|n/j|dmY|Ymd',
                                    format: 'Y,F',
                                    submitFormat: 'Y-m-d'
                                }
                            },
                            {
                                xtype: 'numbercolumn',
                                summaryType: 'sum',
                                width: 159,
                                dataIndex: 'kalendar_hour',
                                menuDisabled: true,
                                text: 'Часы по календарю',
                                format: '0',
                                editor: {
                                    xtype: 'numberfield'
                                }
                            },
                            {
                                xtype: 'numbercolumn',
                                summaryType: 'sum',
                                width: 112,
                                dataIndex: 'work_day',
                                menuDisabled: true,
                                text: 'Рабочие дни',
                                format: '0',
                                editor: {
                                    xtype: 'numberfield'
                                }
                            },
                            {
                                xtype: 'numbercolumn',
                                summaryType: 'sum',
                                width: 126,
                                dataIndex: 'grafik_hour',
                                menuDisabled: true,
                                text: 'Дни с гор водой',
                                format: '0',
                                editor: {
                                    xtype: 'numberfield'
                                }
                            }
                        ],
                        listeners: {
                            selectionchange: 'onGrWorkGrafikSelectionChange'
                        },
                        features: [
                            {
                                ftype: 'grouping',
                                id: 'groupGrafikWork'
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

    onBtnGrWorkGrafikAddClick: function(tool, e, owner, eOpts) {
        var me = this;
        var grid = tool.findParentByType('grid');
        var gr = grid.getView().getFeature('groupGrafikWork');
        var store = grid.store;
        var sm = grid.getSelectionModel();
        var plugin = grid.getPlugin('rowEditGrafik');
        var dt = new Date();

        plugin.cancelEdit();
        gr.disable();

        var dataNew = Ext.Date.format(dt, 'Ymd');

        var god = Ext.Date.format(dt, 'Y');
        var newRecord = store.model.create();
        newRecord = {god:god,data:dataNew,kalendar_hour:'0',grafik_hour:'0',work_day:'0'};
        //console.log(newRecord);
        store.insert(0, newRecord);
        plugin.startEdit(0, 0);
    },

    onBtnGrWorkGrafikRemoveClick: function(tool, e, owner, eOpts) {
        var grid = tool.findParentByType('grid');
        var rowEditGrafik = grid.getPlugin('rowEditGrafik');
        rowEditGrafik.cancelEdit();
        var store = grid.store;
        store.proxy.setExtraParam('what', 'getGrafikWorkDays');
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
        var gr = grid.getView().getFeature('groupGrafikWork');
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

    onGrWorkGrafikSelectionChange: function(model, selected, eOpts) {
        var btn  = this.down('#btnGrWorkGrafikRemove');
        btn.setDisabled(false);
    },

    onTabWorkGrafikActivate: function(component, eOpts) {
        //in use
        var stGrafikWork = Ext.data.StoreManager.get("StGrafikWork");
        stGrafikWork.proxy.setExtraParam('what', 'getGrafikWorkDays');

        stGrafikWork.load();
    }

});