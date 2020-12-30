<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\ReportProvider;

class ReportModel extends Model
{
    protected static $schema = 'report';
    
    protected static $primary_key = 'id';

    protected static $provider = ReportProvider::class;

    protected static $fields = array(
        'id', 
        'userid', 
        'orgid', 
        'type', 
        'usage_emp', 
        'time', 
        'assetid', 
        'usage_hr', 
        'activity', 
        'activity_status', 
        'asset_status', 
        'manager',
        'category',
        'created_at',
        'updated_at'
    );
}