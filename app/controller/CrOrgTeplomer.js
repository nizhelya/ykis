/*
 * File: app/controller/CrOrgTeplomer.js
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

Ext.define('Ykis.controller.CrOrgTeplomer', {
    extend: 'Ext.app.Controller',
    alias: 'controller.crOrgTeplomer',

    refs: {
        WinAddTeplomer: '#winAddTeplomer'
    },

    control: {
        "#tabOrgTeplomer": {
            activate: 'onTabOrgTeplomerActivate'
        },
        "#insHandPokOrgTeplomer": {
            click: 'onInsHandPokOrgTeplomerClick'
        },
        "#newPokOrgTepl": {
            specialkey: 'onNewPokOrgTeplSpecialkey'
        },
        "#pnOTeplomerHistory": {
            expand: 'onPnOTeplomerHistoryExpand'
        },
        "#fmPererOrgTeplo": {
            expand: 'onFmPererOrgTeploExpand'
        },
        "#btnAddOrgTeplomer": {
            click: 'onBtnAddOrgTeplomerClick'
        }
    },

    onTabOrgTeplomerActivate: function(component, eOpts) {
        //in use
        var me =this;
        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");
        var stTeplomer = Ext.data.StoreManager.get("StOTeplomer");
        var stHTeplomer = Ext.data.StoreManager.get("StHOTeplomer");
        var StAllPokTeplomera = Ext.data.StoreManager.get("StAllPokOTeplomera");
        StAllPokTeplomera.removeAll();

        //PANEL

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

        var fmOrgTeplomer = Ext.getCmp('fmOrgTeplomer');

        fmOrgTeplomer.getForm().reset();


        stTeplomer.load({
            params: {
                what:'OrgTeplomer',
                what_id: filial_id,
                filial_id: filial_id,
                login:login,
                password:password
            },
            scope:this
        });


        stHTeplomer.load({
            params: {
                what:'OrgHTeplomer',
                what_id: filial_id,
                filial_id: filial_id,
                login:login,
                password:password
            },
            scope:this
        });



    },

    onInsHandPokOrgTeplomerClick: function(button, e, eOpts) {
        // in use
        var me = this;
        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");
        var stTekPokTeplomera = Ext.data.StoreManager.get("StTekPokOTeplomera");//QueryTeplomer.getResults <TekPokTeplomera>
        var stAllPokTeplomera = Ext.data.StoreManager.get("StAllPokOTeplomera");//QueryTeplomer.getResults <TekPokTeplomera>

        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            filial_id:values.get('filial_id'),
            house_id:values.get('house_id'),
            what:'insHandOrgTepl'
        };
        //FORMA
        var fmTeplomer = Ext.getCmp('fmOrgTeplomer');
        var value = fmTeplomer.getValues();
        //LOGIKA


        Ext.Object.merge(value, params);
        var newValue = value.newValue;
        var max =newValue - value.tek;
        if (isNaN(newValue)){
            Ext.MessageBox.show({
                title: 'Проверка вводимых данных',
                msg: 'Введите число',
                buttons: Ext.MessageBox.OK,
                icon: Ext.MessageBox.ERROR
            });
            return false;
        }else if (max<0){
            Ext.MessageBox.show({
                title: 'Проверка вводимых данных',
                msg: 'Текущие показания <b>'+value.tek+'</b><br>Новые показания <b>'+newValue+'</b><br>Введите правильные показания !.',
                buttons: Ext.MessageBox.CANCEL,
                icon: Ext.MessageBox.ERROR,
                buttonText:{
                    cancel:'отмена'
                },
                fn:function(btn,newValue){
                    if(btn=='cancel'){
                        fmTeplomer.down('#newPokOrgTepl').focus();
                        return false;
                    }
                }
            });

        } else {
            QueryTeplomer.newPokTeplomera(value,function(data){
                if (data.success){
                    Ext.MessageBox.confirm({
                        title: 'Проверка вводимых данных',
                        msg: 'Новые показания введены',
                        buttons: Ext.MessageBox.OK,
                        icon: Ext.MessageBox.INFO
                    });
                    fmTeplomer.down('#newPokOrgTepl').setValue(0);

                    stTekPokTeplomera.load({
                        params: {
                            what:'TekPokOrgTeplomera',
                            what_id: value.filial_id,
                            filial_id: value.filial_id,
                            teplomer_id: value.teplomer_id,
                            login:value.login,
                            password:value.password
                        },
                        callback: function(records,operation,success){
                            if(success){
                                fmTeplomer.getForm().loadRecord(records[0]);
                            }
                        },
                        scope:this
                    });
                    stAllPokTeplomera.load({
                        params: {
                            login:value.login,
                            password:value.password,
                            filial_id: value.filial_id,
                            what:'AllPokOrgTeplomera',
                            what_id: value.teplomer_id,
                            teplomer_id: value.teplomer_id
                        },
                        scope:this
                    });

                }
            });
        }
    },

    onNewPokOrgTeplSpecialkey: function(field, e, eOpts) {
        var value = field.getValue();
        if (e.getKey() === e.ENTER && !Ext.isEmpty(value)) {
            this.onInsTekPokOrgTeplomerClick();
        }
    },

    onPnOTeplomerHistoryExpand: function(p, eOpts) {
        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");
        var stHTeplomer = Ext.data.StoreManager.get("StHOTeplomer");//QueryTeplomer.getResults <AppHTeplomer>
        //LOGIN & PASSWORD
        var values =stUser.getAt(0);
        var stFilial = stHTeplomer.getAt(0);
        if(stHTeplomer.data.length === 0){
            stHTeplomer.load({
                params: {
                    what:'OrgHTeplomer',
                    filial_id:values.get('filial_id'),
                    login:values.get('login'),
                    password:values.get('password')
                },
                scope:this
            });
        } else {
            if( values.get('filial_id') !=stFilial_id.get('filial_id')){
                stHTeplomer.load({
                    params: {
                        what:'OrgHTeplomer',
                        filial_id:values.get('filial_id'),
                        login:values.get('login'),
                        password:values.get('password')
                    },
                    scope:this
                });

            }
        }
    },

    onFmPererOrgTeploExpand: function(p, eOpts) {
        //STORE

        var stUser = Ext.data.StoreManager.get("StUser");
        var stTekNachFilial = Ext.data.StoreManager.get("StTekNachFilial");
        //LOGIN & PASSWORD
        var values =stUser.getAt(0);
        var stFilial = stTekNachFilial.getAt(0);

        if(stTekNachFilial.data.length === 0){
            stTekNachFilial.load({
                params: {
                    what:'TekNachFilial',
                    filial_id:values.get('filial_id'),
                    login:values.get('login'),
                    password:values.get('password')
                },
                callback: function(records,operation,success){
                    if(success && records.length){
                        p.getForm().loadRecord(records[0]);
                        p.doLayout();

                    }
                },
                scope:this
            });
        } else {
            if( values.get('filial_id') !=stFilial_id.get('filial_id')){
                stTekNachFilial.load({
                    params: {
                        what:'TekNachFilial',
                        filial_id:values.get('filial_id'),
                        login:values.get('login'),
                        password:values.get('password')
                    },
                    callback: function(records,operation,success){
                        if(success && records.length){
                            p.getForm().loadRecord(records[0]);
                            p.doLayout();
                        }
                    },
                    scope:this
                });
            } else {
                p.getForm().loadRecord(stFilial);
                p.doLayout();
            }
        }

    },

    onBtnAddOrgTeplomerClick: function(button, e, eOpts) {
        //in use
        var me = this;
        var winAddTeplomer = Ext.ClassManager.instantiateByAlias('widget.winaddteplomer');
        var form = winAddTeplomer.down('#fmAddTeplomer');
        var stUser = Ext.data.StoreManager.get("StUser");
        var values =stUser.getAt(0);
        //LOGIKA
        values.set({'vibor':'addOrgTeplomer'});
        stUser.sync();
        var dt = new Date();
        form.down('#btAddTeplomer').setText('Додати прилад обліку');
        winAddTeplomer.setTitle('Введення нового приладу обліку');
        //form.getForm().findField('pdate').setValue(Ext.Date.format(dt, 'Y-m-d'));
        //form.getForm().findField('sdate').setValue(Ext.Date.format(dt, 'Y-m-d'));
        form.getForm().findField('pp').setValue(4);
        form.getForm().findField('fpdate').hide();

        winAddTeplomer.show();
    },

    editOrgTeplomer: function(value) {
        // in use
        var me = this;
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StOTeplomer = Ext.data.StoreManager.get("StOTeplomer");//QueryTeplomer.getResults  <OrgTeplomer>
        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            org_id:values.get('org_id'),
            filial_id:values.get('filial_id'),
            filial:values.get('filial'),
            rowind:values.get('rowind'),
            what:"editOrgTeplomer"
        };

        //FORMA
        var fmOrgTeplomer = Ext.getCmp('fmOrgTeplomer');

        //GRID
        var grOrgTeplomer = Ext.getCmp('grOrgTeplomer');
        //LOGIKA

        Ext.Object.merge(value, params);
        QueryTeplomer.addTeplomer(value,function(results){
            if (results.success){
                StOTeplomer.load({
                    params: {
                        what:'OrgTeplomer',
                        filial_id: value.filial_id,
                        teplomer_id: value.teplomer_id,
                        login:value.login,
                        password:value.password
                    },
                    callback: function(records,operation,success){
                        if(success){
                            grOrgTeplomer.getView().getSelectionModel().select(value.rowind);
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

    changeOrgTeplomer: function(value) {
        // in use
        var me = this;
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StOTeplomer = Ext.data.StoreManager.get("StOTeplomer");//QueryTeplomer.getResults  <OrgTeplomer>
        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            org_id:values.get('org_id'),
            filial_id:values.get('filial_id'),
            filial:values.get('filial'),
            rowind:values.get('rowind'),
            what:"changeOrgTeplomer"
        };

        //FORMA
        var fmOrgTeplomer = Ext.getCmp('fmOrgTeplomer');

        //GRID
        var grOrgTeplomer = Ext.getCmp('grOrgTeplomer');
        //LOGIKA

        Ext.Object.merge(value, params);
        QueryTeplomer.addTeplomer(value,function(results){
            if (results.success){
                StOTeplomer.load({
                    params: {
                        what:'OrgTeplomer',
                        filial_id: value.filial_id,
                        teplomer_id: value.teplomer_id,
                        login:value.login,
                        password:value.password
                    },
                    callback: function(records,operation,success){
                        if(success){
                            grOrgTeplomer.getView().getSelectionModel().select(value.rowind);
                            Ext.MessageBox.show({
                                title: 'Заміна приладу обліку',
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

    addOrgTeplomer: function(value) {
        // in use
        var me = this;
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StOTeplomer = Ext.data.StoreManager.get("StOTeplomer");//QueryTeplomer.getResults  <OrgTeplomer>
        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            org_id:values.get('org_id'),
            filial_id:values.get('filial_id'),
            filial:values.get('filial'),
            rowind:values.get('rowind'),
            what:"addOrgTeplomer"
        };

        //FORMA
        var fmOrgTeplomer = Ext.getCmp('fmOrgTeplomer');

        //GRID
        var grOrgTeplomer = Ext.getCmp('grOrgTeplomer');
        //LOGIKA

        Ext.Object.merge(value, params);
        QueryTeplomer.addTeplomer(value,function(results){
            if (results.success){
                StOTeplomer.load({
                    params: {
                        what:'OrgTeplomer',
                        filial_id: value.filial_id,
                        teplomer_id: value.teplomer_id,
                        login:value.login,
                        password:value.password
                    },
                    callback: function(records,operation,success){
                        if(success){
                            grOrgTeplomer.getView().getSelectionModel().select(0);
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

    }

});