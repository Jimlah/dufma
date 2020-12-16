<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\UsersProvider;

class UsersModel extends Model
{
    protected static $schema = 'users';
    
    protected static $primary_key = 'id';

    protected static $provider = UsersProvider::class;

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