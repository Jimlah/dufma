<?php

namespace App\Providers;

use App\Models\PriceModel;

class PriceProvider
{
    private $_model;

    const FEATURES = array(
        0 => "Financial Management",
        1 => 'Inventory Management',
        2 => "Monitoring and Evaluation",
        3 => 'Risk Management',
        4 => 'Supply Chain Management',
        5 => 'Smart farming Integration',
        6 => "Enterprise Farming Integration",
        7 => 'Crowdfunding Opportunity',
        8 => 'Intra-Chat interactive',
        9 => 'Wallet',

    );

    /**
     * PriceProvider constructor
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->_model = PriceModel::findByPrimaryKey($id);
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
