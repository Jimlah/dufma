<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\TransactionProvider;

class TransactionModel extends Model
{
    protected static $schema = 'transaction';
    
    protected static $primary_key = 'id';

    protected static $provider = TransactionProvider::class;

    protected static $fields = array(
        'id', 
        'userid', 
        'orgid', 
        'transaction_id', 
        'status', 
        'amount', 
        'pay_type', 
        'trans_type', 
        'created_at',
        'updated_at'
    );
}