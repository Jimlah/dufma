<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\DemoProvider;

class DemoModel extends Model
{
    protected static $schema = 'demo';
    
    protected static $primary_key = 'id';

    protected static $provider = DemoProvider::class;

    protected static $fields = array(
        'id', 
        'email',
        'phone', 
        'business_type', 
        'message',
        'demo_type',
        'created_at',
        'updated_at'
    );
}