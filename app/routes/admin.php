<?php

use App\Core\Router\Router;

$router = new Router();

$router->group('/dashboard/admin')->namespace('Dashboard\Admin')->use(['auth', 'access.admin'])->register(function (Router $router) {
    
    
    $router->get('/', 'IndexController.display');
    
    // dnd($router);
    // organization
    $router->get('/organization', 'OrganizationController.display');
    $router->post('/organization', 'OrganizationController.registerOrg');

    // Investor
    $router->get('/investor', 'InvestorController.display');

    // Gallery
    $router->get('/gallery', 'GalleryController.display');
    $router->post('/gallery', 'GalleryController.addGallery');

   
});
