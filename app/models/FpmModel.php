<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\FpmProvider;

class FpmModel extends Model
{
    protected static $schema = 'fpm';
    
    protected static $primary_key = 'id';

    protected static $provider = FpmProvider::class;

    protected static $fields = array(
        'id', 
        'userid', 
        'orgid', 
        'assetid', 
        'soil_type', 
        'ph', 
        'active', 
        'cur_util',
        'chemical',
        'start_season', 
        'end_season', 
        'ownership', 
        'fallow_period', 
        'manager', 
        'capacity', 
        'type', 
        'purpose', 
        'status', 
        'fpm',
        'created_at',
        'updated_at'
    );
}