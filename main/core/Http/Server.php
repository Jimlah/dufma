<?php

namespace App\Core\Http;

use App\Core\Misc\Collection;

use App\Core\Interfaces\ServerInterface;

class Server extends Collection implements ServerInterface
{
    /**
     * Class constructor
     * 
     * @var array $attributes
     */
    public function __construct($attributes = null)
    {
        if(!isset($_SERVER)) return;

        foreach($_SERVER as $attribute => $value) {
            $this->set($attribute, $value);
        }
    }

    /**
     * Check if server has SSL enabled
     * 
     * @return bool
     */
    public function isHTTPs() {

        $https = strtolower($this->get('https'));
        return ($https && $https === 'on');
    }
}