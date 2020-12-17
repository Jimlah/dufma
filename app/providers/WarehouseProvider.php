<?php

namespace App\Providers;

use App\Models\WarehouseModel;

class WarehouseProvider
{

    const REMOVED = 0;
    const ADDED = 1;

    private $_model;

    private $product;

    /**
     * WarehouseProvider constructor
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->_model = WarehouseModel::findByPrimaryKey($id);
    }

    /**
     * Getter
     *
     * @param string $name Field name
     * @param array $args Arguments
     * @return mixed
     */
    public function __call($name, $args)
    {
        return $this->_model->{$name} ?? null;
    }

    /**
     * Setter
     *
     * @param string $name Field name
     * @param mixed $value Field value
     */
    public function __set($name, $value)
    {

    }

    public function getProduct(): AssetProvider
    {
        $this->product ??= new AssetProvider($this->productid());
        /* if($this->product) {
            return $this->product;
        }

        $this->product = new CurrentAssetProvider($this->productid()); */
        return $this->product;
    }

    /**
     * Get user that created warehouse
     * 
     * @return UsersProvider
     */
    public function getUser(): UsersProvider
    {
        return new UsersProvider($this->userid());
    }

    /**
    * Model mapper
    *
    * @return self
    */
    public static function map($id): self
    {
        return new self($id);
    }
}