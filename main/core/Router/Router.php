<?php

namespace App\Core\Router;

use InvalidArgumentException;

use App\Core\Router\Route;
use App\Core\Router\RouteCollection;

class Router
{
    /**
     * Route parent path
     *
     * @var string|null
     */
    private $_root_path = null;

    /**
     * Middlewares
     *
     * @var array|string|null
     */
    private $_root_middlewares = null;

    /**
     * Namespace
     *
     * @var string|null
     */
    private $_root_namespace = null;

    /**
     * Parent route
     *
     * @var Router|null
     */
    private $_parent = null;

    /**
     * Constructor
     *
     * @param string $parent_path
     */
    public function __construct($path = null, $namespace = null, $middlewares = null, bool $cors = true, ?self $parent = null)
    {
        $this->_parent = $parent;

        $this->setPath($path);
        $this->setMiddleware($middlewares);
        $this->setNamespace($namespace);
    }

    /**
     * Get this router's middleware
     *
     * @return string|array
     */
    public function getMiddlewares()
    {
        return $this->_root_middlewares;
    }

    /**
     * Get this router's namespace
     *
     * @return string
     */
    public function getNamespace(): ?string
    {
        return $this->_root_namespace;
    }

    /**
     * Get this router's route path
     *
     * @return string|null
     */
    public function getRootPath(): ?string
    {
        return $this->_root_path;
    }

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
     * @return RouterGroup
     */
    public function group($path)
    {
        $router = new RouterGroup(
            $path,
            $this->_root_namespace,
            $this->_root_middlewares,
            true,
            $this
        );

        return $router;
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
        $root_path = $this->_root_path;
        $root_middlewares = $this->_root_middlewares;
        $root_namespace = $this->_root_namespace;

        $route_path = $root_path ? $root_path . $path : $path;
        $route = new Route($method, $route_path, $controller);
        
        if($root_middlewares) $route->use($root_middlewares);
        if($root_namespace) $route->setNamespace($root_namespace);

        return RouteCollection::attachRoute($route);
    }

    /**
     * Set router's base middlewares
     *
     * @param [type] $middlewares
     * @return void
     */
    protected function setMiddleware($middlewares)
    {
        $parent = $this->_parent;
        $parent_middlewares = $parent ? $parent->getMiddlewares() : null;

        if(!$parent_middlewares) {
            return $this->_root_middlewares = $middlewares;
        }

        $context = is_array($parent_middlewares) ? $parent_middlewares : [$parent_middlewares];
        $scope = is_array($middlewares) ? $middlewares : [$middlewares];

        $this->_root_middlewares = array_merge($context, $scope);
    }

    /**
     * Set router's base namespace
     *
     * @param string|null $namespace
     * @return void
     */
    protected function setNamespace(?string $namespace = null)
    {
        $parent = $this->_parent;

        if(!$parent && !$namespace) {
            return;
        }

        $parent_namespace = $parent->getNamespace();
        $this->_root_namespace = $parent_namespace . '\\' . $namespace;
    }

    /**
     * Set route's base path
     *
     * @param string|null $path
     * @return void
     */
    private function setPath(?string $path = null)
    {
        $parent = $this->_parent;
        $this->_root_path = $parent ? $parent->getRootPath() . $path : $path;
    }
}