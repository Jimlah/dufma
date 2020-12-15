<?php

namespace App\Models;

use App\Core\Http\Model;

class WarehouseModel extends Model
{
    protected static $schema = '{schema_name}';
    
    protected static $primary_key = '{primary_key_field}';

    protected static $provider = null;

    protected static $fields = array(
        'created_at',
        'updated_at'
    );
}