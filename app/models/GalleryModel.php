<?php

namespace App\Models;

use App\Core\Http\Model;

class GalleryModel extends Model
{
    protected static $schema = 'gallery';
    
    protected static $primary_key = 'id';

    protected static $provider = null;

    protected static $fields = array(
        'id',
        'user_id',
        'description',
        'image',
        'token',
        'created_at',
        'updated_at'
    );
}