<?php

namespace App\Core\Router;

use InvalidArgumentException;

use App\Core\Router\Route;

use App\Core\Router\RouteGroup;

use App\Core\Router\RouteCollection;

class Router
{

    /**
     * All routes
     * 
     * @var array
     */
    private static $routes = array();

    /**
     * Add a new route on any request method
     * 
     * @param string $path Route path
     * @param string $controller Controller route
     * 
     * @return Route
     */
    public function any($path, $controller)
    {
        return $this->on(null, $path, $controller);
    }

    /**
     * Add a new route on 'GET' request method
     * 
     * @param string $path Route path
     * @param string $controller Controller route
     * 
     * @return Route
     */
    public function get($path, $controller)
    {
        return $this->on('get', $path, $controller);
    }
    
    /**
     * Add a new route on 'DELETE' request method
     * 
     * @param string $path Route path
     * @param string $controller Controller route
     * 
     * @return Route
     */
    public function delete($path, $controller)
    {
        return $this->on('delete', $path, $controller);
    }

    /**
     * Add a new route group
     * 
     * @param string $parent Parent path
     * @param array $options Group Options
     * @param callable $fn Callback function
     * 
     * @return RouteGroup
     */
    public function group(...$args)
    {
        $num_args = func_num_args();
        $parent = $args[0];

        if($num_args < 2 || $num_args > 3) {
            throw new InvalidArgumentException('Invalid route arguments');
        }
        
        if($num_args == 2) {
            $options = [];
            $fn = $args[1];
        } else {
            $options = $args[1];

            if(!is_array($options)) {
                throw new InvalidArgumentException('Invalid route group options');
            }

            $fn = $args[2];
        }

        $namespace = $options['namespace'] ?? null;
        $cors = $options['cors'] ?? true;
        $middlewares = $options['use'] ?? null;

        $group = (new RouteGroup($parent, $this))
                    ->setMiddlewares($middlewares)
                    ->setNamespace($namespace)
                    ->setEnableCors($cors);

        if($fn) {
            $fn($group);
        }

        return $group;
    }
    
    /**
     * Add a new route on 'POST' request method
     * 
     * @param string $path Route path
     * @param string $controller Controller route
     * 
     * @return Route
     */
    public function post($path, $controller)
    {
        return $this->on('post', $path, $controller);
    }

    /**
     * Add a new route on 'PATCH' request method
     * 
     * @param string $path Route path
     * @param string $controller Controller route
     * 
     * @return Route
     */
    public function patch($path, $controller)
    {
        return $this->on('patch', $path, $controller);
    }

    /**
     * Add a new route on 'POST' request method
     * 
     * @param string[] $methods Request methods
     * @param string $path Route path
     * @param string $controller Controller route
     * 
     * @return Route
     */
    public function map($methods, $path, $controller)
    {
        if(!is_array($methods)) {
            throw new InvalidArgumentException('Router::map() $method should be an array');
        }

        foreach($methods as $method)
        {
            $this->on($method, $path, $controller);
        }
    }

    /**
     * Add new route to router
     * 
     * @param string $method Request method name
     * @param string $path Route path
     * @param string $controller Controller route
     * 
     * @return Route
     */
    public function on($method, $path, $controller)
    {
        $route = new Route($method, $path, $controller);
        RouteCollection::attachRoute($route);
        return $route;
    }
}