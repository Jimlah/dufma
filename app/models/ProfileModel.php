<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\ProfileProvider;

class ProfileModel extends Model
{
    protected static $schema = 'profile';
    
    protected static $primary_key = 'id';

    protected static $provider = ProfileProvider::class;

    protected static $fields = array(
        'id', 
        'userid', 
        'orgid', 
        'firstname', 
        'lastname', 
        'email', 
        'image', 
        'address', 
        'gender', 
        'phone_no', 
        'next_of_kin', 
        'next_of_kin_no', 
        'department', 
        'salary', 
        'bkname', 
        'bkacct', 
        'contract_type',
        'created_at',
        'updated_at'
    );
}