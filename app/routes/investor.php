<?php

use App\Core\Router\Router;

$router = new Router();

$router->group('/dashboard/investor')->namespace('Dashboard')->use(['auth', 'access.inv'])->register(function (Router $router) {

    // Dashboard
    $router->get('/', 'AdminController.index');

    
});
