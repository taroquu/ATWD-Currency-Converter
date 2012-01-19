<?php

/*
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Tests the exchange server updated rates correctly
 * 
 * @author 08002579
 */
class ExchanageRatesUpdateTest extends AbstractTest
{
    private $ratesService;
    private $exchangeDao;
    
    protected function setUp()
    {
        parent::setUp();
        $this->ratesService = ResourceHolder::getResource('RatesService');
        $this->exchangeDao = ResourceHolder::getResource('ExchangeDao');
    }
    
    /**
     * Test updating a rate by force (bypassing update time check)
     */
    public function testForceUpdate()
    {
        $this->ratesService->updateRate('GBP');
        $timeSinceLastUpdate = (time()-$this->exchangeDao->getLastUpdate('GBP'));
        $this->assertTrue($timeSinceLastUpdate<5);
    }
    
    /**
     * Test updating a rate with a stale value
     * Test updating a rate with a recent value
     */
    public function testAffirm()
    {
        $this->exchangeDao->updateRate('GBP', 1, time()-(60 * 60 * 3));
        $this->assertTrue($this->ratesService->affirmRate('GBP'));
        $this->assertFalse($this->ratesService->affirmRate('GBP'));
        
        $this->exchangeDao->updateRate('GBP', 1, time()-(60 * 60 * 1));
        $this->assertFalse($this->ratesService->affirmRate('GBP'));
        
        $this->ratesService->updateRate('GBP');
    }
}

?>
