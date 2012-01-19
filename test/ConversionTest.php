<?php

/*
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Test for the conversion of currencies
 * 
 * These tests invoke the conversion test directory using the testing currency codes XXX (no currency) and XTS (test currency) which have pre-defined with fixed and known values. A Conversion Request is created and passed to the service.
 * 1 USD = 0.5 XXX 
 * 1 USD = 0.25 XTS
 * @author 08002579
 */
class ConversionTest extends AbstractTest
{
    private $conversionService;
    
    protected function setUp()
    {
        parent::setUp();
        $this->conversionService = ResourceHolder::getResource('ConversionService');
        
        $exchangeDao = ResourceHolder::getResource('ExchangeDao');
        $exchangeDao->updateRate('XTS', 0.25);
        $exchangeDao->updateRate('XXX', 0.5);
    }
    
    /**
     * Use the test currency codes (which are never updated and remain constant)
     * to convert a value
     */
    public function testConversion()
    {
        $request = new ConversionRequest(2, 'XXX', 'XTS');
        $result = $this->conversionService->convertCurrency($request);
        $this->assertEquals(1, $result->toAmount);
        $this->assertEquals($result->rate*2, $result->toAmount);
        
        $request = new ConversionRequest(5, 'XTS', 'XXX');
        $result = $this->conversionService->convertCurrency($request);
        $this->assertEquals(10, $result->toAmount);
        $this->assertEquals($result->rate*5, $result->toAmount);
    }
}

?>
