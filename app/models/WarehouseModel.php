<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\WarehouseProvider;

class WarehouseModel extends Model
{
    protected static $schema = 'warehouse';
    
    protected static $primary_key = 'id';

    protected static $provider = WarehouseProvider::class;

    protected static $fields = array(
        'id',
        'userid',
        'orgid',
        'warehouseid',
        'productid',
        'number',
        'created_at',
        'updated_at'
    );
}