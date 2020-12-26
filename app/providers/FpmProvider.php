<?php

namespace App\Providers;

use App\Models\FpmModel;

class FpmProvider
{
    private $_model;

    const FPM_FIELD = 0;
    const FPM_PEN = 1;
    const FPM_FACILITY = 2;


    /**
     * FpmProvider constructor
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->_model = FpmModel::findByPrimaryKey($id);
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