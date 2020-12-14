<?php

namespace App\Providers;

use App\Models\UsersModel;

class UsersProvider
{

    const ACCESS_ADMIN = 0;
    const ACCESS_ORGANIZATION = 1;
    const ACCESS_EMPLOYEE = 2;
    const ACCESS_INVESTOR = 3;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    private $_model;

    /**
     * UsersProvider constructor
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->_model = UsersModel::findByPrimaryKey($id);
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

    public function getFullname(): string
    {
        return concat($this->firstname(), ' ', $this->lastname());
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