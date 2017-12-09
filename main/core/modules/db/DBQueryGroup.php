<?php

namespace App\Core\Modules\DB;

use App\Core\Modules\DB\DBQueryBuilder;

class DBQueryGroup extends DBQueryBuilder
{

    /**
     * Builder
     * 
     * @var \App\Core\Modules\DB\DBQueryBuilder
     */
    private $_builder;

    /**
     * Class constructor
     * 
     * @param \App\Core\Modules\DB\DBQueryBuilder $builder
     */
    public function __construct(DBQueryBuilder $builder)
    {
        $this->_builder = $builder;
        $this->joinSql('(');
    }

    /**
     * Class destructor
     * 
     */
    public function __destruct()
    {
        $this->joinSql(')');
        $this->_builder->joinSql($this->getSqlQuery());

        if(!count($this->getSqlParameters())) {
            return $this->getSqlQuery();
        }

        $this->_builder->bindParam($this->getSqlParameters());
    }
    
    /**
     * Select statement for group
     * 
     * @param array $fields
     * 
     * @return self
     */
    public function select($fields)
    {
        $this->joinSql('SELECT', implode(',', $fields), null);
        return $this;
    }

    /**
     * Table to sub select from
     * 
     * @param string $table Table name
     * 
     * @return self
     */
    public function from($table)
    { 
        $this->joinSql('FROM', $table);
        return $this;
    }
}