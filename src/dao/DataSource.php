<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Object to store the connection reference to a database
 * @author 08002579
 */
class DataSource
{
    private $connection;
    
    /**
     * Establish a new database connection
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $database 
     */
    public function __construct($host, $user, $password, $database)
    {
        $this->connection = new mysqli($host, $user, $password, $database);
    }
    
    /**
     * Get the connection reference
     * @return reference the conection reference
     */
    public function getConnection()
    {
        return $this->connection;
    }
    
    /**
     * Close the connection on destruct
     */
    public function __destruct()
    {
        $this->connection->close();
    }
}

?>
