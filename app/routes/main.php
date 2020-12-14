<?php

#Use the router module
use App\Core\Router\Router;

#Create instance of router
$router = new Router();

#Add routes

$router->any('/', 'CubeController.home')->use('checkAuth');

$router->group()->namespace('Auth')->use('checkAuth')->register(function (Router $router) {
    $router->any('/404', 'CubeController._404');

    $router->get('/case_studies', '@landing.case_studies');


    $router->get('/media', '@landing.media');


    $router->get('/sign_in', '@landing.sign_in');
    $router->post('/sign_in', 'LoginController.login');


    $router->get('/solutions', '@landing.solutions');
});


$router->group('/dashboard')->namespace('Dashboard')->use('auth')->register(function (Router $router) {

    $router->get('/logout', 'FunctionController.logout');

});
