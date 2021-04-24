<?php

use App\Core\Router\Router;

$router = new Router();


$router->group('/dashboard/organization')->namespace('Dashboard\Organization')->use(['auth', 'access.org'])->register(function (Router $router) {

    // Dashboard
    $router->get('/', 'IndexController.dispaly');

    // Profile

    $router->get('/profile', 'IndexController.displayProfile');
    $router->post('/profile/updateUser', 'IndexController.updateUser');
    $router->post('/profile/updateProfile', 'IndexController.updateProfile');


    //    inventory Dashboard

    $router->get('/inventory-dash', 'IndexController.displayInventory');


    // Comming Soon

    $router->get('/coming-soon', '@dashboard.organization.coming-soon');

    // Building
    $router->get('/building', 'AssetController.displayBuilding');
    $router->post('/building', 'AssetController.addBuilding');
    $router->post('/building/edit', 'AssetController.updateBuilding');
    $router->post('/building/delete', 'AssetController.delete');


    // Machinery
    $router->get('/machinery', 'AssetController.displayMachinery');
    $router->post('/machinery', 'AssetController.addMachinery');
    $router->post('/machinery/edit', 'AssetController.updateMachinery');
    $router->post('/machinery/delete', 'AssetController.delete');


    // Land
    $router->get('/land', 'AssetController.displayLand');
    $router->post('/land', 'AssetController.addLand');
    $router->post('/land/edit', 'AssetController.updateLand');
    $router->post('/land/delete', 'AssetController.delete');


    // Vehicle
    $router->get('/vehicle', 'AssetController.displayVehicle');
    $router->post('/vehicle', 'AssetController.addVehicle');
    $router->post('/vehicle/edit', 'AssetController.updateVehicle');
    $router->post('/vehicle/delete', 'AssetController.delete');






    // otherasset
    $router->get('/otherAsset', 'AssetController.displayOtherAsset');
    $router->post('/otherAsset', 'AssetController.addOtherAsset');
    $router->post('/otherAsset/edit', 'AssetController.updateOtherAsset');
    $router->post('/otherAsset/delete', 'AssetController.delete');


    // Goods
    $router->get('/goods', 'AssetController.displayGoods');
    $router->post('/goods', 'AssetController.addGoods');
    $router->post('/goods/edit', 'AssetController.updateGoods');
    $router->post('/goods/delete', 'AssetController.delete');



    // Land
    $router->get('/equipment', 'AssetController.displayEquipment');
    $router->post('/equipment', 'AssetController.addEquipment');
    $router->post('/equipment/edit', 'AssetController.updateEquipment');
    $router->post('/equipment/delete', 'AssetController.delete');


    // Product
    $router->get('/product', 'AssetController.displayProduct');
    $router->post('/product', 'AssetController.addProduct');
    $router->post('/product/edit', 'AssetController.updateProduct');
    $router->post('/product/delete', 'AssetController.delete');


    // Warehouse

    $router->get('/warehouse', 'WarehouseController.dispalyWarehouse');
    $router->get('/warehouse/{id}', 'WarehouseController.dispalyWarepro');
    $router->post('/warehouse/{id}', 'WarehouseController.addWarepro');



    $router->get('/input-analysis', 'WarehouseController.displayInputAnalysis');
    $router->get('/output-analysis', 'WarehouseController.displayOutputAnalysis');





    // Monitory and Evaluation

    //    Monitory Dashboard

    $router->get('/monitory-dash', 'IndexController.displayMonitory');
    // Field Management

    // Field
    $router->get('/field', 'FpmController.displayField');
    $router->post('/field', 'FpmController.addFpm');
    $router->post('/field/edit', 'FpmController.updateFpm');
    $router->post('/field/delete', 'FpmController.deleteFpm');

    // Pen
    $router->get('/pen', 'FpmController.displayPen');
    $router->post('/pen', 'FpmController.addFpm');
    $router->post('/pen/edit', 'FpmController.updateFpm');
    $router->post('/pen/delete', 'FpmController.deleteFpm');

    // Facility
    $router->get('/facility', 'FpmController.displayFacility');
    $router->post('/facility', 'FpmController.addFpm');
    $router->post('/facility/edit', 'FpmController.updateFpm');
    $router->post('/facility/delete', 'FpmController.deleteFpm');


    // Activity Log


    $router->post('/activity/edit', 'ReportController.updateReport');
    $router->post('/activity/delete', 'ReportController.delete');

    // Field
    $router->get('/fieldactivity', 'ReportController.displayFieldActivity');
    $router->post('/fieldactivity', 'ReportController.addReport');

    // Pen
    $router->get('/penactivity', 'ReportController.displayPenActivity');
    $router->post('/penactivity', 'ReportController.addReport');

    // Facility
    $router->get('/facilityactivity', 'ReportController.displayFacilityActivity');
    $router->post('/facilityactivity', 'ReportController.addReport');



    // Weekly Report


    // Field
    $router->get('/fieldweek', 'ReportController.displayFieldWeekReport');
    $router->post('/fieldweek', 'ReportController.addReport');

    // Pen
    $router->get('/penweek', 'ReportController.displayPenWeekReport');
    $router->post('/penweek', 'ReportController.addReport');

    // Facility
    $router->get('/facilityweek', 'ReportController.displayFacilityWeekReport');
    $router->post('/facilityweek', 'ReportController.addReport');



    // Monthly Report


    // Field
    $router->get('/fieldmonth', 'ReportController.displayFieldMonthReport');
    $router->post('/fieldmonth', 'ReportController.addReport');

    // Pen
    $router->get('/penmonth', 'ReportController.displayPenMonthReport');
    $router->post('/penmonth', 'ReportController.addReport');

    // Facility
    $router->get('/facilitymonth', 'ReportController.displayFacilityMonthReport');
    $router->post('/facilitymonth', 'ReportController.addReport');


    // Mapping and tagging
    $router->get('/map', 'MapController.index');
    $router->post('/map', 'MapController.store');
    $router->post('/map/{id}', 'MapController.update');
    $router->post('/map/{id}/destroy', 'MapController.destroy');


    // Employee => Users Table
    $router->get('/employee', 'EmployeeController.employee');
    $router->post('/employee', 'EmployeeController.registerEmp');
    $router->post('/employee/edit', 'EmployeeController.edit');  
    $router->get('/employee/{id}/disable/{status}', 'EmployeeController.disable');




    // Worker
    $router->get('/worker', 'EmployeeController.displayWorker');
    $router->post('/worker', 'EmployeeController.addWorker');
    $router->post('/worker/edit', 'EmployeeController.editWorker');
    $router->post('/worker/delete', 'EmployeeController.delete');


    // Weather
    $router->get('/weather', 'WeatherController.index');

    // Expenditure Log

    // financial Dashboard

    $router->get('/financial-dash', 'IndexController.displayFinancial');

    $router->post('/explog/edit', 'ExpLogController.updateExpLog');
    $router->post('/explog/delete', 'ExpLogController.deleteExpLog');


    // Building Maintenance
    $router->get('/main-build', 'ExpLogController.mainBuild');
    $router->post('/main-build', 'ExpLogController.addExpLog');

    // Vehicle Maintenance
    $router->get('/main-vehi', 'ExpLogController.mainVehi');
    $router->post('/main-vehi', 'ExpLogController.addExpLog');

    // Machinery Maintenance
    $router->get('/main-mach', 'ExpLogController.mainMach');
    $router->post('/main-mach', 'ExpLogController.addExpLog');

    // Utility
    $router->get('/utility', 'ExpLogController.utility');
    $router->post('/utility', 'ExpLogController.addExpLog');

    // Advert
    $router->get('/advert', 'ExpLogController.advert');
    $router->post('/advert', 'ExpLogController.addExpLog');


    // purchases
    $router->get('/purchases', 'ExpLogController.purchases');
    $router->post('/purchases', 'ExpLogController.addExpLog');


    // rent
    $router->get('/rent', 'ExpLogController.rent');
    $router->post('/rent', 'ExpLogController.addExpLog');


    // legal
    $router->get('/legal', 'ExpLogController.legal');
    $router->post('/legal', 'ExpLogController.addExpLog');


    // power
    $router->get('/power', 'ExpLogController.power');
    $router->post('/power', 'ExpLogController.addExpLog');

    // salary
    $router->get('/salary', 'ExpLogController.salary');
    $router->post('/salary', 'ExpLogController.addExpLog');


    // insurance
    // $router->get('/insurance', 'ExpLogController.insurance');
    // $router->post('/insurance', 'ExpLogController.addExpLog');


    // security
    $router->get('/security', 'ExpLogController.security');
    $router->post('/security', 'ExpLogController.addExpLog');


    // Risk management 

    // Pest and diseases Glossary
    // Pest
    $router->get('/pests-glossary', 'PestGlossaryController.index');
    $router->post('/pests-glossary', 'PestGlossaryController.store');
    $router->post('/pests-glossary/{id}', 'PestGlossaryController.update');
    $router->post('/pests-glossary/{id}/delete', 'PestGlossaryController.destroy');

    // Disease
    $router->get('/diseases-glossary', 'DiseaseGlossaryController.index');
    $router->post('/diseases-glossary', 'DiseaseGlossaryController.store');
    $router->post('/diseases-glossary/{id}', 'DiseaseGlossaryController.update');
    $router->post('/diseases-glossary/{id}/delete', 'DiseaseGlossaryController.destroy');

    // Pest and diseases
    // Pest
    $router->get('/pests', 'PestController.index');
    $router->post('/pests', 'PestController.store');
    $router->post('/pests/{id}', 'PestController.update');
    $router->post('/pests/{id}/delete', 'PestController.destroy');

    // Disease
    $router->get('/diseases', 'DiseaseController.index');
    $router->post('/diseases', 'DiseaseController.store');
    $router->post('/diseases/{id}', 'DiseaseController.update');
    $router->post('/diseases/{id}/delete', 'DiseaseController.destroy');

    // Insurance
    $router->get('/insurance', 'InsuranceController.index');
    $router->get('/insurance/create', 'InsuranceController.create');
    $router->post('/insurance/create', 'InsuranceController.store');
    $router->get('/insurance/{id}/edit', 'InsuranceController.edit');
    $router->post('/insurance/{id}/edit', 'InsuranceController.update');
    $router->post('/insurance/{id}/delete', 'InsuranceController.destroy');
});
