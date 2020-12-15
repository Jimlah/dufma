<?php

namespace App\Models;

use App\Core\Http\Model;

class CurrentAssetModel extends Model
{
    protected static $schema = 'currentasset';
    
    protected static $primary_key = 'id';

    protected static $provider = CurrentAssetModel::class;

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
        'del',
        'created_at',
        'updated_at'
    );
}