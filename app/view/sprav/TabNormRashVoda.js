/*
 * File: app/view/sprav/TabNormRashVoda.js
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

Ext.define('Ykis.view.sprav.TabNormRashVoda', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.tabnormrashvoda',

    requires: [
        'Ykis.view.sprav.TabNormRashVodaViewModel',
        'Ext.grid.Panel',
        'Ext.view.Table',
        'Ext.panel.Tool',
        'Ext.form.field.TextArea',
        'Ext.grid.column.Number',
        'Ext.form.field.Number',
        'Ext.grid.plugin.RowEditing'
    ],

    viewModel: {
        type: 'tabnormrashvoda'
    },
    id: 'tabNormRashVoda',
    scrollable: true,
    layout: 'fit',
    closable: true,
    shrinkWrapDock: 3,
    title: 'Н.Р.воды',
    defaultListenerScope: true,

    listeners: {
        activate: 'onTabTarifsActivate'
    },

    initConfig: function(instanceConfig) {
        var me = this,
            config = {
                items: [
                    {
                        xtype: 'gridpanel',
                        border: false,
                        id: 'grObjNrv',
                        title: 'Нормы потребления воды по типам строений',
                        store: 'StObjNrv',
                        tools: [
                            {
                                xtype: 'tool',
                                callback: function(owner, tool, event) {
                                    var me = this;
                                    var grid = tool.findParentByType('grid');
                                    var store = grid.store;
                                    var plugin = grid.getPlugin('rowEditTypeVoda');

                                    plugin.cancelEdit();
                                    var newRecord = store.model.create();
                                    store.insert(0, newRecord);
                                    plugin.startEdit(0, 0);
                                },
                                type: 'plus'
                            },
                            {
                                xtype: 'tool',
                                callback: function(owner, tool, event) {
                                    var me = this;

                                    var grid = tool.findParentByType('grid');
                                    var selection = grid.getSelectionModel().getSelection();
                                    var what_id = grid.getSelectionModel().getSelection()[0].data.type_id;
                                    var name = grid.getSelectionModel().getSelection()[0].data.name;
                                    var selected = grid.getSelectionModel().getSelection()[0];

                                    val = {'what':'getObjNrv', 'type_id':what_id};
                                    var StObjNrv = Ext.data.StoreManager.get("StObjNrv");

                                    Ext.MessageBox.show({
                                        title: 'Внимание!',
                                        msg: 'Вы хотите удалить тип: "'+name+'"  Код ('+what_id+')! Удаление повлечет изменения в начислениях!',
                                        buttons: Ext.MessageBox.OKCANCEL,
                                        buttonText:{
                                            ok: "Удалить!",
                                            cancel: "Отмена"
                                        },
                                        fn:function(btn){
                                            if(btn=='ok'){


                                                QuerySprav.destroyRecord(val,function(result){
                                                });

                                                StObjNrv.load();

                                            } else {

                                            }
                                        },
                                        icon: Ext.MessageBox.WARNING
                                    });
                                },
                                type: 'minus'
                            }
                        ],
                        columns: [
                            {
                                xtype: 'gridcolumn',
                                shrinkWrap: 3,
                                width: 348,
                                dataIndex: 'name',
                                text: 'Тип объекта',
                                tooltip: '{name}',
                                editor: {
                                    xtype: 'textareafield',
                                    grow: true
                                }
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 145,
                                dataIndex: 'edizm',
                                text: 'Ед. изм.',
                                editor: {
                                    xtype: 'textfield'
                                }
                            },
                            {
                                xtype: 'gridcolumn',
                                text: 'Норма расхода воды л/сут',
                                columns: [
                                    {
                                        xtype: 'numbercolumn',
                                        dataIndex: 'nrxv',
                                        text: 'Хвода',
                                        format: '0.00',
                                        editor: {
                                            xtype: 'numberfield'
                                        }
                                    },
                                    {
                                        xtype: 'numbercolumn',
                                        dataIndex: 'nrgv',
                                        text: 'Гвода',
                                        format: '0.00',
                                        editor: {
                                            xtype: 'numberfield'
                                        }
                                    }
                                ]
                            },
                            {
                                xtype: 'gridcolumn',
                                text: 'Общий расход воды л/сут',
                                columns: [
                                    {
                                        xtype: 'numbercolumn',
                                        dataIndex: 'nrv',
                                        text: 'с Гвода',
                                        format: '0.00',
                                        editor: {
                                            xtype: 'numberfield'
                                        }
                                    },
                                    {
                                        xtype: 'numbercolumn',
                                        dataIndex: 'nrnogv',
                                        text: 'без Гвода',
                                        format: '0.00',
                                        editor: {
                                            xtype: 'numberfield'
                                        }
                                    }
                                ]
                            },
                            {
                                xtype: 'numbercolumn',
                                dataIndex: 'uxt',
                                text: 'УХТ',
                                flex: 1,
                                format: '0.00',
                                editor: {
                                    xtype: 'numberfield',
                                    decimalPrecision: 6
                                }
                            }
                        ],
                        plugins: [
                            Ext.create('Ext.grid.plugin.RowEditing', {
                                pluginId: 'rowEditTypeVoda',
                                listeners: {
                                    edit: 'onRowEditingEdit'
                                }
                            })
                        ]
                    }
                ]
            };
        if (instanceConfig) {
            me.getConfigurator().merge(me, config, instanceConfig);
        }
        return me.callParent([config]);
    },

    onRowEditingEdit: function(editor, context, eOpts) {

        var grid = editor.grid;
        var store = grid.getStore();
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
                }
            });

        }

    },

    onTabTarifsActivate: function(component, eOpts) {
        var login = Ext.data.StoreManager.get("StUser").getAt(0).get('login');
        var password = Ext.data.StoreManager.get("StUser").getAt(0).get('password');

        /*var StDogTarifs = Ext.data.StoreManager.get("StDogTarifs");
        StDogTarifs.proxy.setExtraParam('what_id', '');
        StDogTarifs.proxy.setExtraParam('login', login);
        StDogTarifs.proxy.setExtraParam('password', password);
        StDogTarifs.load();*/


        var StObjNrv = Ext.data.StoreManager.get("StObjNrv");
        StObjNrv.proxy.setExtraParam('login', login);
        StObjNrv.proxy.setExtraParam('password', password);
        StObjNrv.load();
    }

});