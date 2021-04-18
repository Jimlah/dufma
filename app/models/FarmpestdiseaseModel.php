<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\FarmpestdiseaseProvider;

class FarmpestdiseaseModel extends Model
{
    protected static $schema = 'farmpestdisease';
    
    protected static $primary_key = 'id';

    protected static $provider = FarmpestdiseaseProvider::class;

    protected static $fields = array(
        'id',
        'userid',
        'orgid',
        'date_detected',
        'time_detected',
        'name',
        'sci_name',
        'description',
        'detected_by',
        'steps',
        'week1',
        'week2',
        'week3',
        'remark',
        'type',
        'created_at',
        'updated_at'
    );
}