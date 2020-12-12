<?php

namespace App\Models;

use App\Core\Http\Model;

class UsersModel extends Model
{
    protected static $schema = 'users';
    
    protected static $primary_key = 'id';

    protected static $provider = null;

    protected static $fields = array(
        'id',
        'userid',
        'firstname',
        'lastname',
        'email',
        'username',
        'password',
        'access',
        'status',
        'created_at',
        'updated_at'
    );
}