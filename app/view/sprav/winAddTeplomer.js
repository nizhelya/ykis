/*
 * File: app/view/sprav/winAddTeplomer.js
 * Date: Tue Aug 11 2020 14:52:03 GMT+0300 (EEST)
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

Ext.define('Ykis.view.sprav.winAddTeplomer', {
    extend: 'Ext.window.Window',
    alias: 'widget.winaddteplomer',

    requires: [
        'Ykis.view.sprav.winAddTeplomerViewModel',
        'Ext.form.Panel',
        'Ext.form.FieldContainer',
        'Ext.form.field.Hidden',
        'Ext.button.Button',
        'Ext.form.FieldSet',
        'Ext.form.field.ComboBox',
        'Ext.form.field.Number',
        'Ext.form.field.Date'
    ],

    viewModel: {
        type: 'winaddteplomer'
    },
    height: 554,
    id: 'winAddTeplomer',
    width: 392,
    layout: 'fit',
    title: 'Введення нового приладу обліку',
    modal: true,
    defaultListenerScope: true,

    items: [
        {
            xtype: 'form',
            height: 441,
            id: 'fmAddTeplomer',
            layout: 'fit',
            title: '',
            items: [
                {
                    xtype: 'fieldcontainer',
                    height: 120,
                    style: 'background-color: #DCDCDC;',
                    layout: 'absolute',
                    fieldLabel: '',
                    items: [
                        {
                            xtype: 'hiddenfield',
                            fieldLabel: 'Label',
                            name: 'teplomer_id'
                        },
                        {
                            xtype: 'button',
                            x: 150,
                            y: 480,
                            formBind: true,
                            height: 25,
                            id: 'btAddTeplomer',
                            width: 175,
                            icon: 'resources/css/images/ico/add.png',
                            text: 'Додати прилад обліку'
                        },
                        {
                            xtype: 'button',
                            handler: function(button, event) {
                                this.up('#winAddTeplomer').close();
                            },
                            x: 35,
                            y: 480,
                            width: 105,
                            icon: 'resources/css/images/ico/delete.png',
                            text: 'Скасувати'
                        },
                        {
                            xtype: 'fieldset',
                            x: 35,
                            y: 15,
                            height: 450,
                            style: 'background-color: #e4dbdb;',
                            width: 290,
                            title: 'Характеристика',
                            items: [
                                {
                                    xtype: 'combobox',
                                    anchor: '100%',
                                    formBind: false,
                                    padding: 5,
                                    style: 'background-color: #e4dbdb;',
                                    width: 262,
                                    fieldLabel: 'Модель',
                                    labelWidth: 70,
                                    name: 'model_id',
                                    allowBlank: false,
                                    displayField: 'model',
                                    queryMode: 'local',
                                    store: 'StTmodel',
                                    valueField: 'model_id'
                                },
                                {
                                    xtype: 'textfield',
                                    anchor: '100%',
                                    formBind: false,
                                    padding: 5,
                                    width: 240,
                                    fieldLabel: 'Номер приладу №',
                                    labelWidth: 130,
                                    name: 'nomer',
                                    allowBlank: false,
                                    blankText: 'Поле обязательное для заполнения'
                                },
                                {
                                    xtype: 'combobox',
                                    anchor: '100%',
                                    padding: 5,
                                    width: 240,
                                    fieldLabel: 'Одиниця виміру',
                                    labelWidth: 130,
                                    name: 'edizm',
                                    displayField: 'edizm',
                                    queryMode: 'local',
                                    store: 'StEdIzm',
                                    valueField: 'edizm',
                                    listeners: {
                                        select: 'onComboboxSelect1'
                                    }
                                },
                                {
                                    xtype: 'numberfield',
                                    anchor: '100%',
                                    formBind: false,
                                    id: 'koefEdIzmT',
                                    padding: 5,
                                    width: 240,
                                    fieldLabel: 'коефіцієнт перер',
                                    labelWidth: 130,
                                    name: 'koef',
                                    allowBlank: false,
                                    blankText: 'Поле обязательное для заполнения',
                                    hideTrigger: true,
                                    decimalPrecision: 11
                                },
                                {
                                    xtype: 'fieldset',
                                    anchor: '100%',
                                    height: 140,
                                    padding: 5,
                                    style: 'background-color: #f1eeee;',
                                    width: 240,
                                    title: 'Повірка',
                                    items: [
                                        {
                                            xtype: 'datefield',
                                            anchor: '100%',
                                            padding: 5,
                                            fieldLabel: 'Остання',
                                            labelWidth: 130,
                                            name: 'pdate',
                                            allowBlank: false,
                                            format: 'd-m-Y',
                                            submitFormat: 'Ymd'
                                        },
                                        {
                                            xtype: 'datefield',
                                            anchor: '100%',
                                            padding: 5,
                                            fieldLabel: 'Наступна',
                                            labelWidth: 130,
                                            name: 'fpdate',
                                            format: 'd-m-Y',
                                            submitFormat: 'Ymd'
                                        },
                                        {
                                            xtype: 'textfield',
                                            anchor: '100%',
                                            padding: 5,
                                            fieldLabel: '№ пломби',
                                            labelWidth: 130,
                                            name: 'plomba'
                                        }
                                    ]
                                },
                                {
                                    xtype: 'fieldset',
                                    anchor: '100%',
                                    height: 131,
                                    padding: 5,
                                    style: 'background-color: #f1eeee;',
                                    width: 240,
                                    title: 'Установка',
                                    items: [
                                        {
                                            xtype: 'datefield',
                                            anchor: '100%',
                                            padding: 5,
                                            fieldLabel: 'Дата введення',
                                            labelWidth: 130,
                                            name: 'sdate',
                                            allowBlank: false,
                                            format: 'd-m-Y',
                                            submitFormat: 'Ymd'
                                        },
                                        {
                                            xtype: 'numberfield',
                                            anchor: '100%',
                                            padding: 5,
                                            width: 218,
                                            fieldLabel: 'термін повірки (рік)',
                                            labelWidth: 150,
                                            name: 'pp',
                                            value: 0,
                                            allowBlank: false,
                                            blankText: 'Поле обязательное для заполнения',
                                            hideTrigger: true,
                                            decimalPrecision: 0
                                        },
                                        {
                                            xtype: 'numberfield',
                                            anchor: '100%',
                                            padding: 5,
                                            fieldLabel: 'Первинне показання',
                                            labelWidth: 130,
                                            name: 'tek',
                                            value: 0,
                                            allowBlank: false,
                                            blankText: 'Поле обязательное для заполнения',
                                            hideTrigger: true,
                                            decimalPrecision: 3
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            ]
        }
    ],

    onComboboxSelect1: function(combo, record, eOpts) {
        var koefEdIzm = Ext.getCmp('koefEdIzmT');
        var selected = record;
        if (selected) {
            koefEdIzm.setValue(selected.get('koef'));
        }
    }

});