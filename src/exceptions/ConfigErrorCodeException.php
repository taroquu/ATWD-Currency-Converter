<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * An exception which extracts its message from the config file based on error
 * code
 * 
 * @author 08002579
 */
class ConfigErrorCodeException extends RuntimeException
{
    /**
     *
     * @param int $code The error code
     */
    public function __construct($code)
    {
        $config = ConfigHolder::getConfig();
        
        foreach($config->errors->error as $error)
        {
            $attrs = $error->attributes();
            if($attrs['code']==$code)
            {
                parent::__construct($attrs['message'], $code);
                break;
            }
        }
        
    }
}

?>
