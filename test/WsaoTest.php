<?php

/*
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Test WSAO will have been tested as part of the exchange rate test, 
 * however this tests ensures it can handle errors correctly
 * 
 * @author 08002579
 */
class WsaoTest extends AbstractTest
{
    private $backup;
    
    /**
     * Test invalid URL
    * @expectedException ConfigErrorCodeException
    * @expectedExceptionCode 3000
    */
    public function testInvalidURL()
    {
        $config = ConfigHolder::getConfig();
        $this->backup = $config->feeds->fx;
        $config->feeds->fx = 'badURL';
        $wsao = ResourceHolder::getResource('FXExchangeWsao');
        $wsao->getExchangeRate('XXX');
    }
    
    public function tearDown()
    {
        $config = ConfigHolder::getConfig();
        $config->feeds->fx = $this->backup;
    }
}

?>
