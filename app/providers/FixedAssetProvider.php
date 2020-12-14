<?php

namespace App\Providers;

use App\Models\FixedAssetModel;

class FixedAssetProvider
{
    const BUILDING = 0;
    const MANCHINERY = 1;
    const VEHICLE = 2;
    const LAND = 3;

    private $_model;

    /**
     * FixedAssetProvider constructor
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->_model = FixedAssetModel::findByPrimaryKey($id);
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