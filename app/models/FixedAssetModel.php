<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\FixedAssetProvider;

class FixedAssetModel extends Model
{
    protected static $schema = 'fixedasset';
    
    protected static $primary_key = 'id';

    protected static $provider = FixedAssetProvider::class;

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
        'del',
        'created_at',
        'updated_at'
    );
}