<?php

namespace App\Providers;

use App\Models\ProfileModel;
use App\Models\ReportModel;

class ReportProvider
{
    private $_model;

    const ACTIVITY_STAT_COMPLETE = 0;
    const ACTIVITY_STAT_ONGOING = 1;
    const TYPE_FIELD = 0;
    const TYPE_PEN = 1;
    const TYPE_FACILITY = 2;



    /**
     * ReportProvider constructor
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->_model = ReportModel::findByPrimaryKey($id);
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
     * Get Profile
     * 
     * @return ProfileProvider
     */

     public function getProfile(): ProfileProvider
     {
        return new ProfileProvider($this->workerid());
     }


     /**
     * Get Profile
     * 
     * @return ProfileProvider
     */

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