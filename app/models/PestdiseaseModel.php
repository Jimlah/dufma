<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\PestdiseaseProvider;

class PestdiseaseModel extends Model
{
    protected static $schema = 'pestdisease';
    
    protected static $primary_key = 'id';

    protected static $provider = PestdiseaseProvider::class;

    protected static $fields = array(
        'id',
        'userid',
        'orgid',
        'name',
        'sci_name',
        'category',
        'disease_type',
        'symptoms',
        'cause',
        'host',
        'life_cycle',
        'treatment',
        'type',
        'causative_organism',
        'created_at',
        'updated_at'
    );
}