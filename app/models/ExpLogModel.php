<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\ExpLogProvider;

class ExpLogModel extends Model
{
    protected static $schema = 'explog';
    
    protected static $primary_key = 'id';

    protected static $provider = ExpLogProvider::class;

    protected static $fields = array(
        'id',
        'userid',
        'orgid', 
        'assetid', 
        'category', 
        'name', 
        'description', 
        'amount', 
        'quantity', 
        'status', 
        'duration_start', 
        'duration_end',
        'type',
        'created_at',
        'updated_at'
    );
}