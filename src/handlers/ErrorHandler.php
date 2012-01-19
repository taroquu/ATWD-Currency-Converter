<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Handles uncaught exceptions and PHP errors
 * 
 * @author 08002579
 */
class ErrorHandler
{
    /**
     * Registers the handlers
     */
    public function __construct()
    {
        set_error_handler(array($this, 'onError'));
        set_exception_handler(array($this, 'onException'));
    }
    
    /**
     * Called by the error handler, throws an error in service exception
     * @see http://uk.php.net/manual/en/function.set-error-handler.php
     * @param int $errno The first parameter, errno, contains the level of the error raised, as an integer. 
     * @param string $errstr The second parameter, errstr, contains the error message, as a string. 
     * @param string $errfile The third parameter is optional, errfile, which contains the filename that the error was raised in, as a string. 
     * @param int $errline  The fourth parameter is optional, errline, which contains the line number the error was raised at, as an integer. 
     */
    public function onError($errno, $errstr, $errfile, $errline)
    {
        throw new ConfigErrorCodeException(3100);
    }
    
    /**
     * Called when an exception is not caught by a catch block.
     * Runs through the xml helper to produce a response
     * @see http://uk.php.net/manual/en/function.set-exception-handler.php
     * @param Exception $exception The thrown exception
     */
    public function onException($exception)
    {
        if(!($exception instanceof ConfigErrorCodeException))
        {
            $exception = new ConfigErrorCodeException(3100);
        }
        
        die(CurrencyXMLHelper::getErrorResponseXML($exception));
    }
}

?>
