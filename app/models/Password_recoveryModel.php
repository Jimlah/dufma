<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\Password_recoveryProvider;

class Password_recoveryModel extends Model
{
    protected static $schema = 'password_recovery';
    
    protected static $primary_key = 'id';

    protected static $provider = Password_recoveryProvider::class;

    protected static $fields = array(
        'id',
        'email',
        'recovery_token',
        'created_at',
        'updated_at'
    );
}