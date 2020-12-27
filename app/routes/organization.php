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






    // Employee => Users Table
    $router->get('/employee', 'EmployeeController.employee');
    $router->post('/employee', 'FunctionController.registerEmp');
    $router->post('/employee/edit', 'FunctionController.edit');
    $router->post('/employee/delete', 'FunctionController.delete');
});
