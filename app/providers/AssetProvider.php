<?php

namespace App\Providers;

use App\Models\AssetModel;
use App\Providers\UsersProvider;

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

    private $user;

    private $table;

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

    /**
     * Get User that created asset
     * 
     * @return UsersProvider
     */

    public function getUser(): UsersProvider
    {
        return new UsersProvider($this->userid());
    }

    public function getAsset()
    {
        switch ($this->table_type()) {
            case self::BUILDING:
                $table = 'BUILDING';
                break;
            case self::MACHINERY:
                $table = 'MACHINERY';
                break;
            case self::VEHICLE:
                $table = 'VEHICLE';
                break;
            case self::PRODUCT:
                $table = 'PRODUCT';
                break;
            case self::LAND:
                $table = 'LAND';
                break;
            case self::OTHER_ASSET:
                $table = 'OTHER ASSET';
                break;
            case self::GOODS:
                $table = 'GOODS';
                break;
            case self::EQUIPMENT:
                $table = 'EQUIPMENT';
                break;
            default:
                $table = 'UNNAMMED';
                break;
        }
        return $table;
    }
}
