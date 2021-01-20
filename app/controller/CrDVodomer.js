/*
 * File: app/controller/CrDVodomer.js
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

Ext.define('Ykis.controller.CrDVodomer', {
    extend: 'Ext.app.Controller',

    refs: {
        WinAddDvodomer: '#winAddDvodomer'
    },

    control: {
        "#tabDvodomer": {
            activate: 'onPanelActivate'
        },
        "#addDVodomer": {
            click: 'onAddDVodomerClick'
        },
        "#btAddDVodomer": {
            click: 'onBtAddDVodomerClick'
        },
        "#newPokDVodomera": {
            specialkey: 'onNewPokDVodomeraSpecialkey'
        },
        "#insNachWaterHouse": {
            click: 'onInsNachWaterHouseClick'
        },
        "#delTekPokDvodomera": {
            click: 'onDelTekPokDvodomeraClick'
        },
        "#VodoPotreblenieiDvodomer": {
            click: 'onVodoPotreblenieiDvodomerClick'
        }
    },

    onPanelActivate: function(component, eOpts) {
        //CONTROLLER

        var CrLeftMenu = this.application.getController('CrLeftMenu');
        CrLeftMenu.LoadTabDvodomer();

    },

    onAddDVodomerClick: function(button, e, eOpts) {
        var me = this;
        var WinAddDvodomer = Ext.ClassManager.instantiateByAlias('widget.winadddvodomer');

        var form = WinAddDvodomer.down('#fmAddDvodomer');
        var stUser = Ext.data.StoreManager.get("StUser");
        var values =stUser.getAt(0);
        //console.log(values);
        //LOGIKA
        values.set({'vibor':'add_dvodomer'});
        stUser.sync();


        var dt = new Date();
        form.down('#btAddDVodomer').setText('Добавить водомер');
        WinAddDvodomer.setTitle('Ввод нового домового водомера');
        //form.getForm().findField('pdate').setValue(Ext.Date.format(dt, 'Y-m-d'));
        //form.getForm().findField('sdate').setValue(Ext.Date.format(dt, 'Y-m-d'));
        form.getForm().findField('pp').setValue(4);
        form.getForm().findField('fpdate').hide();


        WinAddDvodomer.show();

    },

    onBtAddDVodomerClick: function(button, e, eOpts) {
        // in use
        var me = this;
        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");

        var values =stUser.getAt(0);
        var vibor = values.get('vibor');

        switch (vibor){
            case 'change_dvodomer':  // ВЫБРАНА ЗАМЕНА ДОМОВОГО ВОДОМЕРА
            me.changeDVodomer();
            break;
            case 'add_dvodomer'://ДОБАВЛЕНИЕ ДОМОВОГО ВОДОМЕРА
            me.addDVodomer();
            break;
            case 'editDVodomer':// РЕДАКТИРОВАНИЕ ДОМОВОГО ВОДОМЕРА
            me.editDVodomer();
            break;
        }
    },

    onNewPokDVodomeraSpecialkey: function(field, e, eOpts) {
        var value = field.getValue();
        if (e.getKey() === e.ENTER && !Ext.isEmpty(value)) {
            this.onInsTekPokDVodomerClick();
        }
    },

    onInsNachWaterHouseClick: function(button, e, eOpts) {
        //in use

        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");
        var StWaterHouse = Ext.data.StoreManager.get("StWaterHouse");

        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            house_id:values.get('house_id'),
            dvodomer_id:values.get('dvodomer_id'),
            what:"nach_norma_voda_org_dvodomer"
        };

        //LOGIKA
        QueryVodomer.updateVodomer(params,function(results){
            if (results.success){
                Ext.MessageBox.show({
                    title: 'Начисление воды по норме по обьектам',
                    msg: results.msg,
                    buttons: Ext.MessageBox.OK,
                    icon: Ext.MessageBox.INFO
                });

            }
        });
    },

    onDelTekPokDvodomeraClick: function(button, e, eOpts) {
        // in use
        var me = this;
        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");
        var stWater = Ext.data.StoreManager.get("StAllPokDVodomera");//QueryVodomer.getResults  <AllPokVodomera>
        var stTekPokVodomera = Ext.data.StoreManager.get("StTekPokDVodomera");//QueryVodomer.getResults <TekPokVodomera>
        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            address_id:values.get('address_id'),
            house_id:values.get('house_id'),
            what:'DVodomer'

        };
        //GRID

        //var grTekNachAppVodomer = Ext.getCmp('grTekNachAppVodomer');

        //FORMA

        var fmVodomer = Ext.getCmp('fmDVodomers');
        var value = fmVodomer.getValues();

        //LOGIKA

        Ext.Object.merge(value, params);
        //console.log(value);
        Ext.MessageBox.confirm({
            title: 'Удаление последних показаний домового водомера',
            msg: 'Вы удаляете последнее показание подомового водомера<br>Подтвердите или отмените свои действия.',
            buttons: Ext.MessageBox.OKCANCEL,
            icon: Ext.MessageBox.ERROR,
            buttonText:{
                ok:'подтвеждаю',
                cancel:'отмена'
            },
            fn:function(btn,newValue){
                if(btn=='ok'){
                    QueryVodomer.delPokVodomera(value,function(results){
                        if (results.success){
                            Ext.MessageBox.show({title: 'Удаление последних показаний ',
                                                 msg: results.msg,
                                                 buttons: Ext.MessageBox.OK,
                                                 icon: Ext.MessageBox.INFO
                                                });
                            fmVodomer.getForm().findField('newValue').setValue(0);
                            stWater.load({
                                params: {
                                    what:'AllPokDVodomera',
                                    what_id: value.dvodomer_id,
                                    dvodomer_id: value.dvodomer_id,
                                    login:value.login,
                                    password:value.password
                                },
                                scope:this
                            });

                            stTekPokVodomera.load({
                                params: {
                                    what:'TekPokDVodomera',
                                    dvodomer_id: value.dvodomer_id,
                                    what_id: value.dvodomer_id,
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

                        }else{
                            Ext.MessageBox.show({title: 'Удаление последних показаний домового водомера',
                                                 msg: results.msg,
                                                 buttons: Ext.MessageBox.OK,
                                                 icon: Ext.MessageBox.ERROR
                                                });
                        }
                    });
                }
            }
        });

    },

    onVodoPotreblenieiDvodomerClick: function(button, e, eOpts) {
        var me = this;
        var StUser = Ext.data.StoreManager.get("StUser");
        var StReport = Ext.data.StoreManager.get("StReport");
        var values =StUser.getAt(0);
        var house_id =values.get('house_id');

        var usertype = 1;

        //V
        var tabPnCenter =  Ext.getCmp('tabPnCenter');//me.getTabPnCenter();
        var grid = Ext.getCmp('grDvodomer');
        var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();
        var size = Ext.Object.getSize(gridRowSelectedRecords) ;
        var vodomer =[];
        if (size >= 1){

            Ext.Object.each(gridRowSelectedRecords, function(key, val, myself) {
                Ext.Object.merge(val.data, vodomer);
                vodomer.push(val.data.dvodomer_id);
            });

        }

        //console.log(values);
        if (house_id) {

            var report = 'VodoPotreblenieDvodomer';
            var namereport = 'Отчет водопотребления.';

            var value = {
                login:values.get('login'),
                password:values.get('password'),
                report:report,
                what:report,
                house_id:house_id,
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

    changeDVodomer: function() {

    },

    addDVodomer: function() {
        // in use
        var me = this;

        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StDVodomer = Ext.data.StoreManager.get("StDVodomer");//QueryTeplomer.getResults

        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            house_id:values.get('house_id'),
            what:"addDVodomer"
        };
        //WIN
        var WinAddDvodomer = this.getWinAddDvodomer();

        //GRID
        var grDvodomer = Ext.getCmp('grDvodomer');
        //FORMA
        var fmDVodomers = Ext.getCmp('fmDVodomers');
        var fmAddDvodomer = Ext.getCmp('fmAddDvodomer');
        var value = fmAddDvodomer.getValues();

        //LOGIKA

        Ext.Object.merge(value, params);
        WinAddDvodomer.close();
        var myMask= Ext.Msg.show({
            title:'Добавление записи...',
            msg: 'Добавление водомер.Ожидайте...',
            buttons: Ext.Msg.CANCEL,
            wait: true,
            modal: true,
            icon: Ext.Msg.INFO
        });
        QueryVodomer.addVodomer(value,function(results){
            if (results.success){
                StDVodomer.load({
                    params: {
                        what:'Dvodomer',
                        house_id: value.house_id,
                        login:value.login,
                        password:value.password
                    },
                    callback: function(records,operation,success){
                        if(success){
                            StDVodomer.each(function(item, index, count){
                                if (item.data.dvodomer_id === parseInt(results.dvodomer_id, 10) ) {
                                    grDvodomer.getView().getSelectionModel().select(index);
                                }
                            });
                        }
                    },
                    scope:this
                });
                myMask.close();

            }else{
                myMask.close();

            }
        });
    },

    editDVodomer: function() {
        // in use
        var me = this;

        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StDVodomer = Ext.data.StoreManager.get("StDVodomer");//QueryTeplomer.getResults
        var StAllPokDVodomera = Ext.data.StoreManager.get("StAllPokDVodomera");//QueryTeplomer.getResults  <AllPokDTeplomera>
        var StTekPokDVodomera = Ext.data.StoreManager.get("StTekPokDVodomera");//QueryTeplomer.getResults <TekPokDTeplomera>

        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            rowind:values.get('rowind'),
            house_id:values.get('house_id'),
            what:"editDVodomer"
        };
        //WIN
        var WinAddDvodomer = me.getWinAddDvodomer();
        //GRID
        var grDVodomers = Ext.getCmp('grDvodomer');
        //FORMA
        var fmDVodomers = Ext.getCmp('fmDVodomers');
        var fmAddDVodomer = Ext.getCmp('fmAddDvodomer');
        var value = fmAddDVodomer.getValues();



        //LOGIKA

        Ext.Object.merge(value, params);
        WinAddDvodomer.close();
        //console.log(value);
        var myMask= Ext.Msg.show({
            title:'Редактирование записи...',
            msg: 'Запись отредактированых данных<br> по домовому водомеру.Ожидайте...',
            buttons: Ext.Msg.CANCEL,
            wait: true,
            modal: true,
            icon: Ext.Msg.INFO
        });
        QueryVodomer.addVodomer(value,function(results){
            if (results.success){
                StDVodomer.load({
                    params: {
                        what:'Dvodomer',
                        house_id: value.house_id,
                        login:value.login,
                        password:value.password
                    },
                    callback: function(records,operation,success){
                        if(success){
                            grDVodomers.getView().getSelectionModel().select(value.rowind);
                            Ext.MessageBox.show({
                                title: 'Обновление домового водомера',
                                msg: results.msg,
                                buttons: Ext.MessageBox.OK,
                                icon: Ext.MessageBox.INFO
                            });
                        }
                    },
                    scope:this
                });
                myMask.close();

            }else{
                myMask.close();

            }
        });
    }

});
