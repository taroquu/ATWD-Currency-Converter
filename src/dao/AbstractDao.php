<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Super class for dao's providing query and update methods
 * Provideds error handling
 * @author 08002579
 */
abstract class AbstractDao
{
    /**
     * The data source object
     * @var DataSource 
     */
    private $source;
    

    /**
     * Create a new Dao
     */
    public function __construct()
    {
        $this->source = ResourceHolder::getDataSource();
    }
    
    /**
     * Run a query on the database
     * @param string $query The SQL query to run
     * @return reference The result set reference
     */
    protected function query($query)
    {
        $result =  $this->source->getConnection()->query($query);
        
        if($result)
        {
            return $result;
        }
        else
        {
            throw new ConfigErrorCodeException(3100);
        }
    }
    
    /**
     * Run a query on the database (update/insert) that will not produce
     * a result set
     * @param string $query The result set reference
     */
    protected function update($query)
    {
        if($this->source->getConnection()->query($query)==false)
        {
            throw new ConfigErrorCodeException(3100);
        }
    }
}

?>
