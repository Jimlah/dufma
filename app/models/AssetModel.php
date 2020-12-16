<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\AssetProvider;

class AssetModel extends Model
{
    protected static $schema = 'asset';
    
    protected static $primary_key = 'id';

    protected static $provider = AssetProvider::class;

    protected static $fields = array(
        'id',
        'userid',
        'orgid',
        'name',
        'category',
        'description',
        'amount',
        'manufacturer',
        'serial_no',
        'size',
        'location',
        'latitude',
        'longitude',
        'quantity',
        'table_type',
        'asset',
        'created_at',
        'updated_at'
    );
}