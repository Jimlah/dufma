<?php

namespace App\Providers;

use App\Models\AssetModel;

class AssetProvider
{
    private $_model;

    const BUILDING = 0;
    const MACHINERY = 1;
    const VEHICLE = 2;
    const LAND = 3;
    const PRODUCT = 4;
    const OTHER_ASSET = 5;
    const EQUIPMENT = 6;
    const GOODS = 7;
    const CURRENT_ASSET = 0;
    const FIXED_ASSET = 1;
    

    /**
     * AssetProvider constructor
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->_model = AssetModel::findByPrimaryKey($id);
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