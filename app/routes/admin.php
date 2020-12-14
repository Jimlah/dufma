<?php

use App\Core\Router\Router;

$router = new Router();

$router->group('/dashboard/admin')->namespace('Dashboard\Admin')->use(['auth', 'access.admin'])->register(function (Router $router) {


    $router->get('/', 'IndexController.index');

     // organization
     $router->get('/organization', 'OrganizationController.dispaly');
     $router->post('/organization', 'FunctionController.registerOrg');

    // Investor
    $router->get('/investor', 'InvestorController.display');

    // Gallery
    $router->get('/gallery', 'GalleryController.dispaly');

   
});
