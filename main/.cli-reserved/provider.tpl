<?php

namespace App\Providers;

class {className}
{
    private $_id;

    public function __construct($id)
    {
        $this->_id = $id;
    }

    public function getId()
    {
        return $this->_id;
    }
}