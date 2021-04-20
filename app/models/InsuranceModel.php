<?php

namespace App\Models;

use App\Core\Http\Model;
use App\Providers\InsuranceProvider;

class InsuranceModel extends Model
{
    protected static $schema = 'insurance';
    
    protected static $primary_key = 'id';

    protected static $provider = InsuranceProvider::class;

    protected static $fields = array(
        'id',
        'userid',
        'orgid',
        'name',
        'insurance_parameter',
        'quantity',
        'content',
        'start_date',
        'end_date',
        'expected_number_inspection',
        'insurance_cost',
        'insurance_terms',
        'category',
        'officer_name',
        'company_name',
        'purpose',
        'total_cost',
        'application_date',
        'inspection_date',
        'insurance_approval_date',
        'insurance_state',
        'insurance_branch',
        'insurance_relationship_officer',
        'duration',
        'created_at',
        'updated_at'
    );
}