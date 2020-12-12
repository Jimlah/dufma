<?php

namespace App\Providers;

class CurrentAssetProvider
{


    const PRODUCT = 0;
    const OTASSET = 1;
    const EQUIPMENT = 2;
    const GOODS = 3;

    private $_model;

    /**
     * CurrentAssetProvider constructor
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->_model = $id;
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