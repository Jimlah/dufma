<?php

/**
 * --------------------------
 * CUBE VIEW CONFIG
 * ---------------------------
 * This file should contain your
 * custom filters and functions
 * that you want available in views
 */

return array(

    #Whether or not app caches views
    'cache' => false,

    #Make App\Core\Http\Request accessible from view via _req
    'embed_request' => true,
    
    #Functions allowed in views
    'functions' => array(
        'var_dump',
        'get_notification',
        'get_user',
        'get_fixedasset',
        'get_currentasset',
        'get_alert',
        'dnd'
    ),

    #Filters allowed in view
    'filters' => array(
        'hello' => function ($str) {
            return 'Hello world: ' . $str;
        }
    )
);