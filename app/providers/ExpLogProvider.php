<?php

namespace App\Providers;

use App\Models\ExpLogModel;

class ExpLogProvider
{
    private $_model;

    const BUILDING_MAINTENANCE = 0;
    const MACHINERY_MAINTENANCE = 1;
    const VEHICLE_MAINTENANCE = 2;
    const UTILITIES = 3;
    const ADVERT = 4;
    const PURCHASES = 5;
    const RENT = 6;
    const LEGAL_FEES = 7;
    const POWER = 8;
    const SALARY = 9;
    const INSURANCE = 10;
    const SECURITY = 10;
    const RAW_MATERIALS = 10;


    /**
     * ExpLogProvider constructor
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->_model = ExpLogModel::findByPrimaryKey($id);
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

    public function getAsset(): AssetProvider
    {
        return new AssetProvider($this->assetid());
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