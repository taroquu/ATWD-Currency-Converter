<?php

/*
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

define('BASE_DIR', __DIR__.'\\..\\src');

define("CONFIG_FILE", BASE_DIR.'\\config\\config.xml');

/**
 * 
 * Super class for all tests
 * @author 08002579
 */
class AbstractTest extends PHPUnit_Framework_TestCase
{    
    /**
     * Setup the auto loader
     */
    protected function setUp()
    {
        parent::setUp();
        require_once(BASE_DIR.'\\handlers\\AutoLoader.php');
        $autoLoader = new AutoLoader(BASE_DIR.'\\');
        $_POST = array();
        $_GET = array();
        

    }

}

?>
