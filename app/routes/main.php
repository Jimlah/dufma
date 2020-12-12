<?php

#Use the router module
use App\Core\Router\Router;

#Create instance of router
$router = new Router();

#Add routes
$router->any('/', 'CubeController.home');
$router->any('/404', 'CubeController._404');

$router->group()->namespace('Auth')->use('checkAuth')->register(function (Router $router) {

    $router->get('/case_studies', '@landing.case_studies');


    $router->get('/media', '@landing.media');


    $router->get('/sign_in', '@landing.sign_in');
    $router->post('/sign_in', 'LoginController.login');


    $router->get('/solutions', '@landing.solutions');
});


$router->group('/dashboard')->namespace('Dashboard')->use('auth')->register(function (Router $router) {

    $router->get('/logout', 'FunctionController.logout');



    // Administrator
    $router->group('/admin')->use('access.admin')->register(function (Router $router) {
        $router->get('/', 'AdminController.index');

        $router->get('/organization', 'AdminController.organization');
        $router->post('/organization', 'FunctionController.registerOrg');
    });



    // Organization
    $router->group('/organization')->use('access.org')->register(function (Router $router) {
        $router->get('/', 'OrganizationController.index');

        $router->get('/employee', 'OrganizationController.employee');
        $router->post('/employee', 'FunctionController.registerEmp');
        $router->post('/employee/edit', 'FunctionController.edit');
        $router->post('/employee/delete', 'FunctionController.delete');
    });




    // Employee
    $router->group('/employee')->use('access.emp')->register(function (Router $router) {
        $router->get('/', 'AdminController.index');

        $router->get('/organization', 'OrganizationController.organization');
        $router->post('/organization', 'FunctionController.register');
    });





    // investor
    $router->group('/investor')->use('access.inv')->register(function (Router $router) {
        $router->get('/', 'AdminController.index');

        $router->get('/organization', 'AdminController.organization');
        $router->post('/organization', 'FunctionController.register');
    });
});
