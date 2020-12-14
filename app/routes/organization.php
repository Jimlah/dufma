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


    // Vehicle
    $router->get('/vehicle', 'FixedAssetController.displayVehicle');
    $router->post('/vehicle', 'FixedAssetController.addVehicle');
    $router->post('/vehicle/edit', 'FixedAssetController.updateVehicle');
    $router->post('/vehicle/delete', 'FixedAssetController.delete');

    // Land
    $router->get('/land', 'FixedAssetController.displayLand');
    $router->post('/land', 'FixedAssetController.addLand');
    $router->post('/land/edit', 'FixedAssetController.updateLand');
    $router->post('/land/delete', 'FixedAssetController.delete');


    // Employee => Users Table
    $router->get('/employee', 'EmployeeController.employee');
    $router->post('/employee', 'FunctionController.registerEmp');
    $router->post('/employee/edit', 'FunctionController.edit');
    $router->post('/employee/delete', 'FunctionController.delete');
});
