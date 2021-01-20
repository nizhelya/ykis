/*
 * File: app/view/menu/TabPnLeftViewController.js
 * Date: Thu Jan 30 2020 17:11:03 GMT+0200 (EET)
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

Ext.define('Ykis.view.menu.TabPnLeftViewController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.tabpnleft',

    onRbTypeClickChange: function(field, newValue, oldValue, eOpts) {


        var  cbStreet = Ext.getCmp('cbStreet');
        var  cbHouses = Ext.getCmp('cbHouses');
        var  cbRaion = Ext.getCmp('cbRaion');

        var  viewHouses = Ext.getCmp('listHousesView');

        var stUser = Ext.data.StoreManager.get("StUser");
        var stHouses = Ext.data.StoreManager.get("StHouses");
        var stHouse = Ext.data.StoreManager.get("StHouse");

        var StStreet = Ext.data.StoreManager.get("StStreet");
        var StAddress = Ext.data.StoreManager.get("StAddress");
        var raion_id = cbRaion.getValue();

        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');


        cbHouses.setDisabled(false);

        cbStreet.clearValue();
        cbHouses.clearValue();
        if (raion_id == 5) {
            cbHouses.setDisabled(true);
        }
        StStreet.load({
            params: {
                login:login,
                password:password,
                what:'StreetsFromRaion',
                what_id: raion_id
            },
            scope: this
        });
        stHouses.load({
            params: {
                what:'HousesFromRaion',
                what_id: raion_id,
                login:login,
                password:password
            },
            scope: this
        });
        stHouse.load({
            params: {
                what:'HousesFromRaion',
                what_id: raion_id,
                login:login,
                password:password
            },
            scope: this
        });


    },

    onCbRaionSelect: function(combo, record, eOpts) {


        var  cbStreet = Ext.getCmp('cbStreet');
        var  cbHouses = Ext.getCmp('cbHouses');

        var  viewHouses = Ext.getCmp('listHousesView');
        var  rbTypeClick = Ext.getCmp('rbTypeClick');

        var stUser = Ext.data.StoreManager.get("StUser");
        var stHouses = Ext.data.StoreManager.get("StHouses");
        var stHouse = Ext.data.StoreManager.get("StHouse");

        var StStreet = Ext.data.StoreManager.get("StStreet");
        var StAddress = Ext.data.StoreManager.get("StAddress");

        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');


        cbHouses.setDisabled(false);

        if (record) {
            cbStreet.clearValue();
            cbHouses.clearValue();
            rbTypeClick.setDisabled(false);

            if (record.get('raion_id') == 5) {
                cbHouses.setDisabled(true);
            }
            StStreet.load({
                params: {
                    login:login,
                    password:password,
                    what:'StreetsFromRaion',
                    what_id: record.get('raion_id')
                },
                scope: this
            });
            stHouses.load({
                params: {
                    what:'HousesFromRaion',
                    what_id: record.get('raion_id'),
                    login:login,
                    password:password
                },
                scope: this
            });
            stHouse.load({
                params: {
                    what:'HousesFromRaion',
                    what_id: record.get('raion_id'),
                    login:login,
                    password:password
                },
                scope: this
            });
        }


    },

    onCbStreetSelect: function(combo, record, eOpts) {
        var  cbHouses = Ext.getCmp('cbHouses');
        var  cbStreet = Ext.getCmp('cbStreet');

        var  viewHouses = Ext.getCmp('listHousesView');

        var stUser = Ext.data.StoreManager.get("StUser");
        var stHouses = Ext.data.StoreManager.get("StHouses");
        var stHouse = Ext.data.StoreManager.get("StHouse");

        var StStreet = Ext.data.StoreManager.get("StStreet");
        var StAddress = Ext.data.StoreManager.get("StAddress");


        var values =stUser.getAt(0);
        var login = values.get('login');

        var password = values.get('password');
        if (record) {
            cbHouses.clearValue();

            stHouses.load({
                params: {
                    what:'HousesFromStreet',
                    what_id: record.get('street_id'),
                    privat: record.get('privat'),
                    login:login,
                    password:password
                },
                scope: this
            });
            stHouse.load({
                params: {
                    what:'HousesFromStreet',
                    what_id: record.get('street_id'),
                    privat: record.get('privat'),
                    login:login,
                    password:password
                },
                scope: this
            });
            if (record.get('privat')) {
                cbHouses.setDisabled(true);
            }

        }
    },

    onCbHousesSelect: function(combo, record, eOpts) {
        var  viewHouses = Ext.getCmp('listHousesView');

        var stUser = Ext.data.StoreManager.get("StUser");
        var stHouses = Ext.data.StoreManager.get("StHouses");
        var stHouse = Ext.data.StoreManager.get("StHouse");


        var values =stUser.getAt(0);
        var login = values.get('login');

        var password = values.get('password');
        if (record) {
            stHouses.load({
                params: {
                    what:'AddressFromHouse',
                    what_id: record.get('house_id'),
                    login:login,
                    password:password
                },
                scope: this
            });


        }

    }

});
