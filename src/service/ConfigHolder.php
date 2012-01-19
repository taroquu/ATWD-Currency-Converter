<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Loader and holder for the xml config
 * This is a singleton
 * 
 * @author 08002579
 */
class ConfigHolder
{
    /**
     * The config
     * @var SimpleXMLElement the processed config
     */
    private $config;
    
    /**
     * An instance of itself
     * @var ConfigHolder 
     */
    private static $self;
    
    /**
     * Load the config and process using simple xml,
     * set the static self property to the created instance
     */
    private function __construct()
    {
        $file = fopen(CONFIG_FILE, 'r');
        $contents = fread($file, filesize(CONFIG_FILE));
        fclose($file);
        $this->config = new SimpleXMLElement($contents, LIBXML_NOCDATA);
        self::$self = $this;
    }
    
    /**
     * Get an instance of ConfigHolder, create one if none exists already 
     * @return ConfigHolder 
     */
    public static function getConfig()
    {
        if(!isset(self::$self))
        {
            self::$self = new self();
        }
        return self::$self->config;
    }
}

?>
