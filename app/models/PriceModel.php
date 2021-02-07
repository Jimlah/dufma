<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\PriceProvider;

class PriceModel extends Model
{
    protected static $schema = 'price';
    
    protected static $primary_key = 'id';

    protected static $provider = PriceProvider::class;

    protected static $fields = array(
        'id',
        'name',
        'summary',
        'description',
        'employee_num',
        'amount',
        'created_at',
        'updated_at'
    );
}