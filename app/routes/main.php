<?php

#Use the router module
use App\Core\Router\Router;

#Create instance of router
$router = new Router();

#Add routes
$router->any('/', 'CubeController.home');

$router->group()->namespace('Auth')->register(function(Router $router){
    
    $router->get('/case_studies', '@landing.case_studies');


    $router->get('/media', '@landing.media');


    $router->get('/sign_in', '@landing.sign_in');
    $router->post('/sign_in', 'LoginController.login');


    $router->get('/solutions', '@landing.solutions');

});


$router->group('/dashboard/admin')->use('auth')->register(function(Router $router){

    $router->get('/', '@dashboard/admin/index');
});