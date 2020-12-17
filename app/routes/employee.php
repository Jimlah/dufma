<?php

use App\Core\Router\Router;

$router = new Router();

$router->group('/dashboard/employee')->namespace('Dashboard\Employee')->use(['auth', 'access.emp'])->register(function (Router $router) {
    
    // Dashboard
    $router->get('/', 'IndexController.display');
    
    // 
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
   $router->group()->use('check.user:warehouse')->register(function(Router $router) {
       $router->get('/warehouse/{id}', 'WarehouseController.dispalyWarepro');
       $router->post('/warehouse/{id}', 'WarehouseController.addWarepro');
   });
});
