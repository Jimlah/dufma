<?php

namespace App\Models;

use App\Core\Http\Model;

class CurrentAssetModel extends Model
{
    protected static $schema = '{schema_name}';
    
    protected static $primary_key = '{primary_key_field}';

    protected static $provider = null;

    protected static $fields = array(
        'id',
        'userid',
        'category',
        'description',
        'amount',
        'manufacturer',
        'serial_no',
        'size',
        'location',
        'latitude',
        'longitude',
        'status',
        'quantity',
        'del',
        'created_at',
        'updated_at'
    );
}