/*
 * File: app/controller/CrOrgVodomer.js
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

Ext.define('Ykis.controller.CrOrgVodomer', {
    extend: 'Ext.app.Controller',
    alias: 'controller.crOrgVodomer',

    refs: {
        FmOrgVodomer: '#fmOrgVodomer',
        GrAllPokOrgVod: '#grAllPokOrgVod',
        pnOrgVodomer: '#pnOrgVodomer'
    },

    control: {
        "#tabOrgVodomer": {
            activate: 'onTabOrgVodomerActivate'
        },
        "#insTekPokOrgVodMiddle": {
            click: 'onInsTekPokOrgVodMiddleClick'
        },
        "#insHandPokOrgVod": {
            click: 'onInsHandPokOrgVodClick'
        },
        "#grOrgHVodomer": {
            selectionchange: 'onGrOrgHVodomerSelectionChange'
        },
        "#newValueOrg": {
            specialkey: 'onNewValueOrgSpecialkey'
        },
        "#grOrgVodomer": {
            selectionchange: 'onGrOrgVodomerSelectionChange'
        },
        "#aktOplombirovkiOrg": {
            click: 'onAktOplombirovkiOrgClick'
        },
        "#addOrgVodomer": {
            click: 'onAddOrgVodomerClick'
        },
        "#grAllPokOrgVod": {
            selectionchange: 'onGrAllPokOrgVodSelectionChange'
        }
    },

    onTabOrgVodomerActivate: function(component, eOpts) {
        //in use
        var me =this;
        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");
        var stVodomer = Ext.data.StoreManager.get("StOrgVodomer");//QueryOrgVodomer.getResults  <AppVodomer>
        var stHVodomer = Ext.data.StoreManager.get("StOrgHVodomer");//QueryOrgVodomer.getResults <AppHVodomer>
        var stWater = Ext.data.StoreManager.get("StOrgWater");//QueryVodomer.getResults  <AllPokVodomera>

        //FORM
        var fmOrgVodomer = Ext.getCmp('fmOrgVodomer');
        var pnOVodomerHistory = Ext.getCmp('pnOVodomerHistory');
        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');
        var address_id = values.get('address_id');
        var address = values.get('address');
        var filial_id = values.get('filial_id');
        var filial = values.get('filial');
        var org_id = values.get('org_id');
        var house_id = values.get('house_id');
        //LOGIKA
        //showAddress.show();
        stHVodomer.removeAll();
        stWater.removeAll();

        fmOrgVodomer.getForm().reset();
        stVodomer.load({
            params: {
                what:'OrgVodomer',
                filial_id: filial_id,
                login:login,
                password:password
            },
            scope:this
        });
         stHVodomer.load({
                    params: {
                        what:'OrgHVodomer',
                        filial_id:values.get('filial_id'),
                        login:values.get('login'),
                        password:values.get('password')
                    },
                    scope:this
                });
    },

    onInsTekPokOrgVodMiddleClick: function(button, e, eOpts) {
        // in use
        var me = this;
        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");
        var stWater = Ext.data.StoreManager.get("StOrgWater");//QueryVodomer.getResults  <AppVodomer>
        var stTekPokVodomera = Ext.data.StoreManager.get("StTekPokOrgVodomera");//QueryVodomer.getResults <TekPokVodomera>
        //var stTekNachOrgVod = Ext.data.StoreManager.get("StTekNachOrgVod");//QueryVodomer.getResults  <TekNachAppVodomera>
        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            org_id:values.get('org_id'),
            filial_id:values.get('filial_id'),
            filial:values.get('filial'),
            what:'insMiddle'
        };
        //GRID


        //FORMA

        var fmVodomer = Ext.getCmp('fmOrgVodomer');
        var value = fmVodomer.getValues();
        //console.log(value.get('type'));
        //console.log(value);

        //LOGIKA


        Ext.Object.merge(value, params);

        QueryVodomer.newPokVodomera(value,function(results){
            if (results.success){
                fmVodomer.getForm().findField('newValueOrg').setValue(0);
                //stWater.removeAll();
                stWater.load({
                    params: {
                        what:'AllPokOVodomera',
                        filial_id: value.filial_id,
                        vodomer_id: value.vodomer_id,
                        login:value.login,
                        password:value.password
                    },
                    scope:this
                });
                // stTekNachAppVod.removeAll();

                //  stTekPokVodomera.removeAll();
                stTekPokVodomera.load({
                    params: {
                        what:'TekPokOVodomera',
                        filial_id: value.filial_id,
                        vodomer_id: value.vodomer_id,
                        login:value.login,
                        password:value.password
                    },
                    callback: function(records,operation,success){
                        if(success){
                            fmVodomer.getForm().loadRecord(records[0]);
                        }
                    },
                    scope:this
                });
            }
        });


    },

    onInsHandPokOrgVodClick: function(button, e, eOpts) {
        // in use
        var me = this;
        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");
        var stWater = Ext.data.StoreManager.get("StOrgWater");//QueryVodomer.getResults  <AppVodomer>
        var stTekPokVodomera = Ext.data.StoreManager.get("StTekPokOrgVodomera");//QueryVodomer.getResults <TekPokVodomera>
        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            org_id:values.get('org_id'),
            filial_id:values.get('filial_id'),
            filial:values.get('filial'),
            what:'insHandOrg'
        };
        //GRID


        //FORMA

        var fmVodomer = Ext.getCmp('fmOrgVodomer');
        var value = fmVodomer.getValues();

        //LOGIKA


        Ext.Object.merge(value, params);
        var newValue = value.newValue;
        var max =newValue;
        if (isNaN(newValue)){
            Ext.MessageBox.show({
                title: 'Проверка вводимых данных',
                msg: 'Введите число',
                buttons: Ext.MessageBox.OK,
                icon: Ext.MessageBox.ERROR
            });
            return false;

        } else {
            QueryVodomer.newPokVodomera(value,function(results){
                if (results.success){
                    fmVodomer.getForm().findField('newValueOrg').setValue(0);
                    //stWater.removeAll();
                    stWater.load({
                        params: {
                            what:'AllPokOVodomera',
                            filial_id: value.filial_id,
                            vodomer_id: value.vodomer_id,
                            login:value.login,
                            password:value.password
                        },
                        scope:this
                    });
                    // stTekNachAppVod.removeAll();

                    //  stTekPokVodomera.removeAll();
                    stTekPokVodomera.load({
                        params: {
                            what:'TekPokOVodomera',
                            filial_id: value.filial_id,
                            vodomer_id: value.vodomer_id,
                            login:value.login,
                            password:value.password
                        },
                        callback: function(records,operation,success){
                            if(success){
                                fmVodomer.getForm().loadRecord(records[0]);
                            }
                        },
                        scope:this
                    });
                }
            });
        }

    },

    onGrOrgHVodomerSelectionChange: function(model, selected, eOpts) {
        //in use
        var me =this;

        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");
        var stWater = Ext.data.StoreManager.get("StOrgWater");//QueryVodomer.getResults  <AllPokVodomera>

        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');
        var address_id = values.get('address_id');
        var house_id = values.get('house_id');

        //GRID

        var grOrgVodomer = Ext.getCmp('grOrgVodomer');

        //FORMA

        var fmVodomer = Ext.getCmp('fmOrgVodomer');

        //LOGIKA

        grOrgVodomer.getView().getSelectionModel().deselectAll();

        if (selected.length){

            stWater.load({
                params: {
                    login:login,
                    password:password,
                    address_id: address_id,
                    what:'AllPokOVodomera',
                    what_id: selected[0].data.address_id,
                    vodomer_id: selected[0].data.vodomer_id
                },
                scope:this
            });
            fmVodomer.getForm().reset();

        }

    },

    onNewValueOrgSpecialkey: function(field, e, eOpts) {
        var value = field.getValue();
        if (e.getKey() === e.ENTER && !Ext.isEmpty(value)) {
            this.onInsTekPokOrgVodClick();
        }
    },

    onGrOrgVodomerSelectionChange: function(model, selected, eOpts) {
        //in use
        var me =this;

        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");
        var stWater = Ext.data.StoreManager.get("StOrgWater");
        var stTekPokVodomera = Ext.data.StoreManager.get("StTekPokOrgVodomera");

        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');
        var filial_id = values.get('filial_id');
        var house_id = values.get('house_id');

        //GRID


        //FORMA
        var dt = new Date();

        var fmVodomer = Ext.getCmp('fmOrgVodomer');

        var btnNorm = fmVodomer.down('#insTekPokOrgVod');
        var tekValue = fmVodomer.getForm().findField('tekp');
        var newValue = fmVodomer.getForm().findField('newValue');
        var InsPoverka = fmVodomer.down('#InsPoverkaOrg');

        var AddMeedlePokVod = fmVodomer.down('#AddMeedlePokVodOrg');
        var insMeedlePokVod = fmVodomer.down('#insMeedlePokVodOrg');
        var date_ot = fmVodomer.getForm().findField('data_ot');
        var date_do = fmVodomer.getForm().findField('data_do');
        var date_ao = fmVodomer.getForm().findField('date_ao');
        var date_ar = fmVodomer.getForm().findField('date_ar');
        var pok_ot = fmVodomer.getForm().findField('pok_ot');
        var pok_do = fmVodomer.getForm().findField('pok_do');
        var rday = fmVodomer.getForm().findField('rday');
        var days = fmVodomer.getForm().findField('days');
        var kub_day = fmVodomer.getForm().findField('kub_day');
        var qty_kub = fmVodomer.getForm().findField('qty_kub');


        var newKubov = fmVodomer.getForm().findField('newKubov');
        var date_new = fmVodomer.getForm().findField('date_new').setValue(Ext.Date.format(dt, 'Y-m-d'));


        //LOGIKA


        if (selected.length){
            stWater.load({
                params: {
                    login:login,
                    password:password,
                    filial_id: filial_id,
                    what:'AllPokOVodomera',
                    what_id: selected[0].data.filial_id,
                    vodomer_id: selected[0].data.vodomer_id
                },
                scope:this
            });
            fmVodomer.down('#delTekPokOrgVod').setDisabled(true);
            fmVodomer.getForm().findField('vkl_del').setValue(0);


            stTekPokVodomera.load({
                params: {
                    login:login,
                    password:password,
                    filial_id: filial_id,
                    what:'TekPokOVodomera',
                    what_id: selected[0].data.filial_id,
                    vodomer_id: selected[0].data.vodomer_id
                },
                callback: function(records,operation,success){
                    if(success){
                        fmVodomer.getForm().loadRecord(records[0]);

                    }
                },
                scope:this
            });
            if (selected[0].data.out===1){
                AddMeedlePokVod.setDisabled(false);
                insMeedlePokVod.setDisabled(false);
                InsPoverka.setDisabled(false);

                date_ao.setDisabled(false);
                date_ar.setDisabled(false);
                date_ot.setDisabled(true);
                date_do.setDisabled(true);
                qty_kub.setDisabled(true);
                pok_do.setDisabled(true);
                pok_ot.setDisabled(true);
                rday.setDisabled(true);
                days.setDisabled(true);
                qty_kub.setDisabled(true);
                kub_day.setDisabled(true);
                newKubov.setDisabled(true);
                btnNorm.setDisabled(true);
                newValue.setDisabled(true);

            } else {
                AddMeedlePokVod.setDisabled(true);
                insMeedlePokVod.setDisabled(true);
                InsPoverka.setDisabled(true);

                date_ao.setDisabled(true);
                date_ar.setDisabled(true);
                date_ot.setDisabled(true);
                date_do.setDisabled(true);
                pok_do.setDisabled(true);
                pok_ot.setDisabled(true);
                days.setDisabled(true);
                rday.setDisabled(true);
                qty_kub.setDisabled(true);
                kub_day.setDisabled(true);
                newKubov.setDisabled(true);
                btnNorm.setDisabled(false);
                newValue.setDisabled(false);
            }
        }

    },

    onAktOplombirovkiOrgClick: function() {
        var me = this;
        var StUser = Ext.data.StoreManager.get("StUser");
        var StReport = Ext.data.StoreManager.get("StReport");
        var values =StUser.getAt(0);
        var filial_id =values.get('filial_id');

        var usertype = 1;

        //V
        var tabPnCenter =  Ext.getCmp('tabPnCenter');//me.getTabPnCenter();
        var grid = Ext.getCmp('grOrgVodomer');
        var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();
        var size = Ext.Object.getSize(gridRowSelectedRecords) ;
        var vodomer =[];
        if (size >= 1){

            Ext.Object.each(gridRowSelectedRecords, function(key, val, myself) {
                Ext.Object.merge(val.data, vodomer);
                vodomer.push(val.data.vodomer_id);
            });

        }

        //console.log(values);
        if (filial_id) {

            var report = 'AktOplombirovkiVodomerOrg';
            var namereport = 'Акт опламбировки.';

            var value = {
                login:values.get('login'),
                password:values.get('password'),
                report:report,
                what:report,
                filial_id:filial_id,
                vodomer: vodomer
            };

            var tab = tabPnCenter.child('#'+report);

            if (!tab) {
                tab  = tabPnCenter.add({
                    xtype:'tabreportorg',
                    title:namereport,
                    id:''+report+''
                });

                tabPnCenter.setActiveTab(tab);

            }else{

                tabPnCenter.setActiveTab(tab);
            }

            var reppan = tab.getComponent(0);


            var myMask= Ext.Msg.show({
                title:'Отчеты...',
                msg: 'Загрузка отчета.Ожидайте...',
                buttons: Ext.Msg.CANCEL,
                wait: true,
                modal: true,
                icon: Ext.Msg.INFO
            });

            QueryReport.getResults(value,function(data){
                if (data){

                    //    reportHead.update(data.head);
                    reppan.update(data.content);
                    //      reportFoot.update(data.foot);
                    Ext.REPORTCONTENT =data.content;
                    myMask.close();


                } else {
                    Ext.MessageBox.show({
                        title: 'Ошибка ',
                        msg: 'Документ не создан',
                        buttons: Ext.MessageBox.OK,
                        icon: Ext.MessageBox.ERROR

                    });

                }

            });
            myMask.close();


        }

    },

    onAddOrgVodomerClick: function(button, e, eOpts) {

        var winAddVodomer = Ext.ClassManager.instantiateByAlias('widget.winaddvodomer');

        var dt = new Date();

        var form = winAddVodomer.down('#fmAddVodomer');
        var check = form.down('#chkExistentVod');
        var obrVodomer = form.down('#obrVodomer');
        var jointVodomer = form.down('#jointVodomer');
        var stUser = Ext.data.StoreManager.get("StUser");
        var values =stUser.getAt(0);
        //LOGIKA'
        values.set({'vibor':'addOrgVodomer'});
        stUser.sync();
        form.down('#btAddVodomer').setText('Додати прилад обліку');
        //form.getForm().findField('pdate').setValue(Ext.Date.format(dt, 'Y-m-d'));
        //form.getForm().findField('sdate').setValue(Ext.Date.format(dt, 'Y-m-d'));
        form.getForm().findField('new_id').setValue(values.get('filial_id'));
        form.getForm().findField('pp').setValue(4);
        form.getForm().findField('fpdate').hide();

        form.getForm().findField('address_id').hide();
        form.getForm().findField('filial_id').hide();
        form.getForm().findField('new_id').hide();

        winAddVodomer.setTitle('Введення нового приладу обліку');
        winAddVodomer.show();
    },

    onGrAllPokOrgVodSelectionChange: function(model, selected, eOpts) {
        //in use
        var me =this;

        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");
        var stWater = Ext.data.StoreManager.get("StOrgWater");//QueryVodomer.getResults  <AllPokVodomera>
        var stTekPokVodomera = Ext.data.StoreManager.get("StTekPokOrgVodomera");//QueryVodomer.getResults <TekPokVodomera>

        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');
        var filial_id = values.get('filial_id');

        //GRID


        //FORMA

        var fmVodomer = Ext.getCmp('fmOrgVodomer');
        var btnNorm = fmVodomer.down('#insTekPokOrgVod');
        var tekValue = fmVodomer.getForm().findField('tekp');
        var newValue = fmVodomer.getForm().findField('newValue');
        var InsPoverka = fmVodomer.down('#InsPoverkaOrg');
        var AddMeedlePokVod = fmVodomer.down('#AddMeedlePokVodOrg');
        var insMeedlePokVod = fmVodomer.down('#insMeedlePokVodOrg');
        var date_ot = fmVodomer.getForm().findField('data_ot');
        var date_do = fmVodomer.getForm().findField('data_do');
        var date_ao = fmVodomer.getForm().findField('date_ao');
        var date_ar = fmVodomer.getForm().findField('date_ar');
        var pok_ot = fmVodomer.getForm().findField('pok_ot');
        var pok_do = fmVodomer.getForm().findField('pok_do');
        var rday = fmVodomer.getForm().findField('rday');
        var days = fmVodomer.getForm().findField('days');
        var kub_day = fmVodomer.getForm().findField('kub_day');
        var qty_kub = fmVodomer.getForm().findField('qty_kub');

        var newKubov = fmVodomer.getForm().findField('newKubov');


        //LOGIKA


        if (selected.length){

            stTekPokVodomera.load({
                params: {
                    login:login,
                    password:password,
                    filial_id: filial_id,
                    what:'TekPokWaterOrg',
                    what_id: selected[0].data.filial_id,
                    pok_id: selected[0].data.pok_id,
                    vodomer_id: selected[0].data.vodomer_id
                },
                callback: function(records,operation,success){
                    if(success){
                        fmVodomer.getForm().loadRecord(records[0]);

                    }
                },
                scope:this
            });
            if (selected[0].data.pok_ot!==0){
                AddMeedlePokVod.setDisabled(false);
                insMeedlePokVod.setDisabled(false);
                InsPoverka.setDisabled(false);

                date_ao.setDisabled(false);
                date_ar.setDisabled(false);
                date_ot.setDisabled(false);
                date_do.setDisabled(false);
                qty_kub.setDisabled(false);
                pok_do.setDisabled(false);
                pok_ot.setDisabled(false);
                rday.setDisabled(false);
                days.setDisabled(false);
                qty_kub.setDisabled(false);
                kub_day.setDisabled(false);
                newKubov.setDisabled(true);
                btnNorm.setDisabled(true);
                newValue.setDisabled(true);

            } else {
                AddMeedlePokVod.setDisabled(true);
                insMeedlePokVod.setDisabled(true);
                InsPoverka.setDisabled(true);

                date_ao.setDisabled(true);
                date_ar.setDisabled(true);
                date_ot.setDisabled(true);
                date_do.setDisabled(true);
                pok_do.setDisabled(true);
                pok_ot.setDisabled(true);
                days.setDisabled(true);
                rday.setDisabled(true);
                qty_kub.setDisabled(true);
                kub_day.setDisabled(true);
                newKubov.setDisabled(true);
                btnNorm.setDisabled(true);
                newValue.setDisabled(true);
            }
        }

    },

    addVodomerOrg: function(value) {
        // in use
        var me = this;
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var stVodomer = Ext.data.StoreManager.get("StOrgVodomer");
        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            org_id:values.get('org_id'),
            filial_id:values.get('filial_id'),
            filial:values.get('filial'),
            rowind:values.get('rowind'),
            what:"addOrgVodomer"
        };

        //FORMA
        var fmVodomer = Ext.getCmp('fmOrgVodomer');

        //GRID
        var grOrgVodomer = Ext.getCmp('grOrgVodomer');
        //LOGIKA

        Ext.Object.merge(value, params);
        QueryVodomer.addVodomer(value,function(results){
            if (results.success){
                stVodomer.load({
                    params: {
                        what:'OrgVodomer',
                        filial_id: value.filial_id,
                        vodomer_id: value.vodomer_id,
                        login:value.login,
                        password:value.password
                    },
                    callback: function(records,operation,success){
                        if(success){
                            grOrgVodomer.getView().getSelectionModel().select(0);
                            Ext.MessageBox.show({
                                title: 'Введення нового приладу обліку',
                                msg: results.msg,
                                buttons: Ext.MessageBox.OK,
                                icon: Ext.MessageBox.INFO
                            });
                        }
                    },
                    scope:this
                });

            }
        });
    },

    editVodomerOrg: function(value) {
        // in use
        var me = this;
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var stVodomer = Ext.data.StoreManager.get("StOrgVodomer");
        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            org_id:values.get('org_id'),
            filial_id:values.get('filial_id'),
            filial:values.get('filial'),
            rowind:values.get('rowind'),
            what:"editOrgVodomer"
        };

        //FORMA
        var fmVodomer = Ext.getCmp('fmOrgVodomer');

        //GRID
        var grOrgVodomer = Ext.getCmp('grOrgVodomer');
        //LOGIKA
        //console.log(value);
        Ext.Object.merge(value, params);
        QueryVodomer.addVodomer(value,function(results){

            if (results.success){
                stVodomer.load({
                    params: {
                        what:'OrgVodomer',
                        filial_id: value.filial_id,
                        vodomer_id: value.vodomer_id,
                        login:value.login,
                        password:value.password
                    },
                    callback: function(records,operation,success){
                        if(success){
                            grOrgVodomer.getView().getSelectionModel().select(value.rowind);
                            Ext.MessageBox.show({
                                title: 'Оновлення приладу обліку',
                                msg: results.msg,
                                buttons: Ext.MessageBox.OK,
                                icon: Ext.MessageBox.INFO
                            });
                        }
                    },
                    scope:this
                });

            }
        });
    },

    changeVodomerOrg: function(value) {
         var me = this;
                //STORE
                var stUser = Ext.data.StoreManager.get("StUser");
                var stVodomer = Ext.data.StoreManager.get("StOrgVodomer");
                var stHVodomer = Ext.data.StoreManager.get("StOrgHVodomer");//QueryVodomer.getResults <AppHVodomer>
                var stWater = Ext.data.StoreManager.get("StOrgWater");//QueryVodomer.getResults  <AllPokVodomera>

                //LOGIN & PASSWORD

                var values =stUser.getAt(0);
                var params = {
                    login:values.get('login'),
                    password:values.get('password'),
                    filial_id:values.get('filial_id'),
                    what:"changeOrgVodomer"
                };

                var fmPribor = Ext.getCmp('fmOrgVodomer');


                Ext.Object.merge(value, params);
                QueryVodomer.addVodomer(value,function(results){
                    if (results.success==="1"){
                        Ext.MessageBox.show({
                            title: 'Замена cчетчика воды',
                            msg: results.msg,
                            buttons: Ext.MessageBox.OK,
                            icon: Ext.MessageBox.INFO
                        });

                        fmPribor.getForm().reset();

                        stVodomer.load({
                            params: {
                                what:'OrgVodomer',
                                filial_id: value.filial_id,
                                vodomer_id: value.vodomer_id,
                                login:value.login,
                                password:value.password
                            },
                            scope:this
                        });
                        stWater.removeAll();

                        stHVodomer.load({
                            params: {
                                what:'OrgHVodomer',
                                filial_id: value.filial_id,
                                what_id: value.filial_id,
                                login:value.login,
                                password:value.password
                            },
                            scope:this
                        });
                    }else {
                        Ext.MessageBox.show({
                            title: 'Заміна приладу обліку',
                            msg: results.msg,
                            buttons: Ext.MessageBox.OK,
                            icon: Ext.MessageBox.INFO
                        });
                    }
                });
    }

});