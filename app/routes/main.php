<?php

#Use the router module
use App\Core\Router\Router;

#Create instance of router
$router = new Router();

#Add routes

$router->get('/', 'CubeController.home')->use('checkAuth');
$router->post('/', 'CubeController.homeAction')->use('checkAuth');
$router->post('/subscribe', 'CubeController.subscribe')->use('checkAuth');


$router->group()->namespace('Auth')->use('checkAuth')->register(function (Router $router) {
    $router->any('/404', 'CubeController._404');

    $router->get('/case_studies', '@landing.case_studies');


    $router->get('/sign_in', '@landing.sign_in');
    $router->post('/sign_in', 'LoginController.login');


    $router->get('/solutions', '@landing.solutions');


    $router->get('/smart-farming', '@landing.smartFarming');

    $router->post('/password-recovery', 'LoginController.recover');
});


$router->group()->namespace('Landing')->use('checkAuth')->register(function (Router $router) {


    $router->get('/media', 'MediaController.display');
});


$router->group('/dashboard')->namespace('Dashboard')->use('auth')->register(function (Router $router) {
    $router->post('/employee', 'FunctionController.registerEmp');
    $router->get('/logout', 'FunctionController.logout');
});

$router->group('/dashboard')->namespace('Dashboard')->use('auth')->register(function (Router $router) {
    
    
    $router->get('/wallet', 'FunctionController.displayTransaction');
    $router->get('/wallet/pay', 'FunctionController.addTransaction');
    $router->post('/wallet/transfer', 'FunctionController.transferTransaction');
    $router->post('/wallet/fund', 'FunctionController.fundTransaction');

});

$router->get('/password-recovery', '@landing.forget_password');

