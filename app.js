/*
 * File: app.js
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

// @require @packageOverrides
Ext.Loader.setConfig({

});


Ext.application({
    models: [
        'MdFilial',
        'MdLgotnik',
        'MdHouses',
        'MdTemperature',
        'MdPay',
        'MdOrg',
        'MdOplata',
        'MdOrgCat',
        'MdOrgDog',
        'MdKoef',
        'MdUser',
        'MdPrixod',
        'MdTekNach',
        'MdFilServ',
        'MdStreet',
        'MdTekNachKassa',
        'MdLoginLocal',
        'MdTreeOrg',
        'MdAddress',
        'MdWaterHouse',
        'MdSpravochnik',
        'MdPriborUcheta',
        'MdAppartment',
        'MdDbfLgota',
        'MdBanks',
        'MdLogin',
        'MdModel',
        'MdRaion',
        'MdTarif',
        'MdUhpte',
        'MdCheckAddress',
        'MdOrgDogFil',
        'MdOrgPhones',
        'MdLastPay',
        'MdFilPhones',
        'MdCatSobstv',
        'MdTboTarif',
        'MdSchet',
        'MdUtszn',
        'MdPort',
        'MdVsubsidia',
        'MdDogovor',
        'MdPBankXml',
        'MdPB'
    ],
    stores: [
        'StTekPokDTeplomera',
        'StOrgDogFil',
        'StFilial',
        'StLoginLocal',
        'StOrgByDvodomer',
        'StTreeSprav',
        'StLastPay',
        'StMop',
        'StOrg',
        'StVodaTarif',
        'StObjNrv',
        'StAllPokDVodomera',
        'StHAppartment',
        'StTboTarif',
        'StHVodomer',
        'StOplata',
        'StExistentVod',
        'StOrgCat',
        'StOrgDog',
        'StOrgFil',
        'StAllPokDTeplomera',
        'StPrixod',
        'StOrgPhones',
        'StReport',
        'StLgotnik',
        'StDTeplomerCb',
        'StOTeplomer',
        'StKvTarif',
        'StSobstv',
        'StStreet',
        'StTekPokVodomera',
        'StTmodel',
        'StHTeplomer',
        'StLgotaNachVoda',
        'StOrgByDteplomer',
        'StTekPokDTeplomerov',
        'StWaterHouse',
        'StAbbr',
        'StVmodel',
        'StKoef',
        'StTemp',
        'StUser',
        'StVvod',
        'StOrgWater',
        'StTekNach',
        'StFilServ',
        'StTekNachKassa',
        'StTekPokOTeplomerov',
        'StHDVodomer',
        'StDbfLgota',
        'StTeploTarif',
        'StTekPokVodomerov',
        'StAppartment',
        'StHDTeplomer',
        'StTekPokOrgVodomerov',
        'StTreeOrg',
        'StTeplomer',
        'StAllPokTeplomera',
        'StAddress',
        'StOrgHVodomer',
        'StTekPokOrgVodomera',
        'StHOTeplomer',
        'StBanks',
        'StVodomerKassa',
        'StLgota',
        'StLogin',
        'StVodomer',
        'StRaion',
        'StRwork',
        'StTarif',
        'StTekNachApp',
        'StTekNachOrgVod',
        'StUhpte',
        'StTypes',
        'StWater',
        'StHeatHouseAll',
        'StTekPokOTeplomera',
        'StRaionOrg',
        'StHATeplomer',
        'StMopTypes',
        'StCheckAddress',
        'StHousesOrg',
        'StTekOplata',
        'StDVodomerCb',
        'StTekNachOrgTeplomer',
        'StOrgVodomer',
        'StHeatHouse',
        'StAllPokOTeplomera',
        'StLgotnikTab',
        'StOplataOrg',
        'StTekPokTeplomerov',
        'StDTeplomer',
        'StAllPokDteplomerov',
        'StTekPokTeplomera',
        'StHouses',
        'StTekNachAppVod',
        'StGrafikWork',
        'StTekNachFilial',
        'StStreetOrg',
        'StAddressOrg',
        'StTekPokDVodomera',
        'StDVodomer',
        'StSubsidia',
        'StEdIzm',
        'StCatSobstv',
        'StTekNachOrg',
        'StOplataFilial',
        'StDogovor',
        'StTypeVoda',
        'StSchetVik',
        'StBanksOrg',
        'StUsluga',
        'StFilialOpl',
        'StOrgOpl',
        'StTekNachKassaOrg',
        'StSobstvu',
        'StGerz',
        'StOsmd',
        'StCompany',
        'StOsmdRko',
        'stSubsidiaUtszn',
        'stLgotaUtszn',
        'StSprUtszn',
        'StPort',
        'StDocument',
        'StRodstvo',
        'StFamaly',
        'StVsubsidia',
        'StApp',
        'StHouse',
        'StHouseStoreys',
        'StItp',
        'StHousesTeplo',
        'StAddressDt',
        'StAktClaim',
        'StUtszn',
        'StGod',
        'StSprTypeSH',
        'StAOVodomer',
        'stPBankXml',
        'StPB',
        'StVodomerAvg',
        'StHouseEnIn',
        'StHouseEnOut',
        'StTarifOt',
        'StIPAY',
        'StPrixodEdit'
    ],
    views: [
        'flat.TabAppTeplomer',
        'flat.TabAppVodomer',
        'flat.TabKassa',
        'flat.TabNachApp',
        'flat.WinLgotnik',
        'menu.TabPnCenter',
        'menu.TabPnLeft',
        'org.TabFilial',
        'org.TabOrg',
        'sprav.TabDbfLgota',
        'sprav.TabKvartplata',
        'sprav.TabLgota',
        'sprav.TabLogin',
        'sprav.TabMTeplomer',
        'sprav.TabMVodomer',
        'sprav.TabNewAddress',
        'sprav.TabNormRashVoda',
        'sprav.TabPodogrev',
        'sprav.TabTbo',
        'sprav.TabTemp',
        'sprav.TabVoda',
        'sprav.TabReportOrg',
        'sprav.TabWorkGrafik',
        'sprav.WinAddDTeplomer',
        'sprav.WinAddDvodomer',
        'sprav.WinAddLgotaPerer',
        'sprav.winAddTeplomer',
        'sprav.WinAddVodomer',
        'sprav.WinEditOplata',
        'sprav.WinExportLgota',
        'sprav.WinImport',
        'sprav.WinReport',
        'VpKommuna',
        'org.WinAddOrg',
        'NFieldVodomer',
        'NField',
        'FieldNach',
        'NFTarif',
        'sprav.TabSubsidia',
        'flat.TabOplata',
        'sprav.TabCatSobstv',
        'sprav.TabSprTypeHot',
        'org.TabNachFilial',
        'flat.WinDogovor',
        'org.TabSchetVik',
        'org.TabOplataOrg',
        'sprav.WinAddOplataOrg',
        'sprav.TabWaterHouse',
        'sprav.TabGerz',
        'sprav.WinEditOplataOrg',
        'sprav.TabOsmdHouses',
        'sprav.TabPrixod',
        'sprav.TabLgotnik',
        'sprav.TabHouseResidents',
        'flat.WinFamaly',
        'sprav.TabLgotaUtszn',
        'sprav.TabVozvratSubsidia',
        'sprav.WinPrintSchetVik',
        'sprav.TabSearchCitizen',
        'sprav.TabSubsUtszn',
        'sprav.WinPrintAktUtszn',
        'sprav.WinEditDbfLgota',
        'flat.WinDogovorRestr',
        'sprav.TabDogovor',
        'sprav.TabDteplomer',
        'sprav.TabUtszn',
        'org.TabOrgTeplomer',
        'org.TabOrgVodomer',
        'sprav.TabDvodomer',
        'flat.TabNachAppVoda',
        'flat.TabNachAppTeplo',
        'flat.TabAppBti',
        'sprav.TabPB',
        'sprav.TabEnergoAudit',
        'sprav.TabIPAY',
        'org.WinDogovorOrg'
    ],
    controllers: [
        'CrInfo',
        'CrOrgTeplomer',
        'CrBti',
        'CrOrg',
        'CrOrgVodomer',
        'CrLeftMenu',
        'CrAppTeplomer',
        'CrDVodomer',
        'crOrgNach',
        'CrDTeplomer',
        'AppNach',
        'CrAppVodomer',
        'CrLogin',
        'CrKassa'
    ],
    name: 'Ykis',

    launch: function() {
        Ext.create('Ykis.view.VpKommuna');
        Ext.grid.RowEditor.prototype.saveBtnText = 'Записать';
        Ext.grid.RowEditor.prototype.cancelBtnText = 'Отменить';
        Ext.event.Event.resolveTextNode = function(node) {
            try {
                return (node && node.nodeType === 3) ? node.parentNode : node;
            } catch (err) {
                // ignore any errors here",
                return null;
            }
        };
        //закрываем значок загрузка...
        var loading =Ext.get('loading');
        if(loading){
            setTimeout(function(){

                loading.remove();
                Ext.get('loading-mask').fadeOut({remove:true});
            }, 250);
        }
    }

});
