<?php

/*
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Test the conversion request generation
 * These tests simulate a request by setting get parameters
 * 
 * @author 08002579
 */
class ConversionRequestTest extends AbstractTest
{
    private $conversionService;
    
    protected function setUp()
    {
        parent::setUp();
        $this->conversionService = ResourceHolder::getResource('ConversionService');
        $_GET['amnt'] = 10;
        $_GET['to'] = 'EUR';
        $_GET['from'] = 'GBP';
    }
    
    /**
     * Test extraction of parameters
     */
    public function testValidConversion()
    {
        $request = $this->conversionService->createFromQueryString();
        $this->assertEquals($request->amount, 10);
        $this->assertEquals($request->to, 'EUR');
        $this->assertEquals($request->from, 'GBP');
    }
    
    /**
     * Test non numerical amount
    * @expectedException ConfigErrorCodeException
    * @expectedExceptionCode 1100
    */
    public function testInvalideAmount()
    {
        $_GET['amnt'] = 'not a number';
        $request = $this->conversionService->createFromQueryString();
    }
    
    /**
     * Test amount not to 2 decimal places
    * @expectedException ConfigErrorCodeException
    * @expectedExceptionCode 2100
    */
    public function testInvalideAmountDecimalPlaces()
    {
        $_GET['amnt'] = 45.989845;
        $request = $this->conversionService->createFromQueryString();
    }
    
    /**
     * Test nonexistent to code
    * @expectedException ConfigErrorCodeException
    * @expectedExceptionCode 2000
    */
    public function testInvalideTo()
    {
        $_GET['to'] = 'ZZZ';
        $request = $this->conversionService->createFromQueryString();
    }
    
    /**
     * Test nonexistent from code
    * @expectedException ConfigErrorCodeException
    * @expectedExceptionCode 2000
    */
    public function testInvalideFrom()
    {
        $_GET['from'] = 'ZZZ';
        $request = $this->conversionService->createFromQueryString();
    }
    

    /**
     * Test invalid parameter
    * @expectedException ConfigErrorCodeException
    * @expectedExceptionCode 1100
    */
    public function testExtraParam()
    {
        $_GET['something'] = 'something';
        $request = $this->conversionService->createFromQueryString();
    }
    
    /**
     * Test missing amount
    * @expectedException ConfigErrorCodeException
    * @expectedExceptionCode 1000
    */
    public function testMissingAmount()
    {
        unset($_GET['amnt']);
        $_GET['to'] = 'EUR';
        $_GET['from'] = 'GBP';
        $request = $this->conversionService->createFromQueryString();
    }
    
    /**
     * Test missing to
    * @expectedException ConfigErrorCodeException
    * @expectedExceptionCode 1000
    */
    public function testMissingTo()
    {
        unset($_GET['to']);
        $request = $this->conversionService->createFromQueryString();
    }
    
    /**
     * Test missing from
    * @expectedException ConfigErrorCodeException
    * @expectedExceptionCode 1000
    */
    public function testMissingFrom()
    {
        unset($_GET['from']);
        $request = $this->conversionService->createFromQueryString();
    }
}

?>
