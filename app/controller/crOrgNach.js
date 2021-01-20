/*
 * File: app/controller/crOrgNach.js
 * Date: Wed Dec 09 2020 11:56:29 GMT+0200 (EET)
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

Ext.define('Ykis.controller.crOrgNach', {
    extend: 'Ext.app.Controller',

    refs: {
        WinEditOplataOrg: '#winEditOplataOrg'
    },

    control: {
        "#tabFmOrgOtoplenie": {
            activate: 'onTabFmOrgOtoplenieActivate'
        },
        "#tabFmOrgStoki": {
            activate: 'onTabFmOrgStokiActivate'
        },
        "#tabFmOrgPodogrev": {
            activate: 'onTabFmOrgPodogrevActivate'
        },
        "#tabFmOrgVoda": {
            activate: 'onTabFmOrgVodaActivate'
        },
        "#tabNachFilial": {
            activate: 'onTabNachFilialActivate'
        },
        "#tabFmFilialOtoplenie": {
            activate: 'onTabFmFilialOtoplenieActivate'
        },
        "#tabFmFilialStoki": {
            activate: 'onTabFmFilialStokiActivate'
        },
        "#tabFmFilialPodogrev": {
            activate: 'onTabFmFilialPodogrevActivate'
        },
        "#tabFmFilialVoda": {
            activate: 'onTabFmFilialVodaActivate'
        },
        "#btnVodaFilialUpdate": {
            click: 'onBtnVodaFilialUpdateClick'
        },
        "#btnNormaFilialUpdate": {
            click: 'onBtnNormaFilialUpdateClick'
        },
        "#btnFilialUpdate": {
            click: 'onBtnFilialUpdateClick'
        },
        "#grNachVodaOrg": {
            selectionchange: 'onGrNachVodaOrgSelectionChange'
        },
        "#grNachStokiOrg": {
            selectionchange: 'onGrNachStokiOrgSelectionChange'
        },
        "#grNachPodogrevOrg": {
            selectionchange: 'onGrNachPodogrevOrgSelectionChange'
        },
        "#grNachOtoplenieOrg": {
            selectionchange: 'onGrNachOtoplenieOrgSelectionChange'
        },
        "#grNachVodaFilial": {
            selectionchange: 'onGrNachVodaFilialSelectionChange'
        },
        "#grNachStokiFilial": {
            selectionchange: 'onGrNachStokiFilialSelectionChange'
        },
        "#grNachPodogrevFilial": {
            selectionchange: 'onGrNachPodogrevFilialSelectionChange'
        },
        "#grNachOtoplenieFilial": {
            selectionchange: 'onGrNachOtoplenieFilialSelectionChange'
        },
        "#btnVikFilialAccount": {
            click: 'onBtnVikFilialAccountClick'
        },
        "#btEditOplataOrg": {
            click: 'onBtEditOplataOrgClick'
        }
    },

    onTabFmOrgOtoplenieActivate: function(component, eOpts) {
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StTekNach = Ext.data.StoreManager.get("StTekNachOrg");
        var gridNachisl = Ext.getCmp('grNachOtoplenieOrg');
        //LOGIN & PASSWORD
        var values =stUser.getAt(0);
        // FORM
        var form = component;
        //LOGIKA
        StTekNach.load({
            params: {
                what:'OtoplenieOrg',
                org_id: values.get('org_id'),
                login:values.get('login'),
                password:values.get('password')
            },
            callback: function(records,operation,success){
                if(success){
                    form.getForm().reset();
                    gridNachisl.getView().getSelectionModel().select(0);

                }else{
                    form.getForm().reset();
                }
            },
            scope:this
        });
    },

    onTabFmOrgStokiActivate: function(component, eOpts) {
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StTekNach = Ext.data.StoreManager.get("StTekNachOrg");
        var gridNachisl = Ext.getCmp('grNachStokiOrg');
        //LOGIN & PASSWORD
        var values =stUser.getAt(0);
        // FORM
        var form = component;
        //LOGIKA
        StTekNach.load({
            params: {
                what:'StokiOrg',
                org_id: values.get('org_id'),
                login:values.get('login'),
                password:values.get('password')
            },
            callback: function(records,operation,success){
                if(success){
                    form.getForm().reset();
                    gridNachisl.getView().getSelectionModel().select(0);

                }else{
                    form.getForm().reset();
                }
            },
            scope:this
        });
    },

    onTabFmOrgPodogrevActivate: function(component, eOpts) {
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StTekNach = Ext.data.StoreManager.get("StTekNachOrg");
        var gridNachisl = Ext.getCmp('grNachPodogrevOrg');
        //LOGIN & PASSWORD
        var values =stUser.getAt(0);
        // FORM
        var form = component;
        //LOGIKA
        StTekNach.load({
            params: {
                what:'PodogrevOrg',
                org_id: values.get('org_id'),
                login:values.get('login'),
                password:values.get('password')
            },
            callback: function(records,operation,success){
                if(success){
                    form.getForm().reset();
                    gridNachisl.getView().getSelectionModel().select(0);

                }else{
                    form.getForm().reset();
                }
            },
            scope:this
        });
    },

    onTabFmOrgVodaActivate: function(component, eOpts) {
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StTekNach = Ext.data.StoreManager.get("StTekNachOrg");
        var gridNachisl = Ext.getCmp('grNachVodaOrg');
        console.log(gridNachisl);
        //LOGIN & PASSWORD
        var values =stUser.getAt(0);
        // FORM
        var form = Ext.getCmp('tabFmOrgVoda');
        //LOGIKA
        StTekNach.load({
            params: {
                what:'VodaOrg',
                org_id: values.get('org_id'),
                login:values.get('login'),
                password:values.get('password')
            },
            callback: function(records,operation,success){
                if(success){
                    form.getForm().reset();
                    gridNachisl.getView().getSelectionModel().select(0);

                }else{
                    form.getForm().reset();
                }
            },
            scope:this
        });
    },

    onTabNachFilialActivate: function(component, eOpts) {
        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");
        var StOplata = Ext.data.StoreManager.get("StOplataFilial");
        var stTekNachKassa = Ext.data.StoreManager.get("StTekNachKassaOrg");
        var StFilial = Ext.data.StoreManager.get("StFilial");
        var fmInfoNachFilial = Ext.getCmp('fmInfoNachFilial');
        var fmTekNachKassa = Ext.getCmp('fmTekNachKassaOrg');
        var fmTekNachKassa1 = Ext.getCmp('fmTekNachKassaOrg1');
        var fmTekNachKassa2 = Ext.getCmp('fmTekNachKassaOrg2');
        var fmTekNachKassaOrg = Ext.getCmp('fmTekNachKassaOrg');


        var tabPnNachOrg = Ext.getCmp('tabPnNachFilial');
        var norma = Ext.getCmp('btnNormaFilialUpdate');
        var voda = Ext.getCmp('btnVodaFilialUpdate');
        var filial = Ext.getCmp('btnFilialUpdate');

        //console.log(tabPnNachApp);
        tabPnNachOrg.setActiveTab(0);

        //LOGIN & PASSWORD
        var values =stUser.getAt(0);
        var fmFilialrecord =StFilial.getAt(0);
        fmInfoNachFilial.getForm().loadRecord(fmFilialrecord);


        norma.setDisabled(true);
        voda.setDisabled(true);
        filial.setDisabled(true);
        stTekNachKassa.removeAll();
        fmTekNachKassa.getForm().reset();
        stTekNachKassa.load({
            params: {
                login:values.get('login'),
                password:values.get('password'),
                filial_id: values.get('filial_id'),
                what:'TekNachAllOrg'
            },
            callback: function(records,operation,success){
                //  console.log('1');

                if (success)  {
                    fmTekNachKassa.getForm().findField('date_oplata').setValue(Ext.Date.format(new Date(), 'Y-m-d'));
                    fmTekNachKassa.getForm().findField('prixod_id').setValue("14");
                    fmTekNachKassa.getForm().findField('cbNext1').setValue(false);
                    fmTekNachKassa.getForm().findField('cbNext2').setValue(false);
                    fmTekNachKassa.getForm().findField('cbNext3').setValue(false);
                    fmTekNachKassa.getForm().findField('cbNext4').setValue(false);

                    fmTekNachKassa.getForm().findField('cbDo1').setValue(false);
                    fmTekNachKassa.getForm().findField('cbDo2').setValue(false);
                    fmTekNachKassa.getForm().findField('cbDo3').setValue(false);
                    fmTekNachKassa.getForm().findField('cbDo4').setValue(false);

                    fmTekNachKassa.getForm().findField('cbDo1').setDisabled(false);
                    fmTekNachKassa.getForm().findField('cbDo2').setDisabled(false);
                    fmTekNachKassa.getForm().findField('cbDo3').setDisabled(false);
                    fmTekNachKassa.getForm().findField('cbDo4').setDisabled(false);

                    fmTekNachKassa.getForm().findField('cbNext1').setDisabled(false);
                    fmTekNachKassa.getForm().findField('cbNext2').setDisabled(false);
                    fmTekNachKassa.getForm().findField('cbNext3').setDisabled(false);
                    fmTekNachKassa.getForm().findField('cbNext4').setDisabled(false);

                    fmTekNachKassa.down('#insTekPokKassaOrg').setDisabled(true);
                    fmTekNachKassa.down('#DoAllOrg').setDisabled(false);
                    fmTekNachKassa.down('#DoAllResetOrg').setDisabled(false);
                    fmTekNachKassa.down('#NextAllResetOrg').setDisabled(false);
                    fmTekNachKassa.down('#NextAllOrg').setDisabled(false);

                    if (records.length) {
                        fmTekNachKassa.getForm().loadRecord(records[0]);
                    }
                }

            },
            scope:this
        });
        StOplata.load({
            params: {
                what:'OplataFilial',
                filial_id: values.get('filial_id'),
                login:values.get('login'),
                password:values.get('password')
            },
            scope:this
        });
        fmTekNachKassa1.getForm().reset();
        stTekNachKassa.removeAll();
        stTekNachKassa.load({
            params: {
                login:values.get('login'),
                password:values.get('password'),
                filial_id: values.get('filial_id'),
                what:'TekNachAllOrg1'
            },
            callback: function(records1,operation,success){
                //  console.log('1');

                if (success)  {

                    if (records1.length) {
                        fmTekNachKassa1.getForm().loadRecord(records1[0]);
                    }
                }

            },
            scope:this
        });
        fmTekNachKassa2.getForm().reset();
        stTekNachKassa.removeAll();
        stTekNachKassa.load({
            params: {
                login:values.get('login'),
                password:values.get('password'),
                filial_id: values.get('filial_id'),
                what:'TekNachAllOrg2'
            },
            callback: function(records2,operation,success){
                //  console.log('1');

                if (success)  {

                    if (records2.length) {
                        fmTekNachKassa2.getForm().loadRecord(records2[0]);
                    }
                }

            },
            scope:this
        });

    },

    onTabFmFilialOtoplenieActivate: function(component, eOpts) {
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StTekNach = Ext.data.StoreManager.get("StTekNachFilial");
        var gridNachisl = Ext.getCmp('grNachOtoplenieFilial');
        //LOGIN & PASSWORD
        var values =stUser.getAt(0);
        // FORM
        var form = component;
        //LOGIKA
        StTekNach.load({
            params: {
                what:'OtoplenieFilial',
                filial_id: values.get('filial_id'),
                login:values.get('login'),
                password:values.get('password')
            },
            callback: function(records,operation,success){
                if(success){
                    form.getForm().reset();
                    gridNachisl.getView().getSelectionModel().select(0);

                }else{
                    form.getForm().reset();
                }
            },
            scope:this
        });
    },

    onTabFmFilialStokiActivate: function(component, eOpts) {
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StTekNach = Ext.data.StoreManager.get("StTekNachFilial");
        var gridNachisl = Ext.getCmp('grNachStokiFilial');
        //LOGIN & PASSWORD
        var values =stUser.getAt(0);
        // FORM
        var form = component;
        var norma = Ext.getCmp('btnNormaFilialUpdate');
        var voda = Ext.getCmp('btnVodaFilialUpdate');
        var filial = Ext.getCmp('btnFilialUpdate');
        norma.setDisabled(true);
        voda.setDisabled(true);
        filial.setDisabled(true);
        //LOGIKA
        StTekNach.load({
            params: {
                what:'StokiFilial',
                filial_id: values.get('filial_id'),
                login:values.get('login'),
                password:values.get('password')
            },
            callback: function(records,operation,success){
                if(success){
                    form.getForm().reset();
                    gridNachisl.getView().getSelectionModel().select(0);

                }else{
                    form.getForm().reset();
                }
            },
            scope:this
        });
    },

    onTabFmFilialPodogrevActivate: function(component, eOpts) {
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StTekNach = Ext.data.StoreManager.get("StTekNachFilial");
        var gridNachisl = Ext.getCmp('grNachPodogrevFilial');
        //LOGIN & PASSWORD
        var values =stUser.getAt(0);
        // FORM
        var form = component;
        var norma = Ext.getCmp('btnNormaFilialUpdate');
        var voda = Ext.getCmp('btnVodaFilialUpdate');
        var filial = Ext.getCmp('btnFilialUpdate');
        norma.setDisabled(true);
        voda.setDisabled(true);
        filial.setDisabled(true);

        //LOGIKA
        StTekNach.load({
            params: {
                what:'PodogrevFilial',
                filial_id: values.get('filial_id'),
                login:values.get('login'),
                password:values.get('password')
            },
            callback: function(records,operation,success){
                if(success){
                    form.getForm().reset();
                    gridNachisl.getView().getSelectionModel().select(0);

                }else{
                    form.getForm().reset();
                }
            },
            scope:this
        });
    },

    onTabFmFilialVodaActivate: function(component, eOpts) {
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StTekNach = Ext.data.StoreManager.get("StTekNachFilial");
        var gridNachisl = Ext.getCmp('grNachVodaFilial');
        //LOGIN & PASSWORD
        var values =stUser.getAt(0);
        //console.log(values.get('golovnoe'));

        // FORM
        var formFilial = Ext.getCmp('fmInfoNachFilial');
        var form = Ext.getCmp('tabFmFilialVoda');
        var norma = Ext.getCmp('btnNormaFilialUpdate');
        var voda = Ext.getCmp('btnVodaFilialUpdate');
        var filial = Ext.getCmp('btnFilialUpdate');
        var btnAktSverkiFilialVik = Ext.getCmp('btnAktSverkiFilialVik');



        if(values.get('golovnoe')===1 || values.get('ind')===1){
            norma.setDisabled(false);
            voda.setDisabled(false);
            filial.setDisabled(false);
            btnAktSverkiFilialVik.setDisabled(false);


        } else {
            norma.setDisabled(true);
            voda.setDisabled(true);
            filial.setDisabled(true);
            btnAktSverkiFilialVik.setDisabled(true);


        }
        //LOGIKA
        StTekNach.load({
            params: {
                what:'VodaFilial',
                filial_id: values.get('filial_id'),
                login:values.get('login'),
                password:values.get('password')
            },
            callback: function(records,operation,success){
                if(success){
                    form.getForm().reset();
                    gridNachisl.getView().getSelectionModel().select(0);

                }else{
                    form.getForm().reset();
                }
            },
            scope:this
        });
    },

    onBtnVodaFilialUpdateClick: function(button, e, eOpts) {
        //in use

        //STORE
        var me = this;
        var stUser = Ext.data.StoreManager.get("StUser");
        var grid = Ext.getCmp("grNachVodaFilial");
        var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();
        //console.log(gridRowSelectedRecords);
        var data = gridRowSelectedRecords[0].data.data;
        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            house_id:values.get('house_id'),
            filial_id:values.get('filial_id'),
            data:data,
            what:"update_pokaz_ovodomer_filial"
        };

        //LOGIKA
        QueryVodomer.updateVodomer(params,function(results){
            if (results.success){
                Ext.MessageBox.show({
                    title: 'Обновление  баз начислений по показаниям водосчетчиков',
                    msg: results.msg,
                    buttons: Ext.MessageBox.OK,
                    icon: Ext.MessageBox.INFO
                });
                me.onTabFmFilialVodaActivate();
                /*
                StWaterHouse.load({
                    params: {
                        what:'AllWaterHouse',
                        login:values.get('login'),
                        password:values.get('password')
                    },
                    scope:this
                });
                */
            }
        });
    },

    onBtnNormaFilialUpdateClick: function() {
        //in use

        //STORE
        var me = this;
        var stUser = Ext.data.StoreManager.get("StUser");
        var grid = Ext.getCmp("grNachVodaFilial");
        var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();
        //console.log(gridRowSelectedRecords);
        var data = gridRowSelectedRecords[0].data.data;
        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            house_id:values.get('house_id'),
            filial_id:values.get('filial_id'),
            data:data,
            what:"update_norma_voda_filial"
        };

        //LOGIKA
        QueryVodomer.updateVodomer(params,function(results){
            if (results.success){
                Ext.MessageBox.show({
                    title: 'Обновление  баз начислений по норме',
                    msg: results.msg,
                    buttons: Ext.MessageBox.OK,
                    icon: Ext.MessageBox.INFO
                });
                me.onTabFmFilialVodaActivate();

            }
        });
    },

    onBtnFilialUpdateClick: function() {
        //in use

        //STORE
        var me = this;
        var stUser = Ext.data.StoreManager.get("StUser");
        var grid = Ext.getCmp("grNachVodaFilial");
        var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();
        var data = gridRowSelectedRecords[0].data.data;
        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            house_id:values.get('house_id'),
            filial_id:values.get('filial_id'),
            data:data,
            what:"update_nachislenie_filial"
        };

        //LOGIKA
        QueryVodomer.updateVodomer(params,function(results){
            if (results.success){
                Ext.MessageBox.show({
                    title: 'Свод данных по обьектам организации ',
                    msg: results.msg,
                    buttons: Ext.MessageBox.OK,
                    icon: Ext.MessageBox.INFO
                });
                me.onTabFmFilialVodaActivate();

            }
        });
    },

    onGrNachVodaOrgSelectionChange: function(model, selected, eOpts) {
        var form = Ext.getCmp('tabFmOrgVoda');

        if (selected.length > 0) {
            form.getForm().reset();
            form.getForm().loadRecord(selected[0]);
        }
    },

    onGrNachStokiOrgSelectionChange: function(model, selected, eOpts) {
        var form = Ext.getCmp('tabFmOrgStoki');

        if (selected.length > 0) {
            form.getForm().reset();
            form.getForm().loadRecord(selected[0]);
        }
    },

    onGrNachPodogrevOrgSelectionChange: function(model, selected, eOpts) {
        var form = Ext.getCmp('tabFmOrgPodogrev');

        if (selected.length > 0) {
            form.getForm().reset();
            form.getForm().loadRecord(selected[0]);
        }
    },

    onGrNachOtoplenieOrgSelectionChange: function(model, selected, eOpts) {
        var form = Ext.getCmp('tabFmOrgOtoplenie');

        if (selected.length > 0) {
            form.getForm().reset();
            form.getForm().loadRecord(selected[0]);
        }
    },

    onGrNachVodaFilialSelectionChange: function(model, selected, eOpts) {
        var form = Ext.getCmp('tabFmFilialVoda');

        if (selected.length > 0) {
            form.getForm().reset();
            form.getForm().loadRecord(selected[0]);
        }
    },

    onGrNachStokiFilialSelectionChange: function(model, selected, eOpts) {
        var form = Ext.getCmp('tabFmFilialStoki');

        if (selected.length > 0) {
            form.getForm().reset();
            form.getForm().loadRecord(selected[0]);
        }
    },

    onGrNachPodogrevFilialSelectionChange: function(model, selected, eOpts) {
        var form = Ext.getCmp('tabFmFilialPodogrev');

        if (selected.length > 0) {
            form.getForm().reset();
            form.getForm().loadRecord(selected[0]);
        }
    },

    onGrNachOtoplenieFilialSelectionChange: function(model, selected, eOpts) {
        var form = Ext.getCmp('tabFmFilialOtoplenie');

        if (selected.length > 0) {
            form.getForm().reset();
            form.getForm().loadRecord(selected[0]);
        }
    },

    onBtnVikFilialAccountClick: function(button, e, eOpts) {
        //in use
        var me = this;

        // STORE

        var stUser = Ext.data.StoreManager.get("StUser");

        //Component

        var winReport = me.getWinReport();

        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');

        //LOGIKA
        var id = 'AktPrintVoda';
        var text = 'Счет Вода';
        var qtip = 'Счет Вода';

        values.set({
            'report':id,
            'namereport':text,
            'reportheader':text
        });

        winReport.show();

    },

    onBtEditOplataOrgClick: function(button, e, eOpts) {
        /// in use
        //CONTROLLER
        var value = button.findParentByType('form').getValues();
        var form = button.findParentByType('form');
        var oplata = 0;
        var otoplenie = form.getForm().findField('otoplenie').getValue();
        var podogrev = form.getForm().findField('podogrev').getValue();
        var voda = form.getForm().findField('voda').getValue();
        var stoki = form.getForm().findField('stoki').getValue();
        var summa = parseFloat(form.getForm().findField('summa').getValue()).toFixed(2);
        oplata =parseFloat(otoplenie + podogrev + voda + stoki ).toFixed(2);
        //console.log(summa);
        //console.log(oplata);

        if(summa === oplata) {
            if (summa !== "0") {
                var stUser = Ext.data.StoreManager.get("StUser");
                var values =stUser.getAt(0);
                var vibor = values.get('vibor');
                this.getWinEditOplataOrg().close();
                this.editOplataOrg(value);

            } else {
                Ext.MessageBox.show({
                    title: 'Контроль данных',
                    msg: 'Оплата равна 0',
                    buttons: Ext.MessageBox.OK,
                    icon: Ext.MessageBox.ERROR
                });
            }

        } else {
            Ext.MessageBox.show({
                title: 'Контроль данных',
                msg: 'Не совпадают правая и левая части оплаты',
                buttons: Ext.MessageBox.OK,
                icon: Ext.MessageBox.ERROR
            });
        }
    },

    editOplataOrg: function(value) {
        // in use
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StOplataFilial = Ext.data.StoreManager.get("StOplataFilial");

        //LOGIN & PASSWORD
        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            what:"editOplataOrg"
        };

        //LOGIKA

        Ext.Object.merge(value, params);
        QueryAddress.updateRecords(value,function(results){
            if(results.success==="1"){
                Ext.MessageBox.show({
                    title: 'Редактирование записи  по оплате',
                    msg: results.msg,
                    buttons: Ext.MessageBox.OK,
                    icon: Ext.MessageBox.INFO
                });
                StOplataFilial.load({
                    params: {
                        what:'OplataFilial',
                        filial_id: values.get('filial_id'),
                        login:values.get('login'),
                        password:values.get('password')
                    },
                    scope:this
                });
            } else {
                Ext.MessageBox.show({
                    title: 'Редактирование записи  по оплате',
                    msg: results.msg,
                    buttons: Ext.MessageBox.OK,
                    icon: Ext.MessageBox.ERROR
                });
            }

        });

    }

});
