<?php

/*
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Tests the error handler is producing the correct exception, 
 * causing any PHP errors to be thrown as exceptions.
 * 
 * @author 08002579
 */
class ExceptionHandlerTest extends AbstractTest
{
    protected function setUp()
    {
        parent::setUp();
        new ErrorHandler();
    }
    
    /**
     * Test fatal
    * @expectedException ConfigErrorCodeException
    * @expectedExceptionCode 3100
    */
    public function testFatel()
    {
        //Division by 0
        $something = 495 / 0;
    }
    
    /**
     * Test user fatal
    * @expectedException ConfigErrorCodeException
    * @expectedExceptionCode 3100
    */
    public function testUserFatel()
    {
        trigger_error('some fatel', E_USER_ERROR);
    }
}

?>
