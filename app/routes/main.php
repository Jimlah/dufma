<?php

#Use the router module
use App\Core\Router\Router;

#Create instance of router
$router = new Router();

#Add routes
$router->any('/', 'CubeController.home');

$router->group()->register(function(Router $router){
    
    $router->get('/case_studies', '@landing.case_studies');
    $router->get('/media', '@landing.media');
    $router->get('/sign_in', '@landing.sign_in');
    $router->get('/solutions', '@landing.solutions');

});