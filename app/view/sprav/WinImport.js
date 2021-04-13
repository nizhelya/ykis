/*
 * File: app/view/sprav/WinImport.js
 * Date: Wed Mar 31 2021 11:05:34 GMT+0300 (EEST)
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

Ext.define('Ykis.view.sprav.WinImport', {
    extend: 'Ext.window.Window',
    alias: 'widget.winimport',

    requires: [
        'Ykis.view.sprav.WinImportViewModel',
        'Ext.form.Panel',
        'Ext.form.FieldSet',
        'Ext.button.Button',
        'Ext.form.field.Hidden',
        'Ext.form.field.File'
    ],

    viewModel: {
        type: 'winimport'
    },
    height: 267,
    id: 'winImport',
    width: 414,
    layout: 'fit',
    title: 'Импорт файлов',
    modal: true,

    items: [
        {
            xtype: 'form',
            fileUpload: 'true',
            id: 'fmImport',
            width: 455,
            layout: 'fit',
            bodyPadding: 10,
            title: '',
            items: [
                {
                    xtype: 'fieldset',
                    style: 'background-color: #DCDCDC;',
                    layout: 'absolute',
                    title: '',
                    items: [
                        {
                            xtype: 'button',
                            handler: function(button, e) {

                                var stUser = Ext.data.StoreManager.get("StUser");
                                var values =stUser.getAt(0);



                                var form = button.findParentByType('form');
                                var vibor = form.getForm().findField('vibor').getValue();
                                var usluga_id = form.getForm().findField('usluga_id').getValue();


                                switch (vibor) {
                                    case "lgotnik":
                                    url  = 'resources/php/classes/QueryImportLgota.php';
                                    var StUtszn = Ext.data.StoreManager.get("StUtszn");
                                    var grUtszn = Ext.getCmp('grUtszn');

                                    break;
                                    case "subsidiaOshadBank":
                                    url  = 'resources/php/classes/QueryImportOshadBank.php';
                                    break;
                                    case "lgotaOshadBank":
                                    url  = 'resources/php/classes/QueryImportOshadBank.php';
                                    break;

                                    case "gerz":
                                    var StGerz = Ext.data.StoreManager.get("StGerz");
                                    var grGerz = Ext.getCmp('grGerz');
                                    url  = 'resources/php/classes/QueryImportGerz.php';
                                    break;
                                    case "privatbank":
                                    var StPB = Ext.data.StoreManager.get("StPB");
                                    var grPB = Ext.getCmp('grPB');
                                    url  = 'resources/php/classes/QueryImportPB.php';
                                    break;
                                    case "mtbbank":
                                    var StMTB = Ext.data.StoreManager.get("StMTB");
                                    var StMTB = Ext.getCmp('grMTB');
                                    url  = 'resources/php/classes/QueryImportMTB.php';
                                    break;
                                    case "utszn":
                                    var StLgotnikTab = Ext.data.StoreManager.get("StLgotnikTab");
                                    var grLgotnik = Ext.getCmp('grLgotnik');
                                    url  = 'resources/php/classes/QueryImportUtszn.php';
                                    break;
                                    case "debetBank":
                                    var StOplataOrg = Ext.data.StoreManager.get("StOplataOrg");
                                    var grOplataOrg = Ext.getCmp('grOplataOrg');
                                    url  = 'resources/php/classes/QueryImportOplata.php';
                                    break;
                                    case "debetKassa":
                                    var StOplataOrg = Ext.data.StoreManager.get("StOplataOrg");
                                    var grOplataOrg = Ext.getCmp('grOplataOrg');
                                    url  = 'resources/php/classes/QueryImportKassa.php';
                                    break;
                                    case "Predoplata":
                                    var StOplataOrg = Ext.data.StoreManager.get("StOplataOrg");
                                    var grOplataOrg = Ext.getCmp('grOplataOrg');
                                    url  = 'resources/php/classes/QueryImportPredoplata.php';
                                    break;
                                    default:
                                    var StPort = Ext.data.StoreManager.get("StPort");
                                    var grPort = Ext.getCmp('grPort');
                                    url  = 'resources/php/classes/QueryImport.php';
                                }

                                //console.log(url);

                                if(form.isValid()){
                                    form.submit({
                                        url: url,
                                        buttons: Ext.Msg.CANCEL,
                                        waitMsg: 'Загрузка файла...',
                                        success: function(fp, o) {
                                            Ext.MessageBox.show({
                                                title: 'Загрузка файла',
                                                msg: "Файл загружен",
                                                buttons: Ext.MessageBox.OK,
                                                icon: Ext.MessageBox.Info
                                            });
                                            switch (vibor) {
                                                case "lgotnik":
                                                StUtszn.removeAll();

                                                break;
                                                case "utszn":
                                                StLgotnikTab.load({
                                                    params: {
                                                        what:'update_lgota_from_utszn',
                                                        login:values.get('login'),
                                                        password:values.get('password')
                                                    }
                                                });
                                                grLgotnik.getView().refresh();
                                                break;
                                                case "gerz":
                                                StGerz.load({
                                                    params: {
                                                        what:'getGerz',
                                                        login:values.get('login'),
                                                        password:values.get('password')
                                                    }
                                                });
                                                grGerz.getView().refresh();
                                                break;
                                                case "privatbank":
                                                StPB.load({
                                                    params: {
                                                        what:'getPB',
                                                        login:values.get('login'),
                                                        password:values.get('password')
                                                    }
                                                });
                                                grPB.getView().refresh();
                                                break;
                                                case "mtbbank":
                                                StMTB.load({
                                                    params: {
                                                        what:'getMTB',
                                                        login:values.get('login'),
                                                        password:values.get('password')
                                                    }
                                                });
                                                grMTB.getView().refresh();
                                                break;
                                                case "debetBank":
                                                case "debetKassa":
                                                case "Predoplata":
                                                StOplataOrg.load({
                                                    params: {
                                                        what:'getOplataOrg',
                                                        login:values.get('login'),
                                                        password:values.get('password')
                                                    }
                                                });
                                                grOplataOrg.getView().refresh();
                                                break;

                                            }
                                            button.up('#winImport').close();

                                        },
                                        failure: function (form, action) {
                                            // console.log(Ext.form.action.Action.CONNECT_FAILURE);
                                            switch (action.failureType) {
                                                case Ext.form.action.Action.CLIENT_INVALID:
                                                Ext.Msg.alert('Failure', 'Form fields may not be submitted with invalid values');
                                                break;
                                                case Ext.form.action.Action.CONNECT_FAILURE:
                                                Ext.Msg.alert('Failure', 'Ajax communication failed');
                                                break;
                                                case Ext.form.action.Action.SERVER_INVALID:
                                                Ext.Msg.alert('Failure', "server");
                                            }
                                        }
                                    });

                                }
                            },
                            x: 255,
                            y: 115,
                            formBind: true,
                            height: 30,
                            id: 'btImport',
                            width: 100,
                            icon: 'resources/css/images/ico/add.png',
                            text: 'Загрузить'
                        },
                        {
                            xtype: 'hiddenfield',
                            x: 10,
                            y: 70,
                            fieldLabel: 'Label',
                            name: 'vibor'
                        },
                        {
                            xtype: 'hiddenfield',
                            x: 10,
                            y: 70,
                            fieldLabel: 'Label',
                            name: 'usluga_id'
                        },
                        {
                            xtype: 'button',
                            handler: function(button, event) {
                                button.up('#winImport').close();
                            },
                            x: 20,
                            y: 120,
                            height: 30,
                            width: 80,
                            icon: 'resources/css/images/ico/delete.png',
                            text: 'Отмена'
                        },
                        {
                            xtype: 'filefield',
                            x: 20,
                            y: 30,
                            id: 'fileUpload',
                            width: 330,
                            fieldLabel: 'Файла',
                            labelWidth: 50,
                            name: 'filedata',
                            allowBlank: false,
                            buttonText: 'Просмотр'
                        }
                    ]
                }
            ]
        }
    ]

});