<?php

use App\Core\Router\Router;

$router = new Router();

$router->group('/dashboard/employee')->namespace('Dashboard\Employee')->use(['auth', 'access.emp'])->register(function (Router $router) {

    // Dashboard
    $router->get('/', 'IndexController.display');

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

    $router->group()->use('check.user:asset')->register(function (Router $router) {
        $router->post('/building/edit', 'AssetController.updateBuilding');
        $router->post('/building/delete', 'AssetController.delete');
    });


    // Machinery
    $router->get('/machinery', 'AssetController.displayMachinery');
    $router->post('/machinery', 'AssetController.addMachinery');
    $router->post('/machinery/edit', 'AssetController.updateMachinery')->use('check.user');
    $router->post('/machinery/delete', 'AssetController.delete')->use('check.user');


    // Land
    $router->get('/land', 'AssetController.displayLand');
    $router->post('/land', 'AssetController.addLand');
    $router->group()->use('check.user:land')->register(function (Router $router) {
        $router->post('/land/edit', 'AssetController.updateLand');
        $router->post('/land/delete', 'AssetController.delete');
    });


    // Vehicle
    $router->get('/vehicle', 'AssetController.displayVehicle');
    $router->post('/vehicle', 'AssetController.addVehicle');
    $router->post('/vehicle/edit', 'AssetController.updateVehicle')->use('check.user');
    $router->post('/vehicle/delete', 'AssetController.delete')->use('check.user');






    // otherasset
    $router->get('/otherAsset', 'AssetController.displayOtherAsset');
    $router->post('/otherAsset', 'AssetController.addOtherAsset');
    $router->post('/otherAsset/edit', 'AssetController.updateOtherAsset')->use('check.user');
    $router->post('/otherAsset/delete', 'AssetController.delete')->use('check.user');


    // Goods
    $router->get('/goods', 'AssetController.displayGoods');
    $router->post('/goods', 'AssetController.addGoods');
    $router->post('/goods/edit', 'AssetController.updateGoods')->use('check.user');
    $router->post('/goods/delete', 'AssetController.delete')->use('check.user');



    // Land
    $router->get('/equipment', 'AssetController.displayEquipment');
    $router->post('/equipment', 'AssetController.addEquipment');
    $router->post('/equipment/edit', 'AssetController.updateEquipment')->use('check.user');
    $router->post('/equipment/delete', 'AssetController.delete')->use('check.user');


    // Product
    $router->get('/product', 'AssetController.displayProduct');
    $router->post('/product', 'AssetController.addProduct');
    $router->post('/product/edit', 'AssetController.updateProduct')->use('check.user');
    $router->post('/product/delete', 'AssetController.delete')->use('check.user');


    // Warehouse

    $router->get('/warehouse', 'WarehouseController.dispalyWarehouse');
    $router->group()->use('check.user:warehouse')->register(function (Router $router) {
        $router->get('/warehouse/{id}', 'WarehouseController.dispalyWarepro');
        $router->post('/warehouse/{id}', 'WarehouseController.addWarepro');
    });


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




    // Employee => Users Table
    $router->get('/employee', 'EmployeeController.employee');
    $router->post('/employee', 'FunctionController.registerEmp')->use('check.user');
    $router->post('/employee/edit', 'FunctionController.edit')->use('check.user');
    $router->post('/employee/delete', 'FunctionController.delete')->use('check.user');




    // Worker
    $router->get('/worker', 'EmployeeController.displayWorker');
    $router->post('/worker', 'EmployeeController.addWorker');
    $router->post('/worker/edit', 'EmployeeController.editWorker');
    $router->post('/worker/delete', 'EmployeeController.delete');



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
    $router->get('/insurance', 'ExpLogController.insurance');
    $router->post('/insurance', 'ExpLogController.addExpLog');


    // security
    $router->get('/security', 'ExpLogController.security');
    $router->post('/security', 'ExpLogController.addExpLog');
});
