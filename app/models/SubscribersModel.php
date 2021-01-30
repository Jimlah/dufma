<?php

namespace App\Models;

use App\Core\Http\Model;

class SubscribersModel extends Model
{
    protected static $schema = 'subscribers';
    
    protected static $primary_key = 'id';

    protected static $provider = null;

    protected static $fields = array(
        'id',
        'email',
        'status',
        'created_at',
        'updated_at'
    );
}