<?php

use App\Core\Router\Router;

$router = new Router();


$router->group('/dashboard/organization')->namespace('Dashboard\Organization')->use(['auth', 'access.org'])->register(function (Router $router) {

    // Dashboard
    $router->get('/', 'IndexController.dispaly');

    // Building
    $router->get('/building', 'FixedAssetController.displayBuilding');
    $router->post('/building', 'FixedAssetController.addBuilding');
    $router->post('/building/edit', 'FixedAssetController.updateBuilding');
    $router->post('/building/delete', 'FixedAssetController.delete');


    // Machinery
    $router->get('/machinery', 'FixedAssetController.displayMachinery');
    $router->post('/machinery', 'FixedAssetController.addMachinery');
    $router->post('/machinery/edit', 'FixedAssetController.updateMachinery');
    $router->post('/machinery/delete', 'FixedAssetController.delete');


    // Land
    $router->get('/land', 'FixedAssetController.displayLand');
    $router->post('/land', 'FixedAssetController.addLand');
    $router->post('/land/edit', 'FixedAssetController.updateLand');
    $router->post('/land/delete', 'FixedAssetController.delete');


    // Vehicle
    $router->get('/vehicle', 'FixedAssetController.displayVehicle');
    $router->post('/vehicle', 'FixedAssetController.addVehicle');
    $router->post('/vehicle/edit', 'FixedAssetController.updateVehicle');
    $router->post('/vehicle/delete', 'FixedAssetController.delete');

    




    // otherasset
    $router->get('/otherAsset', 'CurrentAssetController.displayOtherAsset');
    $router->post('/otherAsset', 'CurrentAssetController.addOtherAsset');
    $router->post('/otherAsset/edit', 'CurrentAssetController.updateOtherAsset');
    $router->post('/otherAsset/delete', 'CurrentAssetController.delete');


    // Goods
    $router->get('/goods', 'CurrentAssetController.displayGoods');
    $router->post('/goods', 'CurrentAssetController.addGoods');
    $router->post('/goods/edit', 'CurrentAssetController.updateGoods');
    $router->post('/goods/delete', 'CurrentAssetController.delete');



     // Land
     $router->get('/equipment', 'CurrentAssetController.displayEquipment');
     $router->post('/equipment', 'CurrentAssetController.addEquipment');
     $router->post('/equipment/edit', 'CurrentAssetController.updateEquipment');
     $router->post('/equipment/delete', 'CurrentAssetController.delete');


    // Product
    $router->get('/product', 'CurrentAssetController.displayProduct');
    $router->post('/product', 'CurrentAssetController.addProduct');
    $router->post('/product/edit', 'CurrentAssetController.updateProduct');
    $router->post('/product/delete', 'CurrentAssetController.delete');


    // Warehouse

    $router->get('/warehouse', 'WarehouseController.dispalyWarehouse');
    $router->get('/warehouse/{id}', 'WarehouseController.dispalyWarepro');
    $router->post('/warehouse/{id}', 'WarehouseController.addWarepro');
    



    // Employee => Users Table
    $router->get('/employee', 'EmployeeController.employee');
    $router->post('/employee', 'FunctionController.registerEmp');
    $router->post('/employee/edit', 'FunctionController.edit');
    $router->post('/employee/delete', 'FunctionController.delete');
});
