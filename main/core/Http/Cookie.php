<?php

namespace App\Core\Http;

use InvalidArgumentException;

class Cookie
{
    /**
     * Cookie constructor
     * 
     */
    public function __construct()
    {
    }

    /**
     * Set new cookie
     * 
     * @param string $name Cookie name
     * @param string $value Cookie value
     * @param float|int $expires Cookie duration
     * 
     * @return void
     */
    public static function set($name, $value, $expires = (7*24*60*60)) {
        setcookie($name, $value, (time() + $expires));
        return true;
    }

    /**
     * Check if cookie exists
     *
     * @param string $name Cookie name
     * @return boolean
     */
    public static function has($name)
    {
        return isset($_COOKIE[$name]);
    }

    /**
     * Return cookie's value
     *
     * @param string $name Cookie name
     * @return mixed|null
     */
    public static function get($name)
    {
        if(!static::has($name)) {
            return null;
        }

        return $_COOKIE[$name];
    }

    /**
     * Remove cookie
     * 
     * @param string $name Cookie name
     * 
     * @return void;
     */
    public static function remove($name)
    {
        setcookie($name, null, time() - 300);
    }
}