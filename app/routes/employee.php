<?php

use App\Core\Router\Router;

$router = new Router();

$router->group('/dashboard/employee')->namespace('Dashboard')->use(['auth', 'access.emp'])->register(function (Router $router) {
    
    // Dashboard
    $router->get('/', 'employeeController.index');

    // 
    $router->get('/organization', 'OrganizationController.organization');
    $router->post('/organization', 'FunctionController.register');
});
