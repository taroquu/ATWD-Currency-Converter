<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Singleton that instantates and stores instances of objects allowing them
 * to used more than once with only a single instantation. Of course all objects
 * used in this way are expected to be stateless.
 * 
 * @author 08002579
 */
class ResourceHolder
{
    /**
     * @var array The instantated objects, stored with the name as the key
     */
    private static $resources = array();
    
    /**
     *
     * @var DataSource Stores the data source object containg the connection resource 
     */
    private static $source;
    
    /**
     *
     * @var boolean Whether to use a Impl resource or a stub 
     */
    private static $impl = true;
    
    /**
     * private constructor, prevent instantiation from other objects
     */
    private function __construct()
    {
        //singleton
    }
    
    /**
     * Obtain the request resource, if it exists
     * @param string $name The name of the resource
     * @return object The resource
     */
    public static function getResource($name)
    {
        if(self::$impl)
        {
            $name = $name.'Impl';
        }
        else
        {
            $name = $name.'Stub';
        }
        if(!array_key_exists($name, self::$resources))
        {
            self::$resources[$name] = new $name();
        }
        return self::$resources[$name];
    }
    
    /**
     * Get the data source
     * @return DataSource The data source object
     */
    public static function getDataSource()
    {
        if(self::$source==null)
        {
            $config = ConfigHolder::getConfig();
            self::$source = new DataSource($config->dataSource->host, $config->dataSource->user, 
                    $config->dataSource->password, $config->dataSource->database);
        }
        return self::$source;
    }
}

?>
